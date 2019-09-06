<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Permission;
use App\Branch;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Validator,Redirect,Response,File,Form,DB;
class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        // $this->list_models();
        $user = DB::table('users')->leftjoin('branch','branch.id','users.branchid')
        ->leftjoin('permission','permission.id','users.permissionId')
        ->select('users.*','permission.name as permission','branch.name as branch')
        ->get();
        return view('user.list',compact('user'));
    }
    public function create(){
        $action = route('user.store');
        $method = "POST";
        $user = null;
        $permission = Permission::all();
        $branch = Branch::all();
        return view('user.add',compact('user','action', 'method','permission','branch'));
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
        
        $user->status = 1;
        if ($files = $request->file('image')) {
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move(public_path('images'), $profileImage);
            $user->imageurl = $profileImage;
         }

        $user->save();
        return redirect()->back()->with(['status' => 'Saved.']);
    }
}
    public function destroy($id){
        $res = User::find($id)->delete();
        if($res){
            return redirect()->back()->with(['status'=>"1","msg"=>"Deleted."]); 
        }
        return redirect()->back()->with(['status'=>"0","msg"=>"Error."]); 
        
    }
    public function edit($id){
        $user = User::find($id);
        $branch =  Branch::all('name', 'id');
        $permission = Permission::all('name','id');
        $action = route('user.update', ['id' => $id]);
        $method = "PUT";
        return view('user.add',compact('branch','permission','user','action','method'));
    }
    public function update(Request $request){
        $rules = array (
            'id' => 'required|numeric',
            'name' => 'required',
            'email' => 'required|email',
            'branch' => 'required',
            'permission' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    );
    $validator = Validator::make ( Input::all (), $rules );
    if ($validator->fails ())
        return redirect()->back()->withInput(Input::all())->withErrors($validator->getMessageBag()->ToArray());
    else {
           
    
        $user = User::find(request('id'));
        $user->name = request('name');
        $user->email = request('email');
        $user->branchid = request('branch');
        $user->permissionId = request('permission');
        if(request('password')!=''){
            $user->password = Hash::make(request('password'));
        }
        

        if ($files = $request->file('image')) {
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move(public_path('images'), $profileImage);
            $user->imageurl = $profileImage;
         }

        $user->save();
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
