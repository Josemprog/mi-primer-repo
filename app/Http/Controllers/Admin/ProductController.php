<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests\SaveProducts;
use App\Http\Controllers\Controller;

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
            ->email($products->email)
            ->unit_price($products->unit_price)
            ->paginate(9);

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
            ->email($products->email)
            ->unit_price($products->unit_price)
            ->enabled($products->enabled)
            ->paginate(4);

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
     * Store a newly created product in storage.
     *
     * @param SaveProducts $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SaveProducts $request): \Illuminate\Http\RedirectResponse
    {
        $product = new Product($request->validated());
        $product->image = $request->file('image')->store('images', 'public');
        $product->save();
        return redirect()->route('products.index');
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
     * @param SaveProducts $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Product $product, SaveProducts $request): \Illuminate\Http\RedirectResponse
    {

        if ($request->hasFile('image')) {
            $product->fill($request->validated());
            $product->image = $request->file('image')->store('images', 'public');
        } else {
            $product->update($request->validated());
        }

        $product->save();

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified product from storage.
     *
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product): \Illuminate\Http\RedirectResponse
    {
        $product->delete();

        return redirect()->route('products.index');
    }
}
