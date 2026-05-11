<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $sliders = \App\Models\Slider::where('status', true)->orderBy('order', 'asc')->get();
        $bestsellers = \App\Models\HomeProduct::with(['product.variants', 'product.images'])->orderBy('sort_order', 'asc')->get();
        $collections = \App\Models\Collection::where('status', true)->get();
        $bundles = \App\Models\Bundle::where('status', 'active')->where('type', '!=', 'pool')->with(['products.variants'])->latest()->take(4)->get();
        return view('nurah.home', compact('sliders', 'bestsellers', 'collections', 'bundles'));
    }

    public function v3Home()
    {
        $sliders = \App\Models\Slider::where('status', true)->orderBy('order', 'asc')->get();
        $bestsellers = \App\Models\HomeProduct::with(['product.variants', 'product.images'])->orderBy('sort_order', 'asc')->get();
        $collections = \App\Models\Collection::where('status', true)->get();
        $bundles = \App\Models\Bundle::where('status', 'active')->where('type', 'bundle')->with(['products.variants'])->latest()->take(4)->get();
        return view('v3.home', compact('sliders', 'bestsellers', 'collections', 'bundles'));
    }

    public function ajmalHome()
    {
        $sliders = \App\Models\Slider::where('status', true)->orderBy('order', 'asc')->get();
        $products = \App\Models\Product::where('status', 'active')->with(['variants', 'images'])->latest()->get();
        $collections = \App\Models\Collection::where('status', true)->get();
        return view('v4.home', compact('products', 'collections', 'sliders'));
    }

    public function collection(Request $request)
    {
        return $this->handleCollection($request, 'nurah.collection');
    }

    public function v3Collection(Request $request)
    {
        return $this->handleCollection($request, 'v3.collection');
    }

    public function ajmalCollection(Request $request)
    {
        return $this->handleCollection($request, 'v4.collection');
    }

    private function handleCollection(Request $request, $view)
    {
        $title = 'Collection';
        $query = \App\Models\Product::where('status', 'active')->with(['variants', 'images']);
        if ($request->has('slug')) {
            $collection = \App\Models\Collection::where('slug', $request->query('slug'))->first();
            if ($collection) { $title = $collection->name; $query->where('collection_id', $collection->id); }
        } elseif ($request->has('category')) {
            $category = $request->query('category');
            if ($category == 'fresh') { $title = 'Fresh Collection'; $query->where('olfactory_family', 'LIKE', '%Fresh%'); }
            elseif ($category == 'oriental-woody') { $title = 'Oriental & Woody Collection'; $query->where(function($q) { $q->where('olfactory_family', 'LIKE', '%Oriental%')->orWhere('olfactory_family', 'LIKE', '%Woody%'); }); }
            elseif ($category == 'floral') { $title = 'Floral Collection'; $query->where('olfactory_family', 'LIKE', '%Floral%'); }
        } elseif ($request->has('gender')) {
            $gender = $request->query('gender');
            if ($gender == 'for-him') { $title = 'Perfumes For Him'; $query->whereIn('gender', ['Men', 'Male', 'Him']); }
            elseif ($gender == 'for-her') { $title = 'Perfumes For Her'; $query->whereIn('gender', ['Women', 'Female', 'Her']); }
            elseif ($gender == 'unisex') { $title = 'Unisex Collection'; $query->whereIn('gender', ['Unisex', 'All']); }
        }
        $products = $query->latest()->get();
        $counts = ['stock_in' => 0, 'stock_out' => 0, 'gender_him' => 0, 'gender_her' => 0, 'gender_unisex' => 0, 'size_50ml' => 0, 'size_100ml' => 0];
        foreach($products as $product) {
            $inStock = $product->variants->sum('stock') > 0;
            if($inStock) $counts['stock_in']++; else $counts['stock_out']++;
            $g = strtolower($product->gender);
            if(in_array($g, ['men', 'man', 'him', 'male'])) $counts['gender_him']++;
            elseif(in_array($g, ['women', 'woman', 'her', 'female'])) $counts['gender_her']++;
            else $counts['gender_unisex']++;
            $sizes = $product->variants->pluck('size')->map(fn($s) => strtolower($s))->toArray();
            if(in_array('50ml', $sizes)) $counts['size_50ml']++;
            if(in_array('100ml', $sizes)) $counts['size_100ml']++;
        }
        return view($view, compact('title', 'products', 'counts'));
    }

    public function allProducts()
    {
        return $this->handleAllProducts('nurah.all-products');
    }

    public function v3AllProducts()
    {
        return $this->handleAllProducts('v3.all-products');
    }

    public function ajmalAllProducts()
    {
        return $this->handleAllProducts('v4.all-products');
    }

    private function handleAllProducts($view)
    {
        $products = \App\Models\Product::where('status', 'active')->with(['variants', 'images'])->latest()->get();
        $counts = ['stock_in' => 0, 'stock_out' => 0, 'gender_him' => 0, 'gender_her' => 0, 'gender_unisex' => 0, 'size_50ml' => 0, 'size_100ml' => 0];
        foreach($products as $product) {
            $inStock = $product->variants->sum('stock') > 0;
            if($inStock) $counts['stock_in']++; else $counts['stock_out']++;
            $g = strtolower($product->gender);
            if(in_array($g, ['men', 'man', 'him'])) $counts['gender_him']++;
            elseif(in_array($g, ['women', 'woman', 'her'])) $counts['gender_her']++;
            else $counts['gender_unisex']++;
            $sizes = $product->variants->pluck('size')->map(fn($s) => strtolower($s))->toArray();
            if(in_array('50ml', $sizes)) $counts['size_50ml']++;
            if(in_array('100ml', $sizes)) $counts['size_100ml']++;
        }
        $bundles = \App\Models\Bundle::where('status', 'active')->where('type', '!=', 'pool')->with(['products.variants'])->latest()->get();
        return view($view, ['title' => 'All Perfumes', 'products' => $products, 'counts' => $counts, 'bundles' => $bundles]);
    }

    public function combos()
    {
        return $this->handleCombos('nurah.combos');
    }

    public function v3Combos()
    {
        return $this->handleCombos('v3.combos');
    }

    private function handleCombos($view)
    {
        $type = (str_starts_with($view, 'v3.')) ? 'bundle' : '!= pool';
        $query = \App\Models\Bundle::where('status', 'active');
        
        if (str_starts_with($view, 'v3.')) {
            $query->where('type', 'bundle');
        } else {
            $query->where('type', '!=', 'pool');
        }

        $bundles = $query->with(['products.variants'])->orderBy('type', 'asc')->latest()->get();
        return view($view, ['title' => 'Combos & Bundles', 'bundles' => $bundles]);
    }

    public function combo(Request $request)
    {
        return $this->handleCombo($request, 'nurah.bundle-main');
    }

    public function v3Combo(Request $request)
    {
        return $this->handleCombo($request, 'v3.bundle-main');
    }

    private function handleCombo(Request $request, $view)
    {
        $id = $request->query('id');
        $bundle = \App\Models\Bundle::where('status', 'active')->with(['products.images', 'products.variants'])->findOrFail($id);
        $relatedBundles = \App\Models\Bundle::where('status', 'active')->where('id', '!=', $id)->inRandomOrder()->limit(4)->get();
        return view($view, compact('bundle', 'relatedBundles'));
    }

    public function product(Request $request)
    {
        return $this->handleProduct($request, 'nurah.product-main');
    }

    public function v3Product(Request $request)
    {
        return $this->handleProduct($request, 'v3.product-main');
    }

    public function ajmalProduct(Request $request)
    {
        return $this->handleProduct($request, 'v4.product-main');
    }

    private function handleProduct(Request $request, $view)
    {
        $id = $request->query('id');
        $product = \App\Models\Product::where('status', 'active')->with(['variants', 'images'])->findOrFail($id);
        $recentlyViewed = session()->get('recently_viewed', []);
        if(($key = array_search($id, $recentlyViewed)) !== false) { unset($recentlyViewed[$key]); }
        array_unshift($recentlyViewed, $id);
        $recentlyViewed = array_slice($recentlyViewed, 0, 4);
        session()->put('recently_viewed', $recentlyViewed);
        $relatedIds = array_diff($recentlyViewed, [$id]);
        if(count($relatedIds) > 0) {
            $relatedProducts = \App\Models\Product::whereIn('id', $relatedIds)->where('status', 'active')->with(['images', 'variants'])->get()->sortBy(function($model) use ($relatedIds) { return array_search($model->id, $relatedIds); });
        } else { $relatedProducts = collect(); }
        $coupon = $this->getActiveCoupon($product);
        $bundle = $product->bundles()->where('status', 'active')->where('type', 'bundle')->first();
        $packBundles = $product->bundles()->where('status', 'active')->where('type', 'pack')->get();
        $poolBundles = $product->bundles()->where('status', 'active')->where('type', 'pool')->with('products')->get();
        return view($view, compact('product', 'relatedProducts', 'coupon', 'bundle', 'packBundles', 'poolBundles'));
    }

    public function velvetProduct($id)
    {
        $product = \App\Models\Product::where('status', 'active')->with(['variants', 'images'])->findOrFail($id);
        $bundle = $product->bundles()->where('status', 'active')->where('type', 'bundle')->first();
        $packBundles = $product->bundles()->where('status', 'active')->where('type', 'pack')->get();
        $poolBundles = $product->bundles()->where('status', 'active')->where('type', 'pool')->with('products')->get();
        $collections = \App\Models\Collection::where('status', 1)->get();
        return view('velvet.product-main', compact('product', 'bundle', 'packBundles', 'poolBundles', 'collections'));
    }

    public function shippingPolicy() { return view('nurah.shipping-policy'); }
    public function returnPolicy() { return view('nurah.return-policy'); }
    public function termsOfService() { return view('nurah.terms-of-service'); }

    public function checkout()
    {
        return $this->handleCheckout('nurah.checkout');
    }

    public function v3Checkout()
    {
        return $this->handleCheckout('v3.checkout');
    }

    private function handleCheckout($view)
    {
        $cart = [];
        $address = null;
        if(\Illuminate\Support\Facades\Auth::check()) {
             $address = \App\Models\UserAddress::where('user_id', \Illuminate\Support\Facades\Auth::id())->where('is_default', true)->first();
             if(!$address) { $address = \App\Models\UserAddress::where('user_id', \Illuminate\Support\Facades\Auth::id())->first(); }
             $items = \App\Models\Cart::where('user_id', \Illuminate\Support\Facades\Auth::id())->with(['product.discounts', 'product.images', 'product.variants', 'bundle'])->get();
             foreach($items as $item) {
                 $stock = 0;
                 if($item->product_id && $item->product) {
                    $price = $item->product->starting_price;
                    $variantId = null;
                    if ($item->size) { 
                        $variant = $item->product->variants->where('size', $item->size)->first(); 
                        $stock = $variant ? $variant->stock : 0; 
                        if ($variant) {
                            $price = $variant->price;
                            $variantId = $variant->id;
                        }
                    }
                    else { $stock = $item->product->variants->sum('stock'); }
                    
                    if($stock > 0) {
                        $cart[$item->product_id . '-' . $item->size] = [
                            "name" => $item->product->title, 
                            "quantity" => $item->quantity, 
                            "price" => $price, 
                            "image" => $item->product->main_image_url, 
                            "product_id" => $item->product_id, 
                            "variant_id" => $variantId,
                            "bundle_id" => null, 
                            "size" => $item->size, 
                            "type" => "product", 
                            "coupon" => $this->getActiveCoupon($item->product)
                        ];
                    }
                } elseif ($item->bundle_id && $item->bundle) {
                    if (!$item->bundle->is_out_of_stock) {
                        $cart['bundle-' . $item->bundle_id] = ["name" => $item->bundle->title, "quantity" => $item->quantity, "price" => $item->bundle->total_price, "image" => \Illuminate\Support\Facades\Storage::url($item->bundle->image), "product_id" => null, "bundle_id" => $item->bundle_id, "size" => null, "type" => "bundle"];
                    }
                }
             }
        } else {
            $sessionCart = session()->get('cart', []);
            foreach($sessionCart as $key => $item) {
                if(isset($item['type']) && $item['type'] == 'product' && isset($item['product_id'])) {
                    $product = \App\Models\Product::find($item['product_id']);
                    if($product) {
                        $stock = 0;
                        if(isset($item['size']) && $item['size']) { $variant = $product->variants->where('size', $item['size'])->first(); $stock = $variant ? $variant->stock : 0; }
                        else { $stock = $product->variants->sum('stock'); }
                        if($stock > 0) { $item['coupon'] = $this->getActiveCoupon($product); $cart[$key] = $item; }
                    }
                } elseif(isset($item['type']) && $item['type'] == 'bundle') {
                     if(isset($item['bundle_id'])) { $bundle = \App\Models\Bundle::find($item['bundle_id']); if ($bundle && !$bundle->is_out_of_stock) { $cart[$key] = $item; } }
                }
            }
        }
        $cartData = \App\Services\CartService::calculateTotal($cart);
        $total = $cartData['total'];
        $subtotal = $cartData['subtotal'];
        $savings = $cartData['savings'];
        return view($view, compact('cart', 'total', 'subtotal', 'savings', 'address'));
    }

    private function getActiveCoupon($product)
    {
        if(!$product) return null;
        return $product->discounts()->where('status', 'active')->where(function($q) { $q->whereNull('starts_at')->orWhere('starts_at', '<=', now()); })->where(function($q) { $q->whereNull('ends_at')->orWhere('ends_at', '>=', now()); })->orderByDesc('value')->first();
    }
}
