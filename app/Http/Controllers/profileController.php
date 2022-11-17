<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class profileController extends Controller
{
    public function profile($id){
        $user = User::find($id);
        return view('profile',['user'=>$user]);
    }
    public function profile_reviews($id){
        $user = User::find($id);
        $reviews = $user->review;
        return view('reviews',['reviews'=>$reviews,'user'=>$user]);
    }
}
