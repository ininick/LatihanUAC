<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;
class AppController extends Controller
{
    public function index(){
        if(Auth::check()){
            if(session('overpaid')){
                // dd('masuk overpaid');
                return view ('pages.payment')->with('overpaid', '');
            }
            // dd('masuk balance(wd)');

            // dd(session('balance'));
            if(session('balance')){
                // dd('masuk balance(wd)');
                return view('pages.payment')->with('balance', '');
            }

            if(Auth::user()->paid == true){
                return view("pages.index");
            }
            return view("pages.payment");
        }
        return redirect()->route("home");
    }

    public function payment(Request $request){
        try{
            $request->validate([
                'pay'=>'required|numeric|min:0'
            ]);
            $user = User::find(Auth::id()); // Manually retrieve the user model
        $initialPayment = $user->payment; // Store the initial payment value
    
        if($initialPayment < $request->pay){ // Overpaid
            $user->payment = $request->pay - $initialPayment;
            $user->paid = true;
            $user->save(); // Save the updated payment to the database
            return redirect()->route('index')->with('overpaid', "You're overpaid");
        } else if($initialPayment > $request->pay) { // Underpaid
            $user->payment = $initialPayment - $request->pay;
            $user->save(); // Save the updated payment to the database
            return redirect()->route('index')->with('underpaid', 'You still underpaid');
        }
        $user->paid = true;
        $user->save(); // Save the updated payment to the database
        return redirect()->route('index')->with('success', "Thanks for the payment!");
    }catch(Exception $e){
        return redirect()->back()->with("error", $e->getMessage());
    }
}

    public function dashboard(Request $request){
        try {
            return view("pages.index");
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function overpaid(Request $request){
        try {
            // Validate the request data
            if($request->balance == 0){
                return redirect()->route('index')->with('balance','Withdraw Balance Request');
            }
            $request->validate([
                'balance' => 'required|numeric|min:0', // Ensure 'pay' is required, numeric, and non-negative
            ]);
            
            $user = User::find(Auth::id());
            if($request->balance > $user->payment){
                throw new Exception('Balance must be under the overpaid value');
            }
            // If the validation passes, update the payment
            $user->payment = $user->payment - $request->balance; // Assign the value from the request
            $user->save(); // Save the updated payment to the database
            // dd($user->payment);
            return redirect()->route('index')->with('withdraw', 'Payment updated successfully.');
        } catch (Exception $e) {
            // Handle any errors that occur
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    

    public function profileView(){
        return view("pages.profile");
    }

}


