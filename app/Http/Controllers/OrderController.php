<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Order;
use Auth;
class OrderController extends Controller
{
    public function index(){

    }
    public function store(){
        
        foreach(Session::get('cart') as $id => $item){
            $order = new Order();
            $order->orderid = $item['id'];
            $order->productid = $item['id'];
            $order->createddate = date('Y-m-d');
            $order->user = Auth::user()->id;
            $order->quantity = $item['quantity'];
            $order->status = 1;
            $order->save();
        }
        Session::forget('cart');
        return redirect()->back()->with(['status' => 'Successfully ordered.']);
    }
}
