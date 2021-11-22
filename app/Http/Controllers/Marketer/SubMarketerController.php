<?php

namespace App\Http\Controllers\Marketer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Marketer;
use Illuminate\Support\Facades\Auth;
class SubMarketerController extends Controller
{
    public function index()
    {
        $marketers = Marketer::find(Auth::user()->marketer->id)->marketers;

       $output = createSubMarketerTree($marketers);

        // dd($output);
        return view('marketer.marketers.sub',compact('output'));
    }



}
