<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Http\Requests\ProductsRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the product.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request): \Illuminate\View\View
    {
        $products = $request;

        $products = Product::orderBy('id', 'ASC')
            ->brand($products->brand)
            ->name($products->name)
            ->price($products->price)
            ->paginate(20);

        return view('admin.products.index')->with('products', $products);
    }

    /**
     * Display a listing of the product.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function panel(Request $request): \Illuminate\View\View
    {
        $products = $request;

        $products = Product::orderBy('id', 'ASC')
            ->brand($products->brand)
            ->name($products->name)
            ->price($products->price)
            ->enabled($products->enabled)
            ->paginate(20);

        return view('admin.products.panel')->with('products', $products);
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\View\View
     */
    public function create(): \Illuminate\View\View
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @param ProductsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductsRequest $request): \Illuminate\Http\RedirectResponse
    {
        $product = new Product($request->validated());
        $product->image = $request->file('image')->store('images', 'public');
        $product->save();

        // Optimizing the image
        $image = Image::make(storage_path('app/public/' . $product->image));
        $image->widen(600)->limitColors(255, '#ff9900')->encode();
        Storage::put($product->image, (string) $image);

        return redirect()
            ->route('products.index')
            ->with('message', 'Product Created');
    }

    /**
     * Display the specified product.
     *
     * @param  Product $product
     * @return \Illuminate\View\View
     */
    public function show(Product $product): \Illuminate\View\View
    {
        return view('admin.products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param Product $product
     * @return \Illuminate\View\View
     */
    public function edit(Product $product): \Illuminate\View\View
    {
        return view('admin.products.edit')->with('product', $product);
    }

    /**
     * Update the specified product in storage.
     *
     * @param Product $product
     * @param ProductsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Product $product, ProductsRequest $request): \Illuminate\Http\RedirectResponse
    {


        if ($request->hasFile('image')) {

            // Removing old image from folders
            Storage::disk('public')->delete($product->image);
            Storage::delete($product->image);

            // Loading new image
            $product->fill($request->validated());
            $product->image = $request->file('image')->store('images', 'public');
            $product->save();

            // Optimizing the new image
            $image = Image::make(storage_path('app/public/' . $product->image));
            $image->widen(600)->limitColors(255, '#ff9900')->encode();
            Storage::put($product->image, (string) $image);
        } else {

            // dd($product);
            // Updating without the image
            $product->update($request->validated());
        }

        return redirect()
            ->route('products.index')
            ->with('message', "Edited Product $product->name");
    }

    /**
     * Remove the specified product from storage.
     *
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product): \Illuminate\Http\RedirectResponse
    {
        // Removing image from folders
        Storage::disk('public')->delete($product->image);
        Storage::delete($product->image);

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('message', 'Product Removed');
    }
}
