<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;
use Illuminate\Support\Facades\Input;
use Validator,Redirect,Response,File,Form,DB;
class BranchController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        // $this->list_models();
        $branch = Branch::all();
        return view('branch.list',compact('branch'));
    }
    public function create(){
        $action = route('branch.store');
        $method = "POST";
        $branch = null;
        return view('branch.add',compact('branch','action', 'method'));
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
           
    
        $branch = new Branch();
        $branch->name = request('name');        
        $branch->location = request('location');
        $branch->coordinate = request('coordinate');

        if ($files = $request->file('image')) {
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move(public_path('images'), $profileImage);
            $branch->imageurl = $profileImage;
         }

        $branch->save();
        return redirect()->back()->with(['status' => 'Saved.']);
    }
}
    public function destroy($id){
        $res = Branch::find($id)->delete();
        if($res){
            return redirect()->back()->with(['status'=>"1","msg"=>"Deleted."]); 
        }
        return redirect()->back()->with(['status'=>"0","msg"=>"Error."]); 
        
    }
    public function edit($id){
        $branch = Branch::find($id);
        $action = route('branch.update', ['id' => $id]);
        $method = "PUT";
        return view('branch.add',compact('branch','action','method'));
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
           
    
        $branch = Branch::find(request('id'));
        $branch->name = request('name');
        $branch->location = request('location');
        $branch->coordinate = request('coordinate');
           

        if ($files = $request->file('image')) {
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move(public_path('images'), $profileImage);
            $country->imageurl = $profileImage;
         }

        $branch->save();
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
