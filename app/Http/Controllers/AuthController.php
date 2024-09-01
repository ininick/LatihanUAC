<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginView($lang = 'en'){
        App::setlocale($lang);
        return view('pages.auth.login');
    }

    public function login(Request $request){
        try{
            $credential = $request->validate([
                'email'=>'required|email',
                'password'=>'required|min:8',
            ]);
            if (Auth::attempt($credential)) {
                return redirect()->route('index')->with('success', 'Login Successful!');
            } else {
                return redirect()->route('login')->with('error', 'User not found!');
            }  
            throw new Exception('Login Failed!');
        }catch(Exception $e){
        return redirect()->route('login')->with('error', $e->getMessage());
        }
    }

    public function registerView($lang = 'en'){
        App::setlocale($lang);
        return view('pages.auth.register');
    }

    public function register(Request $request){
        try{
            $credential = $request->validate([
                'name' => 'string|required',
                'email' => 'required|email',
                'password' => 'required|min:8|confirmed',
                'gender' => 'required',
                'interest' => 'required|array|min:3',
                'linkedin'=>'required',
                'phone'=>'required|numeric',
                'education'=>'required'
            ]);
            $credential['interest'] = json_encode($request->input('interest'));
            $credential['password'] = bcrypt($credential['password']);
            $credential['payment'] = rand(100000,125000);

            // dd($credential);
            User::create($credential);

            return redirect()->route('login')->with('success','Registration Successful!');
        }catch(Exception $e){
            return redirect()->route('register')->with('error', $e->getMessage());
        }
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect()->route('home');
    }
}
