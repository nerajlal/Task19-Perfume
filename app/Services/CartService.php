<?php

namespace App\Services;

use App\Models\Bundle;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartService
{
    /**
     * Calculate the total for a given cart array.
     * Modifies the cart array by reference to add discount flags.
     */
    public static function calculateTotal(&$cart)
    {
        $subtotal = 0;
        $savings = 0;

        // 1. Calculate base subtotal and individual Pack (Volume) savings
        foreach($cart as $key => &$item) {
            $price = $item['price'];
            
            // Apply individual product coupons first
            if(isset($item['coupon']) && $item['coupon']) {
                $discountVal = $item['coupon']['type'] == 'percentage' 
                    ? $price * ($item['coupon']['value'] / 100) 
                    : $item['coupon']['value'];
                $price = max(0, $price - $discountVal);
                $item['effective_price'] = $price;
                $item['saved_amount'] = $discountVal;
            } else {
                $item['effective_price'] = $price;
                $item['saved_amount'] = 0;
            }

            if(isset($item['type']) && $item['type'] == 'product') {
                // Find potential pack bundles for this product
                $product = Product::find($item['product_id']);
                if ($product) {
                    $variantId = $item['variant_id'] ?? null;
                    if (!$variantId && isset($item['size'])) {
                        $v = $product->variants->where('size', $item['size'])->first();
                        $variantId = $v ? $v->id : null;
                    }

                    $packBundle = Bundle::where('type', 'pack')
                        ->where('status', 'active')
                        ->whereHas('products', function($q) use ($item, $variantId) {
                            $q->where('product_id', $item['product_id']);
                            if ($variantId) {
                                $q->where('product_variant_id', $variantId);
                            }
                        })->first();

                    if ($packBundle) {
                        $packProd = $packBundle->products->first();
                        $packQty = $packProd->pivot->quantity;
                        
                        if ($item['quantity'] >= $packQty) {
                            $numPacks = floor($item['quantity'] / $packQty);
                            $regularPrice = $item['price'];
                            $packPrice = $packBundle->total_price;
                            
                            $lineSavings = ($regularPrice * $packQty - $packPrice) * $numPacks;
                            $savings += $lineSavings;
                            
                            $item['pack_offer_applied'] = true;
                            $item['pack_offer_text'] = "Volume Discount: {$packQty} units for ₹" . number_format($packPrice, 0);
                        }
                    }
                }
            }
            $subtotal += $item['price'] * $item['quantity'];
        }
        unset($item);

        // 2. Calculate Pool savings
        $activePools = Bundle::where('status', 'active')->where('type', 'pool')->with('products')->get();
        foreach ($activePools as $pool) {
            $poolProductIds = $pool->products->pluck('id')->toArray();
            $qualifyingQty = 0;
            
            foreach ($cart as $item) {
                if (isset($item['type']) && $item['type'] == 'product' && in_array($item['product_id'], $poolProductIds)) {
                    $qualifyingQty += $item['quantity'];
                }
            }
            
            if ($qualifyingQty >= $pool->min_quantity) {
                $times = floor($qualifyingQty / $pool->min_quantity);
                $poolSavings = ($times * $pool->discount_value);
                $savings += $poolSavings;
            }
        }

        return [
            'total' => max(0, $subtotal - $savings),
            'subtotal' => $subtotal,
            'savings' => $savings
        ];
    }

    /**
     * Helper to get active coupon for a product
     */
    public static function getActiveCoupon($product)
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

    /**
     * Get total item count in cart
     */
    public static function getCount()
    {
        $count = 0;
        if (Auth::check()) {
            $count = \App\Models\Cart::where('user_id', Auth::id())->sum('quantity');
        } else {
            $cart = session()->get('cart', []);
            foreach ($cart as $item) {
                $count += $item['quantity'] ?? 0;
            }
        }
        return $count;
    }
}
