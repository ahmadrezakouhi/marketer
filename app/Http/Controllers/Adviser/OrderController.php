<?php

namespace App\Http\Controllers\Adviser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;
use App\CustomerSurgery;
use App\Surgery;
use DataTables;
use Illuminate\Support\Facades\Auth;
use DB;
class OrderController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $customers = DB::table('customer_surgery')
            ->join('customers','customer_id','customers.id')
            ->join('surgeries','surgery_id','surgeries.id')
            ->select('customer_surgery.id as id','customer_surgery.status as status', 'customers.name as name','customers.last_name as last_name','surgeries.name as surgery')
            ->get();
            //Customer::with('surgeries');
            return Datatables::of($customers)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-icon waves-effect waves-light btn-success acceptOrder " ><i class="fas fa-check"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-icon waves-effect waves-light btn-danger declineOrder"><i class="fas fa-ban"></i></a>';

                    return $btn;
                })
                ->editColumn('status', function ($row) {
                    if ($row->status == -1) {
                        return 'رد شده';
                    } else if ($row->status  == 0) {
                        return 'در حال بررسی';
                    } else {
                        return 'تایید شده';
                    }
                })
                // ->addColumn('price', function (Customer $customer) {
                //     return $customer->surgeries()->first()->pivot->price;
                // })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('adviser.orders.index');
    }



    public function accept(Request $request)
    {
        $customer_surgery = CustomerSurgery::where('customer_id', $request->order_id)->first();
        if ($customer_surgery->status != 0) {
            return response()->json(['error' => 'سفارش تایید و یا رد شده را نمی توان انتخاب کرد!!!'], 500);
        }

        $price = $customer_surgery->price;
        $marketer = Customer::find($request->order_id)->marketer;
        $amount = $price + ($marketer->commission->level1 * $price / 100);
        $marketer->wallet()->update(['amount'=>$amount]);




        CustomerSurgery::where('customer_id', $request->order_id)->update(['status' => 1]);
        return response()->json();
    }

    public function decline(Request $request)
    {
        $customer_surgery = CustomerSurgery::where('customer_id', $request->order_id)->first();
        if ($customer_surgery->status != 0) {
            return response()->json(['error' => 'سفارش تایید و یا رد شده را نمی توان انتخاب کرد!!!'], 500);
        }

        CustomerSurgery::where('customer_id', $request->order_id)->update(['status' => -1]);
        return response()->json();
    }


    private  function calculateCommission($commission,$price)
    {
        return  $price + ($commission* $price / 100);

    }


}
