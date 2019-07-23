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
        return view('product.add',compact('type'));
    }
    public function destroy($id){
        $res = Product::find($id)->delete();
        if($res){
            return redirect()->back()->with(['status'=>"1","msg"=>"Deleted."]); 
        }
        return redirect()->back()->with(['status'=>"0","msg"=>"Error."]); 
        
    }
    public function store(Request $request){
        $rules = array (
            'name' => 'required|alpha',
            'barcode' => 'required|number',
            'price' => 'required|number',
            'cnt' => 'required|number',
            'type' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    );
    $validator = Validator::make ( Input::all (), $rules );
    if ($validator->fails ())
        return Response::json ( array (             
                'errors' => $validator->getMessageBag ()->toArray () 
        ) );
    else {
           
    
        $product = new Product();
        $product->name = request('name');
        $product->barcode = request('barcode');
        $product->price = request('price');
        $product->cnt = request('cnt');
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
