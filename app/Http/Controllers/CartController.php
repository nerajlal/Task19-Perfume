<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Bundle;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display the shopping cart.
     */
    public function index()
    {
        if (Auth::check()) {
            self::syncSession(Auth::id());
            $cart = $this->getCartFromDb();
        } else {
            $cart = session()->get('cart', []);
            $cart = array_reverse($cart, true); // Last added first
            
            // Enrich session cart with coupons and stock
            foreach($cart as $key => &$item) {
                $item['stock'] = 100; // Default
                
                if(isset($item['type']) && $item['type'] == 'product' && isset($item['product_id'])) {
                    $product = Product::find($item['product_id']);
                    if($product) {
                        $item['coupon'] = $this->getActiveCoupon($product);
                        
                        // Stock Check
                        if(isset($item['size']) && $item['size']) {
                            $variant = $product->variants->where('size', $item['size'])->first();
                            $item['stock'] = $variant ? $variant->stock : 0;
                        } else {
                            $item['stock'] = $product->variants->sum('stock');
                        }
                    }
                } elseif (isset($item['type']) && $item['type'] == 'bundle' && isset($item['bundle_id'])) {
                    $bundle = Bundle::find($item['bundle_id']);
                    if ($bundle) {
                        $item['stock'] = $bundle->is_out_of_stock ? 0 : 100;
                    }
                }
            }
        }

        $total = 0;
        foreach($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }
        
        return view('nurah.cart', compact('cart', 'total'));
    }

    /**
     * Add an item to the cart.
     */
    public function add(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity ?? 1;
        $size = $request->size;
        
        if($request->type == 'bundle') {
            $bundle = Bundle::find($id);
            if(!$bundle) return response()->json(['success' => false, 'message' => 'Bundle not found!'], 404);
            
            $cartKey = 'bundle-' . $id;
            
             if (Auth::check()) {
                $cartItem = Cart::where('user_id', Auth::id())
                    ->where('bundle_id', $id)
                    ->first();
                    
                if ($cartItem) {
                    $cartItem->quantity += $quantity;
                    $cartItem->save();
                } else {
                    Cart::create([
                        'user_id' => Auth::id(),
                        'bundle_id' => $id,
                        'quantity' => $quantity,
                        'product_id' => null
                    ]);
                }
                $cart = $this->getCartFromDb();
             } else {
                $cart = session()->get('cart', []);
                if(isset($cart[$cartKey])) {
                    $cart[$cartKey]['quantity'] += $quantity;
                } else {
                    $cart[$cartKey] = [
                        "bundle_id" => $bundle->id,
                        "name" => $bundle->title,
                        "quantity" => $quantity,
                        "price" => $bundle->total_price,
                        "image" => \Illuminate\Support\Facades\Storage::url($bundle->image),
                        "size" => null,
                        "type" => "bundle"
                    ];
                }
                session()->put('cart', $cart);
             }
             
            // Calculate count
            $count = 0;
            foreach($cart as $item) $count += $item['quantity'];
            
            return response()->json([
                'success' => true, 
                'message' => 'Bundle added to cart!',
                'cartCount' => $count
            ]);
        } 
        
        // Product Logic
        $product = Product::find($id);
        
        if(!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found!'], 404);
        }
        
        // Price Logic
        $price = $product->starting_price;
        if($size) {
            $variant = $product->variants()->where('size', $size)->first();
            if($variant) $price = $variant->price;
        }

        // Cart Key for Session
        $cartKey = $id . ($size ? '-' . $size : '');

        if (Auth::check()) {
            // DB Logic
            $cartItem = Cart::where('user_id', Auth::id())
                ->where('product_id', $id)
                ->where('size', $size)
                ->first();

            if ($cartItem) {
                $cartItem->quantity += $quantity;
                $cartItem->save();
            } else {
                Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $id,
                    'quantity' => $quantity,
                    'size' => $size
                ]);
            }
            
            // Re-fetch full cart for count/consistency
            $cart = $this->getCartFromDb();
            
        } else {
            // Session Logic
            $cart = session()->get('cart', []);
            
            if(isset($cart[$cartKey])) {
                $cart[$cartKey]['quantity'] += $quantity;
            } else {
                $cart[$cartKey] = [
                    "product_id" => $product->id,
                    "name" => $product->title,
                    "quantity" => $quantity,
                    "price" => $price,
                    "image" => $product->main_image_url,
                    "size" => $size,
                    "type" => "product"
                ];
            }
            session()->put('cart', $cart);
        }
        
        // Calculate count
        $count = 0;
        foreach($cart as $item) $count += $item['quantity'];
        
        return response()->json([
            'success' => true, 
            'message' => 'Product added to cart!',
            'cartCount' => $count
        ]);
    }

    /**
     * Update cart item quantity.
     */
    public function update(Request $request)
    {
        if($request->id && $request->quantity) {
             if (Auth::check()) {
                // DB Logic
                // Parsing logic to handle both Product and Bundle keys
                
                $cartItem = null;
                
                if (str_starts_with($request->id, 'bundle-')) {
                    $bundleId = str_replace('bundle-', '', $request->id);
                    $cartItem = Cart::where('user_id', Auth::id())
                        ->where('bundle_id', $bundleId)
                        ->first();
                } else {
                    $parts = explode('-', $request->id);
                    $productId = $parts[0];
                    $size = isset($parts[1]) ? $parts[1] : null;

                    $cartItem = Cart::where('user_id', Auth::id())
                        ->where('product_id', $productId)
                        ->where('size', $size)
                        ->first();
                }
                
                if ($cartItem) {
                    $cartItem->quantity = $request->quantity;
                    $cartItem->save();
                }
                
                $cart = $this->getCartFromDb();

            } else {
                // Session Logic
                $cart = session()->get('cart');
                $cartKey = $request->id;
                
                if(isset($cart[$cartKey])) {
                    $cart[$cartKey]['quantity'] = $request->quantity;
                    session()->put('cart', $cart);
                }
            }
            
            // Recalculate
            // Note: need to find specific item total for response
            $itemTotal = 0;
            // The request->id matches the array key in both Auth and Session-mapped-array methods
            if(isset($cart[$request->id])) {
                $itemTotal = $cart[$request->id]['price'] * $cart[$request->id]['quantity'];
            }

            $cartTotal = 0;
            $count = 0;
            foreach($cart as $item) {
                $cartTotal += $item['price'] * $item['quantity'];
                $count += $item['quantity'];
            }
            
            return response()->json([
                'success' => true, 
                'itemTotal' => $itemTotal,
                'cartTotal' => $cartTotal,
                'cartCount' => $count
            ]);
        }
        
        return response()->json(['success' => false], 400);
    }

    /**
     * Remove item from cart.
     */
    public function remove(Request $request)
    {
        if($request->id) {
            
            if (Auth::check()) {
                 if (str_starts_with($request->id, 'bundle-')) {
                    $bundleId = str_replace('bundle-', '', $request->id);
                    Cart::where('user_id', Auth::id())
                        ->where('bundle_id', $bundleId)
                        ->delete();
                } else {
                    $parts = explode('-', $request->id);
                    $productId = $parts[0];
                    $size = isset($parts[1]) ? $parts[1] : null;

                    Cart::where('user_id', Auth::id())
                        ->where('product_id', $productId)
                        ->where('size', $size)
                        ->delete();
                }
                $cart = $this->getCartFromDb();

            } else {
                $cart = session()->get('cart');
                if(isset($cart[$request->id])) {
                    unset($cart[$request->id]);
                    session()->put('cart', $cart);
                }
            }
            
            // Recalculate
            $cartTotal = 0;
            $count = 0;
            if($cart) {
                foreach($cart as $item) {
                    $cartTotal += $item['price'] * $item['quantity'];
                    $count += $item['quantity'];
                }
            }

            return response()->json([
                'success' => true,
                'cartTotal' => $cartTotal,
                'cartCount' => $count,
                'isEmpty' => empty($cart)
            ]);
        }
        
        return response()->json(['success' => false], 400);
    }
    
    /**
     * Helper: Sync Session Cart to Database
     */
    public static function syncSession($userId)
    {
        $sessionCart = session()->get('cart', []);
        
        if (empty($sessionCart)) return;
        
        foreach ($sessionCart as $key => $details) {
            $quantity = $details['quantity'];
            
            if (isset($details['bundle_id'])) {
                $bundleId = $details['bundle_id'];
                $cartItem = Cart::where('user_id', $userId)->where('bundle_id', $bundleId)->first();
                if ($cartItem) {
                    $cartItem->quantity += $quantity;
                    $cartItem->save();
                } else {
                    Cart::create([
                        'user_id' => $userId,
                        'bundle_id' => $bundleId,
                        'quantity' => $quantity
                    ]);
                }
            } else {
                $productId = $details['product_id'];
                $size = $details['size'];
                
                $cartItem = Cart::where('user_id', $userId)
                    ->where('product_id', $productId)
                    ->where('size', $size)
                    ->first();
                    
                if ($cartItem) {
                    $cartItem->quantity += $quantity;
                    $cartItem->save();
                } else {
                    Cart::create([
                        'user_id' => $userId,
                        'product_id' => $productId,
                        'quantity' => $quantity,
                        'size' => $size
                    ]);
                }
            }
        }
        
        // Clear session after sync
        session()->forget('cart');
    }
    
    /**
     * Helper: Fetch Cart from DB and format like Session Array
     */
    private function getCartFromDb()
    {
        $dbItems = Cart::where('user_id', Auth::id())
            ->with(['product.variants', 'product.images', 'product.discounts', 'bundle'])
            ->latest()
            ->get();
        $cart = [];
        
        foreach ($dbItems as $item) {
            
            if ($item->bundle_id && $item->bundle) {
                // Bundle Logic
                $key = 'bundle-' . $item->bundle_id;
                $cart[$key] = [
                    "bundle_id" => $item->bundle_id,
                    "name" => $item->bundle->title,
                    "quantity" => $item->quantity,
                    "price" => $item->bundle->total_price,
                    "image" => \Illuminate\Support\Facades\Storage::url($item->bundle->image),
                    "size" => null,
                    "type" => "bundle",
                    "stock" => $item->bundle->is_out_of_stock ? 0 : 100 
                ];
            }
            elseif ($item->product_id && $item->product) {
                // Product Logic
                $key = $item->product_id . ($item->size ? '-' . $item->size : '');
                
                // Calculate Price & Stock
                $price = $item->product->starting_price;
                $stock = $item->product->variants->sum('stock');

                if ($item->size) {
                    $variant = $item->product->variants->where('size', $item->size)->first();
                    if ($variant) {
                        $price = $variant->price;
                        $stock = $variant->stock;
                    }
                }
                
                $cart[$key] = [
                    "product_id" => $item->product_id,
                    "name" => $item->product->title,
                    "quantity" => $item->quantity,
                    "price" => $price,
                    "image" => $item->product->main_image_url,
                    "size" => $item->size,
                    "type" => "product",
                    "coupon" => $this->getActiveCoupon($item->product),
                    "stock" => $stock
                ];
            }
        }
        
        return $cart;
    }

    private function getActiveCoupon($product)
    {
        if(!$product) return null;
        
        return $product->discounts()
            ->where('status', 'active')
            ->where(function($q) {
                $q->whereNull('starts_at')->orWhere('starts_at', '<=', now());
            })
            ->where(function($q) {
                $q->whereNull('ends_at')->orWhere('ends_at', '>=', now());
            })
            ->orderByDesc('value')
            ->first();
    }
}
