<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class HomeController extends Controller
{
    public function index(){
        $current_user_id = Auth::user()->getId();
        $user = User::where('id', '=', $current_user_id)->first();
        $data = [
            'user'=> $user
        ];
        return view('admin.home', $data);
    }
}
