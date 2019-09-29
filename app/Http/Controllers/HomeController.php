<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use DB;
use Session;
use App\Type;
use App\Country;
use Illuminate\Support\Facades\Input;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $type = Type::all();
        $country = Country::all();
        // $product = Product::orderBy('name','asc')->paginate(12);
        $product = DB::table('products as p')->leftjoin('favourites as f','p.id','f.productid')
        ->select('p.*','f.id as favid')
        ->orderByRaw('p.name asc')->paginate(12);
        return view('home',compact('product','country','type'));
    }
    public function search(){
        $type = Type::all();
        $country = Country::all();
        $name = request('name');
        $product = DB::table('products as p')->leftjoin('favourites as f','p.id','f.productid')
        ->select('p.*','f.id as favid')
        ->where('p.name', 'like', $name.'%')
        ->orderByRaw('p.name asc')
        ->paginate(12);
        
        return view('home',compact('product','country','type'));
    }
    public function filter(Request $request){
        $type = Type::all();
        $product = DB::table('products as p')->leftjoin('favourites as f','p.id','f.productid');
        if ($request->has('type')&&$request->type!='All') {
            $product->where('type', '=', $request->type);
        }
        if ($request->has('countryId')&&$request->countryId!='All') {
            $product->where('countryId', '=', $request->countryId);
        }
        $country = Country::all();
        $product = $product->select('p.*','f.id as favid')
        ->orderByRaw('p.name asc')->paginate(12);
        return view('home',compact('product','country','type'));
    }
    public function welcome(){
        $country = Country::all();
        $type = Type::all();
        return view('welcome',compact('country','type'));
    }
}
