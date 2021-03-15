<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /*public function show($id)
    {
        if($id != 121){
            return view('home.index'); 
        }else{
            $data = []; //to be sent to the view

            $listProducts = array();
            $listProducts[121] = array("name"=>"Tv samsung", "price"=>"100");
            $listOfSizes = array("XS","S","M","L","XL");

            $data["title"] = $listProducts[$id]["name"];
            $data["product"] = $listProducts[$id];
            $data["sizes"] = $listOfSizes;
            return view('product.show')->with("data",$data); 
        }
    }*/

    /*public function show($id)
    {
        $data = []; //to be sent to the view
        $listProducts = array();
        $listProducts[121] = array("name"=>"Tv samsung", "price"=>"100");
        $listOfSizes = array("XS","S","M","L","XL");
        if (!array_key_exists($id, $listProducts)){
            return view('home.index');
        }
        $data["title"] = $listProducts[$id]["name"];
        $data["product"] = $listProducts[$id];
        $data["sizes"] = $listOfSizes;
        return view('product.show')->with("data",$data); 
    }*/

    public function show($id)
    {
        $data = []; //to be sent to the view
        $product = Product::findOrFail($id);
        $listOfSizes = array("XS","S","M","L","XL");

        $data["title"] = $product->getName();
        $data["product"] = $product;
        $data["sizes"] = $listOfSizes;
        return view('product.show')->with("data",$data);
    }


    /*public function create()
    {
        $data = []; //to be sent to the view
        $data["title"] = "Create product";

        return view('product.create')->with("data",$data);
    }*/

    public function create()
    {
        $data = []; //to be sent to the view
        $data["title"] = "Create product";
        $data["products"] = Product::all();

        return view('product.create')->with("data",$data);
    }


    /*public function save(Request $request)
    {
        $request->validate([
            "name" => "required",
            "price" => "required",
            "price" => "gt:0"
        ]);
        return view('layouts.success')->with("data",$request->input("name"));
        //dd($request->all());
        //here goes the code to call the model and save it to the database
    }*/

    public function save(Request $request)
    {
        $request->validate([
            "name" => "required",
            "price" => "required|numeric|gt:0"
        ]);
        Product::create($request->only(["name","price"]));

        return back()->with('success','Item created successfully!');
    }


    
}
