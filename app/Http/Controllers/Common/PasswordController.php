<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

class PasswordController extends Controller
{
    public function index()
    {
        return view('common.change_password');
    }

    public function updatePassword(Request $request)
    {
        User::find(Auth::user()->id)->update(['password'=>$request->password]);
        return response()->json();
    }
}
