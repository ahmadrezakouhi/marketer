<?php

namespace App\Http\Controllers\Marketer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $wallet = DB::table('marketers')->join('wallets','marketer_id','marketers.id')->where('marketers.id','=',Auth::user()->marketer->id)->value('amount');

        $countCustomers = DB::table('customers')->where('customers.marketer_id','=',Auth::user()->marketer->id)->count();
        $countMarketers = DB::table('marketers')->where('marketers.parent_id','=',Auth::user()->marketer->id)->count();
        $customers =  DB::table('customer_surgery')->join('customers','customer_id','customers.id')
        ->join('surgeries','surgery_id','surgeries.id')
        ->select('customers.name as customerName','customers.last_name as customerLastName',
        'surgeries.name as surgeryName','customer_surgery.status as customerSurgeryStatus')
        ->where('customers.marketer_id','=',Auth::user()->marketer->id)->latest('customer_surgery.created_at')->take(5)->get();
        $totalPayment = DB::table('payments')->join('cards','card_id','cards.id')->
        where([
            ['cards.marketer_id','=',Auth::user()->marketer->id]
            ,
            ['payments.status','=',1]
        ])
        ->sum('amount');
        $totalRequestPayment =DB::table('payments')->join('cards','card_id','cards.id')->
        where([
            ['cards.marketer_id','=',Auth::user()->marketer->id]
            ,
            ['payments.status','=',0]
        ])
        ->sum('amount');
        return view('marketer.dashboard.index',compact('wallet','countMarketers','countCustomers','customers','totalPayment','totalRequestPayment'));
    }
}
