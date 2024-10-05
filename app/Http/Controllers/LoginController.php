<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function signupdata(Request $request){

        $request->validate([
            'username' => 'required|min:4|regex:/[A-Z]/|regex:/[0-9]/',
            'password' => 'required|min:6|regex:/[A-Z]/|regex:/[0-9]/|regex:/[\W_]/',
            'email' => 'required|email',
            'cpassword' => 'required|same:password',
        ], [
            'username.required' => 'The username field is required.',
            'username.min' => 'The username must be at least 4 characters long.',
            'username.regex' => 'The username must contain at least one uppercase letter and one number.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 6 characters long.',
            'password.regex' => 'The password must contain at least one uppercase letter, one number, and one special character.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'cpassword.required' => 'The confirm password field is required.',
            'cpassword.same' => 'The confirm password must match the password.',
        ]);
        //
        if ($request->user_id != '') {
            $user = DB::table('user')
            ->where('user_id', $request->user_id)
            ->update([
                'user_username' => $request->username,
                'user_email' => $request->email,
                'user_ipassword' => ($request->password),
                'user_password' => bcrypt($request->password),
            ]);
            //
            $user = DB::table('user')->where('user_id', $request->user_id)->first();
                return redirect('/HomePage')->with('user', $user);
        } else {
            $user = DB::table('user')->insert([
                'user_username' => $request->username,
                'user_email' => $request->email,
                'user_ipassword' => ($request->password),
                'user_password' => bcrypt($request->password),
            ]);
            //
            return redirect()->route('signin')->with([
                'username' => $request->username,
                'password' => $request->password,
            ]);
        }
    }
    //
    public function signindata(Request $request) {
        // Validate the input
        $request->validate([
            'username' => 'required|min:4|regex:/[A-Z]/|regex:/[0-9]/',
            'password' => 'required|min:6|regex:/[A-Z]/|regex:/[0-9]/|regex:/[\W_]/',
        ], [
            'username.required' => 'The username field is required.',
            'username.min' => 'The username must be at least 4 characters long.',
            'username.regex' => 'The username must contain at least one uppercase letter and one number.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 6 characters long.',
            'password.regex' => 'The password must contain at least one uppercase letter, one number, and one special character.',
        ]);

        $user = DB::table('user')->where('user_username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->user_password)) {
            session(['loggedInUser' => $user]);
            return redirect()->route('HomePage');
        } else {
            return redirect()->back()->withErrors([
                'credentials' => 'The provided credentials do not match our records.',
            ])->withInput($request->except('password')); 
        }
        //
    }    
    //
    public function updateUser($user_id) {
        $user = DB::table('user')->where('user_id', $user_id)->first();
        return view('signup', ['user' => $user]);
    }
    //
    public function deleteUser($user_id) {
        DB::table('user')->where('user_id', $user_id)->delete();
        return redirect()->route('signin');
    }
}
