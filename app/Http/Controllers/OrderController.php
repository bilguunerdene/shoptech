<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Session;
use App\Order,App\Suborder;
use Validator,Redirect,Response,File,Form,DB,Auth;
class OrderController extends Controller
{
    public function index(){
        return view('order.settings');
    }
    public function store(){
        $rules = array (
            'branch' => 'required',
            'orderdate' => 'required'
    );
    $validator = Validator::make ( Input::all (), $rules );
    if ($validator->fails ())
        return redirect()->back()->withInput(Input::all())->withErrors($validator->getMessageBag()->ToArray());
    else {
        $orderid = DB::table('orders')->insertGetId(
            [ 'orderid' => 1,
              'createddate' => date('Y-m-d'),
              'user' => Auth::user()->id,
              'description' => request('description'),
              'recdate' => request('orderdate'),
              'branchid' => request('branch'),
              'status' => 1 ]
        );
        
        foreach(Session::get('cart') as $id => $item){
            $suborder = new Suborder();
            $suborder->orderid = $orderid;
            $suborder->productid = $item['id'];
            $suborder->quantity = $item['quantity'];
            $suborder->price = $item['price'];
            $suborder->createddate = date('Y-m-d');
            $suborder->save();
        }
        Session::forget('cart');
        return redirect()->back()->with(['status' => 'Successfully ordered.']);
    }
    }
    public function list(){
        $order = DB::table('orders')->leftjoin('branch','branch.id','orders.branchid')
        ->leftjoin('users','users.id','orders.user')
        ->select('orders.*','users.name as username','branch.name as branchname')
        ->get();
        return view('order.list',compact('order'));
    }
    public function show($id){
        $order = DB::table('suborders')->leftjoin('products','products.id','suborders.productid')
        ->select('suborders.*','products.name','products.barcode','products.imageurl')->where('suborders.orderid',$id)->get();
        return view('order.show',compact('order'));
    }
    public function user(){
        return view('order.user');
    }
}
