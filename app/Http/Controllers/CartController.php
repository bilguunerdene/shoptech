<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product, App\Branch;
use Redirect;
use Session;
class CartController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        $items = session()->get('cart')!=null?session()->get('cart'):array();
        $branch = Branch::all();
        $cartitem = Session::get('cart');
        $total = 0;
        if($cartitem!=null){
            foreach($cartitem as $item){
                $total += $item['quantity']*$item['inprice'];
            }
        }
        // var_dump($items);exit;
        return view('cart',compact('items','total','branch'));
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
                        "quantity" => $product->cnt,
                        "price" => $product->price,
                        "inprice" => $product->inprice,
                        "photo" => $product->imageurl,
                        "cnt" => $product->cnt
                    ]
            ];
 
            session()->put('cart', $cart);
 
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
 
        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$product->id])) {
 
            $cart[$product->id]['quantity']+=$product->cnt;
 
            session()->put('cart', $cart);
 
            return redirect()->back()->with('success', 'Product added to cart successfully!');
 
        }
        $cart[$product->id] = [
            "id" => $product->id,
            "name" => $product->name,
            "quantity" => $product->cnt,
            "price" => $product->price,
            "inprice" => $product->inprice,
            "photo" => $product->imageurl,
            "cnt" => $product->cnt
        ];

        session()->put('cart', $cart);
 
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    public function updateval(Request $request){
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
                        "inprice" => $product->inprice,
                        "photo" => $product->imageurl,
                        "cnt" => $product->cnt
                    ]
            ];
 
            session()->put('cart', $cart);
 
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
 
        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$product->id])) {
 
            $cart[$product->id]['quantity']=$request->quantity;
 
            session()->put('cart', $cart);
 
            return redirect()->back()->with('success', 'Product added to cart successfully!');
 
        }
        $cart[$product->id] = [
            "id" => $product->id,
            "name" => $product->name,
            "quantity" => $request->quantity,
            "price" => $product->price,
            "inprice" => $product->inprice,
            "photo" => $product->imageurl,
            "cnt" => $product->cnt
        ];

        session()->put('cart', $cart);
 
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    public function minus(Request $request){
        $product = Product::find($request->id);
        $cart = session()->get('cart');
        if(isset($cart[$product->id])) {
            
            $cart[$product->id]['quantity']-=$product->cnt;
 
            if($cart[$product->id]['quantity']<=0){
                unset($cart[$product->id]);
                session()->put('cart', $cart);
            }
            session()->put('cart', $cart);
 
            return redirect()->back()->with('success', 'Product decreased to cart successfully!');
 
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
 
            return Redirect::to('cart')->with("status","Product removed successfully");
        }
    }
    
    public function removeAll(Request $request)
    {
        
            Session::forget('cart');
            return redirect()->back()->with('status', 'Cleared shopping bag!');
        
    }
}
