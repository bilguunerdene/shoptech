<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use Illuminate\Support\Facades\Input;
use Validator,Redirect,Response,File,Form,DB;
class CountryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        // $this->list_models();
        $country = Country::all();
        return view('country.list',compact('country'));
    }
    public function create(){
        $action = route('country.store');
        $method = "POST";
        $country = null;
        return view('country.add',compact('country','action', 'method'));
    }
    public function store(Request $request){
        $rules = array (
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    );
    $validator = Validator::make ( Input::all (), $rules );
    if ($validator->fails ())
        return redirect()->back()->withInput(Input::all())->withErrors($validator->getMessageBag()->ToArray());
    else {
           
    
        $country = new Country();
        $country->name = request('name');        
        $country->countrycode = request('countrycode');

        if ($files = $request->file('image')) {
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move(public_path('images'), $profileImage);
            $country->imageurl = $profileImage;
         }

        $country->save();
        return redirect()->back()->with(['status' => 'Saved.']);
    }
}
    public function destroy($id){
        $res = Country::find($id)->delete();
        if($res){
            return redirect()->back()->with(['status'=>"1","msg"=>"Deleted."]); 
        }
        return redirect()->back()->with(['status'=>"0","msg"=>"Error."]); 
        
    }
    public function edit($id){
        $country = Country::find($id);
        $action = route('country.update', ['id' => $id]);
        $method = "PUT";
        return view('country.add',compact('country','action','method'));
    }
    public function update(Request $request){
        $rules = array (
            'id' => 'required|numeric',
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    );
    $validator = Validator::make ( Input::all (), $rules );
    if ($validator->fails ())
        return redirect()->back()->withInput(Input::all())->withErrors($validator->getMessageBag()->ToArray());
    else {
           
    
        $country = Country::find(request('id'));
        $country->name = request('name');
        $country->countrycode = request('countrycode');
           

        if ($files = $request->file('image')) {
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move(public_path('images'), $profileImage);
            $country->imageurl = $profileImage;
         }

        $country->save();
        return redirect()->back()->with(['status' => 'Updated.']);
    }
    }
    // private function list_models (){
       
    //     $search = $this->request->query('searchText');
    //     $$conditions = [];
    //     if($search != null) {
    //         $conditions['OR'] = [
    //             ['types.name LIKE' => '%' . $search . '%']
    //         ];
    //     }
    
    //     $query = DB::table('types')->where($conditions);
         
    //  }
}
