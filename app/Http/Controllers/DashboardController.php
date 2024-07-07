<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard(){
        $users = User::where('id','!=',auth()->user()->id)->get();

        return view('dashboard',[
            'users' => $users
        ]);

    }

    public function gotoChat($id){

        return view('chat',[
            'id' => $id
        ]);

    }
    public function gotoChatApp($id){

        return view('chatApp',[
            'id' => $id
        ]);

    }
}
