<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return $products;
    }

    // POST 
    public function store(Request $request)
    {
        // validation
        $request->validate([
            'name'=> 'required',
            "price"=> "required|numeric",
            "slug"=> "required|unique:products,slug",
        ]);

        $product = Product::create($request->all());

        return [
            "message" => "product added successfully!",
            "status" => "success",
            "data" => [
                "id" => $product->id,
                "name" => $product->name,
                "price" => $product->price,
                "slug" => $product->slug,
                "description"=> $product->description,
                ]
            ];
    }

    public function show(string $id)
    {
        $product = Product::find($id);
        return $product;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
