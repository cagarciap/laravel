<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $data = []; //to be sent to the view

        $listProducts = array();
        $listProducts[121] = array("name"=>"Tv samsung", "price"=>"1000");
        $listProducts[11] = array("name"=>"Iphone", "price"=>"2000");

        $listProductsInCart = array();
        $ids = $request->session()->get("products"); //obtenemos ids de productos guardados en session
        //dd($ids);
        if($ids){
            foreach ($listProducts as $key => $product) {
                if(in_array($key, array_keys($ids))){
                    $listProductsInCart[$key] = $product;
                }
            }
        }

        $data["title"] = "Cart";
        $data["products"] = $listProducts;
        $data["productsInCart"] = $listProductsInCart;

        return view('cart.index')->with("data",$data);
    }

    public function add($id, Request $request)
    {
        $products = $request->session()->get("products");
        $products[$id] = $id;
        $request->session()->put('products', $products);
        return back();
    }

    public function removeAll(Request $request)
    {
        $request->session()->forget('products');
        return back();
    }
}
