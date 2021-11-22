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
        $marketers = Marketer::where('parent_id',null)->get();

       $output = createAllMarketerTree($marketers);

        // dd($output);
        return view('admin.marketer.sub',compact('output'));
    }


    public function createTree ($marketer)
    {
        $output = "<ul>";
        foreach ($marketer->marketers() as $m) {
            $output .="<li>";
            $output .=$m->user()->name;
            $output .="</li>";
        }

        return $output;
    }
}
