<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Auth;
use App\User;

class PasswordController extends Controller
{
    public function index()
    {
        return view('common.change_password');
    }

    public function updatePassword(PasswordRequest $request)
    {

        User::find(Auth::user()->id)->update(['password'=>bcrypt($request->password)]);
        return response()->json();
    }
}
