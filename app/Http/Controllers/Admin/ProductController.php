<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProductsExport;
use App\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Http\Requests\ProductsRequest;
use App\Http\Controllers\Controller;
use App\Jobs\NotifyUserOfCompletedExport;
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
            ->paginate(10);

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
    public function store(ProductsRequest $request)
    {
        $product = new Product($request->validated());
        $product->image = $request->file('image')->store('images', 'public');
        $product->save();

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
        // dd($request->hasFile('image'));
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($product->image);
            Storage::delete($product->image);

            $product->fill($request->validated());
            $product->image = $request->file('image')->store('images');
            $product->save();

            // dd(Image::make(Storage::get($product->image)));

            $image = Image::make(Storage::get($product->image));
            $image->widen(600)->limitColors(255, '#ff9900')->encode();
            Storage::put($product->image, (string )$image);
        } else {
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
        Storage::disk('public')->delete($product->image);
        Storage::delete($product->image);

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('message', 'Product Removed');
    }

    /**
     * Export all products
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function export()
    {
        $user = auth()->user();
        $filePath = asset('storage/products.csv');

        (new ProductsExport())->store('products.csv', 'public')->chain([
            new NotifyUserOfCompletedExport($user, $filePath)
        ]);

        return back()->with('message', 'The export has started, we will send you an email when it is ready.');
    }
}
