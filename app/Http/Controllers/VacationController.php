<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VacationController extends Controller
{
    //
    public function index(){
        return view('vacations.index');
    }

    public function store(Request $request){
        $user = Auth::user();

        if($user->contract_type == 'limited'){

        } else {
            
        }
    }
}
