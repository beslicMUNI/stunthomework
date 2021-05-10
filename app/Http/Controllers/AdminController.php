<?php

namespace App\Http\Controllers;

use App\Position;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //

    public function index(){
        return view('admin.index');
    }

    public function addEmployee(){
        $positions = Position::all();
        return view('admin.create', ['positions'=>$positions]);
    }

    public function store(Request $request){
        $request->validate([
            'email' => 'email|required',
            'name' => 'required', 
            'password'=> 'required|min:6'
        ]); 

        $user = new User();

        $data = $request->only($user->getFillable());
        $user->fill($data);
        $user->password = Hash::make($request->passwod);

        if($user->save()){
            return 'Saved succesfully';
        }


        // $user->name = $request->name;
        // $user->password = Hash::make($request->passwod);
        // $user->role = 'employee';
        // $user->contract_type = $request->contract_type;

    }
}
