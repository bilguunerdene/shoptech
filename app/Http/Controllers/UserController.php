<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Input;
use Validator,Redirect,Response,File,Form,DB;
class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        // $this->list_models();
        $user = User::all();
        return view('user.list',compact('user'));
    }
    public function create(){
        $action = route('user.store');
        $method = "POST";
        $user = null;
        return view('user.add',compact('user','action', 'method'));
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
           
    
        $user = new User();
        $user->name = request('name');        
        $user->email = request('email');
        $user->permissionId = request('permission');
        $user->branchid = request('branch');
        $user->password = Hash::make(request('password'));

        if ($files = $request->file('image')) {
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move(public_path('images'), $profileImage);
            $user->imageurl = $profileImage;
         }

        $user->save();
        return redirect()->back()->with(['status' => 'Saved.']);
    }
}
    public function edit($id = null){

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
