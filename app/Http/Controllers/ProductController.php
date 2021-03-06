<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Type;
use App\Country;
use App\Product;
use App\Favourite;
use Validator,Redirect,Response,File,Form,DB,Auth;
class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        // $product = Product::leftJoin('country','country.id','products.countryId')->where('id', 1);
        $product = DB::table('products')->leftjoin('country','country.id','products.countryId')
        ->leftjoin('types','types.id','products.type')
        ->select('products.*','country.name as country','types.name as type')
        ->get();
        return view('product.list',compact('product'));
    }
    public function show($id){
        $product = DB::table("products")->leftjoin('country','country.id','products.countryId')
        ->leftjoin('types','types.id','products.type')->where("products.id",$id)
        ->select('products.*','country.name as country','types.name as type')->get();
        // print_r($product);
        // exit;
        return view('product.show',compact('product'));
    }
    public function create(){
        $type =  Type::all('name', 'id');
        $country = Country::all('name','id');
        // var_dump($items);exit;
        $action = route('product.store');
        $product = null;
        $method = "POST";
        return view('product.add',compact('type', 'country', 'product', 'action', 'method'));
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
        $type =  Type::all('name', 'id');
        $country = Country::all('name','id');
        $action = route('product.update', ['id' => $id]);
        $method = "PUT";
        return view('product.add',compact('type','country','product','action','method'));
    }
    public function update(Request $request){
        $rules = array (
            'id' => 'required|numeric',
            'article_number' => 'required',
            'name' => 'required',
            'barcode' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'type' => 'required'
    );
    $validator = Validator::make ( Input::all (), $rules );
    if ($validator->fails ())
        return redirect()->back()->withInput(Input::all())->withErrors($validator->getMessageBag()->ToArray());
    else {
           
    
        $product = Product::find(request('id'));
        $product->article_number = request('article_number');
        $product->name = request('name');
        $product->barcode = request('barcode');
        $product->price = request('price');
        $product->inprice = request('inprice');
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
            'article_number' => 'required',
            'barcode' => 'required',
            'inprice' => 'required|numeric',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'type' => 'required',
            'country' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    );
    $validator = Validator::make ( Input::all (), $rules );
    if ($validator->fails ())
        return redirect()->back()->withInput(Input::all())->withErrors($validator->getMessageBag()->ToArray());
    else {
           
    
        $product = new Product();
        $product->name = request('name');
        $product->article_number = request('article_number');
        $product->barcode = request('barcode');
        $product->inprice = request('inprice');
        $product->price = request('price');
        $product->cnt = request('quantity');
        $product->type = request('type');
        $product->countryId = request('country');
        
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
    public function addtofav(Request $request){
        $favourite = DB::table('favourites')->where('favourites.productid',$request->id);
        if($favourite->count()>0){
            $favourite->delete();
            return redirect()->back()->with('success', 'Removed from favourite items!');
        }
        $favourite = new Favourite();
        $favourite->userid = Auth::user()->id;
        $favourite->productid = $request->id;
        $favourite->createddate = date('Y-m-d');
        $favourite->save();
        return redirect()->back()->with('success', 'Added to favourite items!');
    }
    public function favourite(){
        $userid = Auth::user()->id;
        $product = DB::table('favourites')->leftjoin('products','products.id','favourites.productid','favourites.userid',Auth::user()->id)
        ->select('products.*','favourites.id as favid','favourites.userid as fuserid')->where('favourites.userid','=',$userid)
        ->orderByRaw('products.name asc')
        ->paginate(12);
        // print_r($product);
        // exit;
        return view('home',compact('product'));
    }
}
