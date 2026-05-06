<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\DeliveryPartner;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user')->withCount('items')->latest();

        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(20)->withQueryString();
        
        return view('admin.orders', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['items.product', 'items.bundle.products.variants', 'user', 'deliveryPartner'])->findOrFail($id);
        $deliveryPartners = DeliveryPartner::where('status', true)->orderBy('is_default', 'desc')->get();
        return view('admin.orders.show', compact('order', 'deliveryPartners'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $status = $request->input('status');
        $trackingId = $request->input('tracking_id');

        if ($status) {
            $order->status = $status;
            
            // If status is shipped, we might want to save tracking ID
            // Assuming we have a way to store tracking ID, for now let's just save it in notes or a dedicated column if it existed.
            // checking migration, we don't seem to have tracking_number. 
            // I'll append it to notes for now to avoid migration overhead unless critical, 
            // OR I can add a tracking_number column. For "fully functional" usually means DB too.
            // But let's check order schema first. I'll stick to updating status for now and maybe notes.
            
            if ($status == 'shipped') {
                 if ($trackingId) {
                     $order->tracking_number = $trackingId;
                 }
                 if ($request->has('delivery_partner_id')) {
                     $order->delivery_partner_id = $request->input('delivery_partner_id');
                 }
            }
            
            $order->save();
        }

        return response()->json(['success' => true, 'message' => 'Order status updated successfully']);
    }

    public function print($id)
    {
        $order = Order::with(['items.product', 'items.bundle.products.variants', 'user'])->findOrFail($id);
        return view('admin.orders.print', compact('order'));
    }
}
