<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function welcome(){
        return view('welcome');
    }

    public function post($id){
        return view('post',compact('id'));
    }
}
