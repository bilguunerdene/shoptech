<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Type;
use App\Country;
use App\Product;
use Validator,Redirect,Response,File;
class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $product = Product::all();
        return view('product.list',compact('product'));
    }
    public function create(){
        $type = Type::all();
        // $country = Country::all();
        // var_dump($items);exit;
        $action = route('product.store');
        $product = null;
        $method = "POST";
        return view('product.add',compact('type', 'product', 'action', 'method'));
    }
    public function destroy($id){
        $res = Product::find($id)->delete();
        if($res){
            return redirect()->back()->with(['status'=>"1","msg"=>"Deleted."]); 
        }
        return redirect()->back()->with(['status'=>"0","msg"=>"Error."]); 
        
    }
    public function edit($id){
        $product = Product::find($id);
        $type = Type::all();
        $action = route('product.update', ['id' => $id]);
        $method = "PUT";
        return view('product.add',compact('type','product','action','method'));
    }
    public function update(Request $request){
        $rules = array (
            'id' => 'required|numeric',
            'name' => 'required',
            'barcode' => 'required|numeric',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'type' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    );
    $validator = Validator::make ( Input::all (), $rules );
    if ($validator->fails ())
        return redirect()->back()->withInput(Input::all())->withErrors($validator->getMessageBag()->ToArray());
    else {
           
    
        $product = Product::find(request('id'));
        $product->name = request('name');
        $product->barcode = request('barcode');
        $product->price = request('price');
        $product->cnt = request('quantity');
        $product->type = request('type');
        
        // $product->countryId = request('country');
        $product->detail = request('detail');

        if ($files = $request->file('image')) {
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move(public_path('images'), $profileImage);
            $product->imageurl = $profileImage;
         }

        $product->save();
        return redirect()->back()->with(['status' => 'Updated.']);
    }
    }
    public function store(Request $request){
        $rules = array (
            'name' => 'required',
            'barcode' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'type' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    );
    $validator = Validator::make ( Input::all (), $rules );
    if ($validator->fails ())
        return redirect()->back()->withInput(Input::all())->withErrors($validator->getMessageBag()->ToArray());
    else {
           
    
        $product = new Product();
        $product->name = request('name');
        $product->barcode = request('barcode');
        $product->price = request('price');
        $product->cnt = request('quantity');
        $product->type = request('type');
        
        // $product->countryId = request('country');
        $product->detail = request('detail');

        if ($files = $request->file('image')) {
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move(public_path('images'), $profileImage);
            $product->imageurl = $profileImage;
         }

        $product->save();
        return redirect()->back()->with(['status' => 'Saved.']);
    }
}
}
