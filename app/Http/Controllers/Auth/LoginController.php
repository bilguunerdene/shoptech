<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;
use Auth;
use Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login()
    {
        $rules = array(
            'email' => 'required|email',
            'password' => 'required|alphaNum|min:3'
        );
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return Redirect::to('login')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        }else{
            $user = ['email' => Input::get('email'), 'password' => Input::get('password')];
            if(Auth::attempt($user)){
                $user = Auth::User();
                $user->lastipaddr = $_SERVER['REMOTE_ADDR'];
                $user->save();
                return Redirect::to('/');
            }else{
                // var_dump($validator);
                // exit;
                return Redirect::to('login')
                    ->withErrors($validator)
                    ->withInput(Input::except('email'));
            }
        }
    }
    public function logout () {
        //logout user
        auth()->logout();
        // redirect to homepage
        return redirect('/');
    }
}
