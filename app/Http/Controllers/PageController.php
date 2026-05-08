<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $sliders = \App\Models\Slider::where('status', true)
            ->orderBy('order', 'asc')
            ->get();

        $bestsellers = \App\Models\HomeProduct::with(['product.variants', 'product.images'])
            ->orderBy('sort_order', 'asc')
            ->get();
            
        $collections = \App\Models\Collection::where('status', true)->get();
        
        $bundles = \App\Models\Bundle::where('status', 'active')->with(['products.variants'])->latest()->take(4)->get();
            
        return view('nurah.home', compact('sliders', 'bestsellers', 'collections', 'bundles'));
    }

    public function collection(Request $request)
    {
        $title = 'Collection';
        $query = \App\Models\Product::where('status', 'active')->with(['variants', 'images']);

        if ($request->has('slug')) {
            $collection = \App\Models\Collection::where('slug', $request->query('slug'))->first();
            if ($collection) {
                $title = $collection->name;
                $query->where('collection_id', $collection->id);
            }
        } elseif ($request->has('category')) {
            $category = $request->query('category');
            if ($category == 'fresh') {
                $title = 'Fresh Collection';
                $query->where('olfactory_family', 'LIKE', '%Fresh%');
            }
            elseif ($category == 'oriental-woody') {
                $title = 'Oriental & Woody Collection';
                $query->where(function($q) {
                    $q->where('olfactory_family', 'LIKE', '%Oriental%')
                      ->orWhere('olfactory_family', 'LIKE', '%Woody%');
                });
            }
            elseif ($category == 'floral') {
                $title = 'Floral Collection';
                $query->where('olfactory_family', 'LIKE', '%Floral%');
            }
        } elseif ($request->has('gender')) {
            $gender = $request->query('gender');
            if ($gender == 'for-him') {
                $title = 'Perfumes For Him';
                $query->whereIn('gender', ['Men', 'Male', 'Him']);
            }
            elseif ($gender == 'for-her') {
                $title = 'Perfumes For Her';
                $query->whereIn('gender', ['Women', 'Female', 'Her']);
            }
            elseif ($gender == 'unisex') {
                $title = 'Unisex Collection';
                $query->whereIn('gender', ['Unisex', 'All']);
            }
        }

        $products = $query->latest()->get();

        // Calculate filter counts (Scoped to current collection or global? Usually global for sidebar context, but let's scope to result for now or reuse global logic)
        // For simplicity reusing global logic on the fetched set for now
        $counts = [
            'stock_in' => 0,
            'stock_out' => 0,
            'gender_him' => 0,
            'gender_her' => 0,
            'gender_unisex' => 0,
            'size_50ml' => 0,
            'size_100ml' => 0
        ];

        foreach($products as $product) {
            // Stock
            $inStock = $product->variants->sum('stock') > 0;
            if($inStock) $counts['stock_in']++;
            else $counts['stock_out']++;

            // Gender
            $g = strtolower($product->gender);
            if(in_array($g, ['men', 'man', 'him', 'male'])) $counts['gender_him']++;
            elseif(in_array($g, ['women', 'woman', 'her', 'female'])) $counts['gender_her']++;
            else $counts['gender_unisex']++;

            // Sizes
            $sizes = $product->variants->pluck('size')->map(fn($s) => strtolower($s))->toArray();
            if(in_array('50ml', $sizes)) $counts['size_50ml']++;
            if(in_array('100ml', $sizes)) $counts['size_100ml']++;
        }

        return view('nurah.collection', compact('title', 'products', 'counts'));
    }

    public function allProducts()
    {
        // Fetch all active products for client-side filtering
        $products = \App\Models\Product::where('status', 'active')
            ->with(['variants', 'images'])
            ->latest() // default sort
            ->get();

        // Calculate filter counts
        $counts = [
            'stock_in' => 0,
            'stock_out' => 0,
            'gender_him' => 0,
            'gender_her' => 0,
            'gender_unisex' => 0,
            'size_50ml' => 0,
            'size_100ml' => 0
        ];

        foreach($products as $product) {
            // Stock
            $inStock = $product->variants->sum('stock') > 0;
            if($inStock) $counts['stock_in']++;
            else $counts['stock_out']++;

            // Gender
            $g = strtolower($product->gender);
            if(in_array($g, ['men', 'man', 'him'])) $counts['gender_him']++;
            elseif(in_array($g, ['women', 'woman', 'her'])) $counts['gender_her']++;
            else $counts['gender_unisex']++; // Default to unisex for others

            // Sizes
            $sizes = $product->variants->pluck('size')->map(fn($s) => strtolower($s))->toArray();
            if(in_array('50ml', $sizes)) $counts['size_50ml']++;
            if(in_array('100ml', $sizes)) $counts['size_100ml']++;
        }

        $bundles = \App\Models\Bundle::where('status', 'active')
            ->with(['products.variants'])
            ->latest()
            ->get();

        return view('nurah.all-products', [
            'title' => 'All Perfumes',
            'products' => $products,
            'counts' => $counts,
            'bundles' => $bundles
        ]);
    }

    public function cosmopolitan()
    {
        return view('nurah.collection', ['title' => 'Cosmopolitan Collection']);
    }

    public function combos()
    {
        // Fetch all active bundles (exclude pools)
        $bundles = \App\Models\Bundle::where('status', 'active')
            ->where('type', '!=', 'pool')
            ->with(['products.variants'])
            ->orderBy('type', 'asc') // 'bundle' before 'pack'
            ->latest()
            ->get();

        return view('nurah.combos', [
            'title' => 'Combos & Bundles',
            'bundles' => $bundles
        ]);
    }

    public function combo(Request $request)
    {
        $id = $request->query('id');
        $bundle = \App\Models\Bundle::where('status', 'active')
            ->with(['products.images', 'products.variants'])
            ->findOrFail($id);

        // Fetch related bundles (excluding current)
        $relatedBundles = \App\Models\Bundle::where('status', 'active')
            ->where('id', '!=', $id)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('nurah.bundle-main', compact('bundle', 'relatedBundles'));
    }

    public function product(Request $request)
    {
        $id = $request->query('id');
        $product = \App\Models\Product::where('status', 'active')
            ->with(['variants', 'images'])
            ->findOrFail($id);

        // Track Recently Viewed
        $recentlyViewed = session()->get('recently_viewed', []);
        
        // Remove current ID if exists to re-add at top (most recent)
        if(($key = array_search($id, $recentlyViewed)) !== false) {
            unset($recentlyViewed[$key]);
        }
        
        // Add to front
        array_unshift($recentlyViewed, $id);
        
        // Keep only last 4
        $recentlyViewed = array_slice($recentlyViewed, 0, 4);
        
        // Save back to session
        session()->put('recently_viewed', $recentlyViewed);

        // Fetch Related Products (Recently Viewed excluding current)
        // We filter out the current product ID just in case logic above overlaps or visual preference
        $relatedIds = array_diff($recentlyViewed, [$id]);
        
        if(count($relatedIds) > 0) {
            $relatedProducts = \App\Models\Product::whereIn('id', $relatedIds)
                ->where('status', 'active')
                ->with(['images', 'variants'])
                ->get()
                ->sortBy(function($model) use ($relatedIds) {
                    return array_search($model->id, $relatedIds);
                });
        } else {
            $relatedProducts = collect();
        }
        
        // Fetch specific active coupon for this product
        $coupon = $product->discounts()
            ->where('status', 'active')
            ->where(function($q) {
                $q->whereNull('starts_at')->orWhere('starts_at', '<=', now());
            })
            ->where(function($q) {
                $q->whereNull('ends_at')->orWhere('ends_at', '>=', now());
            })
            ->orderByDesc('value')
            ->first();

        // Fetch active bundle (regular combo)
        $bundle = $product->bundles()
            ->where('status', 'active')
            ->where('type', 'bundle')
            ->first();
            
        // Fetch active "Pack Of" bundles
        $packBundles = $product->bundles()
            ->where('status', 'active')
            ->where('type', 'pack')
            ->get();
            
        // Fetch active "Pool" bundles
        $poolBundles = $product->bundles()
            ->where('status', 'active')
            ->where('type', 'pool')
            ->with('products')
            ->get();
            
        return view('nurah.product-main', compact('product', 'relatedProducts', 'coupon', 'bundle', 'packBundles', 'poolBundles'));
    }

    public function shippingPolicy()
    {
        return view('nurah.shipping-policy');
    }

    public function returnPolicy()
    {
        return view('nurah.return-policy');
    }

    public function termsOfService()
    {
        return view('nurah.terms-of-service');
    }

    public function checkout()
    {
        $cart = [];
        $address = null; // Default address variable

        if(\Illuminate\Support\Facades\Auth::check()) {
             // Fetch Address
             $address = \App\Models\UserAddress::where('user_id', \Illuminate\Support\Facades\Auth::id())
                ->where('is_default', true)
                ->first();
             
             // If no default, get the first one
             if(!$address) {
                 $address = \App\Models\UserAddress::where('user_id', \Illuminate\Support\Facades\Auth::id())->first();
             }

             $items = \App\Models\Cart::where('user_id', \Illuminate\Support\Facades\Auth::id())
                ->with(['product.discounts', 'product.images', 'product.variants', 'bundle'])
                ->get();

             foreach($items as $item) {
                 $stock = 0;
                 if($item->product_id && $item->product) {
                    // Check Stock
                    if ($item->size) {
                        $variant = $item->product->variants->where('size', $item->size)->first();
                        $stock = $variant ? $variant->stock : 0;
                    } else {
                        $stock = $item->product->variants->sum('stock');
                    }
                    
                    if($stock > 0) {
                        $cart[$item->product_id . '-' . $item->size] = [
                            "name" => $item->product->title,
                            "quantity" => $item->quantity,
                            "price" => $item->product->starting_price,
                            "image" => $item->product->main_image_url,
                            "product_id" => $item->product_id,
                            "bundle_id" => null,
                            "size" => $item->size,
                            "type" => "product",
                            "coupon" => $this->getActiveCoupon($item->product)
                        ];
                    }
                } elseif ($item->bundle_id && $item->bundle) {
                    if (!$item->bundle->is_out_of_stock) {
                        $cart['bundle-' . $item->bundle_id] = [
                            "name" => $item->bundle->title,
                            "quantity" => $item->quantity,
                            "price" => $item->bundle->total_price,
                            "image" => \Illuminate\Support\Facades\Storage::url($item->bundle->image),
                            "product_id" => null,
                            "bundle_id" => $item->bundle_id,
                            "size" => null,
                            "type" => "bundle"
                        ];
                    }
                }
             }
        } else {
            $sessionCart = session()->get('cart', []);
            // Enrich session cart with coupons and filter OOS
            foreach($sessionCart as $key => $item) {
                if(isset($item['type']) && $item['type'] == 'product' && isset($item['product_id'])) {
                    $product = \App\Models\Product::find($item['product_id']);
                    if($product) {
                        $stock = 0;
                        if(isset($item['size']) && $item['size']) {
                            $variant = $product->variants->where('size', $item['size'])->first();
                            $stock = $variant ? $variant->stock : 0;
                        } else {
                            $stock = $product->variants->sum('stock');
                        }

                        if($stock > 0) {
                            $item['coupon'] = $this->getActiveCoupon($product);
                            $cart[$key] = $item;
                        }
                    }
                } elseif(isset($item['type']) && $item['type'] == 'bundle') {
                     if(isset($item['bundle_id'])) {
                         $bundle = \App\Models\Bundle::find($item['bundle_id']);
                         if ($bundle && !$bundle->is_out_of_stock) {
                             $cart[$key] = $item;
                         }
                     }
                }
            }
        }

        $subtotal = 0;
        foreach($cart as $item) {
            $price = $item['price'];
            if(isset($item['coupon']) && $item['coupon']) {
                $discountVal = $item['coupon']->type == 'percentage' 
                    ? $price * ($item['coupon']->value / 100) 
                    : $item['coupon']->value;
                $price = max(0, $price - $discountVal);
            }
            $subtotal += $price * $item['quantity'];
        }
        
        return view('nurah.checkout', compact('cart', 'subtotal', 'address'));
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
