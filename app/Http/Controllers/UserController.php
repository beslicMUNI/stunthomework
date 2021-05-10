<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function login(Request $request){
        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $user = Auth::user();
            if($user->role === 'admin'){
                return redirect()->route('admin');
            } else {
                return redirect()->route('vacations');
            }
        } else {

            return 'bad credentials';
        }
    }
}
