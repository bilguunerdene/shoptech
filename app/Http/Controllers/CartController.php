<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
class CartController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $items = session()->get('cart');
        // var_dump($items);exit;
        return view('cart',compact('items'));
    }
    public function update(Request $request){
        $product = Product::find($request->id);
        $cart = session()->get('cart');
 
        // if cart is empty then this the first product
        if(!$cart) {
 
            $cart = [
                $product->id => [
                        "id" => $product->id,
                        "name" => $product->name,
                        "quantity" => $request->quantity,
                        "price" => $product->price,
                        "photo" => $product->imageurl
                    ]
            ];
 
            session()->put('cart', $cart);
 
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
 
        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$product->id])) {
 
            $cart[$product->id]['quantity']+=$request->quantity;
 
            session()->put('cart', $cart);
 
            return redirect()->back()->with('success', 'Product added to cart successfully!');
 
        }
 
        // if item not exist in cart then add to cart with quantity = 1
        $cart[$product->id] = [
            "id" => $product->id,
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "photo" => $product->imageurl
        ];
 
        session()->put('cart', $cart);
 
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    public function minus(Request $request){
        $product = Product::find($request->id);
        $cart = session()->get('cart');
        if(isset($cart[$product->id])) {
 
            $cart[$product->id]['quantity']-=$request->quantity;
 
            session()->put('cart', $cart);
 
            return redirect()->back()->with('success', 'Product added to cart successfully!');
 
        }
    }
    public function remove($id)
    {
        if($id) {
 
            $cart = session()->get('cart');
 
            if(isset($cart[$id])) {
 
                unset($cart[$id]);
 
                session()->put('cart', $cart);
            }
 
            session()->flash('success', 'Product removed successfully');
        }
    }
    
    public function removeAll(Request $request)
    {
        
            Session::forget('cart');
            return redirect()->back()->with('success', 'Cleared!');
        
    }
}
