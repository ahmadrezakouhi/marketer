<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Marketer;
use DB;
class SubMarketerController extends Controller
{
    public function index()
    {
        $marketers = DB::table('marketers')->join('users','user_id','users.id')->where('parent_id','=',NULL)->get();
        return view('admin.marketer.sub',compact('marketers'));
    }
}
