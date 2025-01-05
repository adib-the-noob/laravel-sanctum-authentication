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
        return Product::find($id);
        
    }

    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        $product->update($request->all());
        return $product;
    }

    public function destroy(string $id)
    {
        $product = Product::destroy($id);
        return [
            "message"=> "product deleted!",
        ];
    }

    public function search(Request $request){
        $name = $request->query("name");
        $data = Product::where("name","like","%". $name ."%");

        return response()->json( $data );
    }

}