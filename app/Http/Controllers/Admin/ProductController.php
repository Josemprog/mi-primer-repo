<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $brand = $request->get('brand');
        $name = $request->get('name');
        $email = $request->get('email');
        $unit_price = $request->get('unit_price');

        $products = Product::orderBy('id', 'ASC')
            ->brand($brand)
            ->name($name)
            ->email($email)
            ->unit_price($unit_price)
            ->paginate(3);

        return view('admin.products.index')->with('products', $products);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function panel(Request $request)
    {
        $brand = $request->get('brand');
        $name = $request->get('name');
        $email = $request->get('email');
        $unit_price = $request->get('unit_price');
        $enabled = $request->get('enabled');

        $products = Product::orderBy('id', 'ASC')
            ->brand($brand)
            ->name($name)
            ->email($email)
            ->unit_price($unit_price)
            ->enabled($enabled)
            ->paginate(4);

        return view('admin.products.panel')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->brand = $request->brand;
        $product->name = $request->name;
        $product->unit_price = $request->unit_price;
        $product->quantity = $request->quantity;
        $product->description = $request->description;
        $product->image = $request->file('image')->store('images', 'public');
        $product->save();
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product, Request $request)
    {
        $product->update([
            'brand' => $request->brand,
            'name' => $request->name,
            'unit_price' => $request->unit_price,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'enabled' => $request->select,
            'image' => $request->file('image')->store('images', 'public'),
        ]);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index');
    }
}
