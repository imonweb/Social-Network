<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    public function profile($username)
    {
    	// return $username;
    	$user = User::whereUsername($username)->first();
    	// User::where('username', $username);
    	// dd($user);
    	// return $user;
    	// return $user->username;

    	return view('user.profile', compact('user'));
    }
}
