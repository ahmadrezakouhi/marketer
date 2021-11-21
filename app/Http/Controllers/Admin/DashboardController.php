<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $totalPrice = DB::table('customer_surgery')->where('status', '=', '1')->sum('price');


        $activeMarketers = DB::table('marketers')->where('status', '=', '1')->count();

        $totalCustomerSurgery = DB::table('customer_surgery')->where('status', '=', '1')->count();


        $payments = DB::table('payments')->join('cards', 'card_id', 'cards.id')->join('marketers', 'marketer_id', 'marketers.id')
        ->join('users', 'user_id', 'users.id')->select('users.name','users.last_name','payments.amount','payments.created_at as created_at')->take(5)->latest('payments.created_at')->get();


        $customerSurgeries = DB::table('customer_surgery')->join('surgeries','surgery_id','surgeries.id')
        ->join('customers','customer_id','customers.id')->join('marketers','marketer_id','marketers.id')
        ->join('users','user_id','users.id')
        ->select('customer_surgery.status as customerSurgeryStatus','surgeries.name as surgeryName','users.name as marketerName','customers.name as customerName')
        ->take(5)->latest('customer_surgery.created_at')->get();
        return view('admin.dashboard.index', compact('totalPrice', 'payments', 'activeMarketers','totalCustomerSurgery','customerSurgeries'));
    }
}
