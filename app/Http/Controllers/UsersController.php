<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use App\Country;
use Illuminate\Support\Facades\Hash;
class UsersController extends Controller
{

    public function userLoginRegister(){
        return view('users.login_register');
    }

    public function login(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])) {
                Session::put('frontSession',$data['email']);
                return redirect('/cart');
            }else{
                return redirect()->back()->with('flash_message_error','Email o Password incorrecto!');
            }
        }
    }

    public function register(Request $request){
    	if ($request->isMethod('post')) {
    		$data = $request->all();
    		//verficar que el usuario existe
    		$usersCount = User::where('email',$data['email'])->count();
    		if ($usersCount>0) {
    			return redirect()->back()->with('flash_message_error','El Email ya existe!');
    		}{
                $user = new User;
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->save();
                if (Auth::attempt(['email'=>$data['email'], 'password'=>$data['password']])) {
                    Session::put('frontSession',$data['email']);
                    return redirect('/cart');
                }
            }
    	}
    }

    public function account(Request $request){
        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id);
        $countries = Country::get();
        if ($request->isMethod('post')) {
            $data = $request->all();

            if (empty($data['name'])) {
                return redirect()->back()->with('flash_message_error','Por favor, Ingrese su nombre!');
            }

            if (empty($data['address'])) {
                $data['address'] = '';
            }

            if (empty($data['city'])) {
                $data['address'] = '';
            }

            if (empty($data['state'])) {
                $data['address'] = '';
            }

            if (empty($data['country'])) {
                 $data['address'] = '';
            }

            if (empty($data['pincode'])) {
                $data['address'] = '';
            }

            if (empty($data['mobile'])) {
                $data['address'] = '';
            }

            $user = User::find($user_id);
            $user->name = $data['name'];
            $user->address = $data['address'];
            $user->city = $data['city'];
            $user->state = $data['state'];
            $user->country = $data['country'];
            $user->pincode = $data['pincode'];
            $user->mobile = $data['mobile'];
            $user->save();
            return redirect()->back()->with('flash_message_success','Tu cuenta ha sido actualizada!');

        }

        return view('users.account')->with(compact('countries','userDetails'));
    }

    public function chkUserPassword(Request $request){
        $data = $request->all();
        $current_password = $data['current_pwd'];
        $user_id = Auth::User()->id;
        $check_password = User::where('id',$user_id)->first();
        if (Hash::check($current_password,$check_password->password)) {
            echo "true"; die;
        }else{
            echo "false"; die;
        }
    }

    public function updatePassword(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->all();
            $old_pwd = User::where('id',Auth::User()->id)->first();
            $current_pwd = $data['current_pwd'];
            if (Hash::check($current_pwd,$old_pwd->password)) {
                //Actualizar
                $new_pwd = bcrypt($data['new_pwd']);
                User::where('id',Auth::User()->id)->update(['password'=>$new_pwd]);
                return redirect()->back()->with('flash_message_success','Password actualizada con exito!');
            }else{
                return redirect()->back()->with('flash_message_error','Password actual incorrecto');
            }
        }
    }

    public function logout(){
        Auth::logout();
        Session::forget('frontSession');
        return redirect('/');
    }

    public function checkEmail(Request $request){
    	//verficar que el usuario existe
    	$data = $request->all();
    	$usersCount = User::where('email',$data['email'])->count();
    	if ($usersCount>0) {
    		echo "false";
    	}else{
    		echo "true"; die;
    	}
    }
}
