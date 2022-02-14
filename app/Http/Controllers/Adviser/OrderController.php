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

use Kavenegar;


class OrderController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $customers = DB::table('customer_surgery')
                ->join('customers', 'customer_id', 'customers.id')
                ->join('surgeries', 'surgery_id', 'surgeries.id')

                ->where('customer_surgery.status', '=', 0)
                ->select('customer_surgery.id as id', 'customer_surgery.status as status', 'customer_surgery.created_at as created', 'customers.name as name', 'customers.last_name as last_name', 'surgeries.name as surgery')

                ->get();
            //Customer::with('surgeries');
            return Datatables::of($customers)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-icon waves-effect waves-light btn-success acceptOrder " ><i class="fas fa-check"></i></a>';
                    // $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-icon waves-effect waves-light btn-danger declineOrder"><i class="fas fa-ban"></i></a>';
                    $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Show" class="btn btn-icon waves-effect waves-light btn-info addOrder"><i class="fas fa-headset"></i></a>';

                    return $btn;
                })
                ->editColumn('status', function ($row) {
                    if ($row->status == -1) {
                        return 'رد شده';
                    } else if ($row->status  == 0) {
                        return 'در حال بررسی';
                    } else if ($row->status  == 1) {
                        return 'تایید شده';
                    } else if ($row->status  == -2) {
                        return 'درحال مشاوره';
                    }
                })
                ->editColumn('created', function ($row) {
                    return \Morilog\Jalali\Jalalian::forge($row->created);
                })
                ->rawColumns(['action'])
                ->make(true);
        }


        return view('adviser.orders.index');
    }



    public function accept(Request $request)
    {
        $adviser = Auth::user();
        $customer_surgery = CustomerSurgery::where('customer_id', $request->order_id)->first();
        if ($customer_surgery->status == 1 || $customer_surgery->status == -1) {
            return response()->json(['error' => 'سفارش تایید و یا رد شده را نمی توان انتخاب کرد!!!'], 500);
        }
        if ($customer_surgery->status == -2 && $customer_surgery->adviser_id != $adviser->id) {
            return response()->json(['errors' => ['مشتری مورد نظر در حال مشاوره میباشد']], 500);
        }
        CustomerSurgery::where('customer_id', $request->order_id)->update(['status' => 1, 'adviser_id' => $adviser->id, 'price' => $request->price]);

        $price = $customer_surgery->price;
        $marketer = Customer::find($request->order_id)->marketer;
        $amount = calculateCommission($price, $marketer->commission->level1);
        $marketer->wallet()->update(['amount' => ($marketer->wallet->amount + $amount)]);


        $marketer = $marketer->parent;

        if ($marketer != null) {
            $amount = calculateCommission($price, $marketer->commission->level2);
            $marketer->wallet()->update(['amount' => ($marketer->wallet->amount + $amount)]);
        }
        if ($marketer != null) {
            $marketer = $marketer->parent;
        }
        if ($marketer != null) {
            $amount = calculateCommission($price, $marketer->commission->level3);
            $marketer->wallet()->update(['amount' => ($marketer->wallet->amount + $amount)]);
        }



        return response()->json();
    }

    public function decline(Request $request)
    {
        send_sms('09130774939', 'toranjCilinicActiveAcount', 'sms', '.', '.', '.', 'احمد رضا کوهی');
        $adviser = Auth::user();
        $customer_surgery = CustomerSurgery::where('customer_id', $request->order_id)->first();
        if ($customer_surgery->status == 1 || $customer_surgery->status == -1) {
            return response()->json(['error' => 'سفارش تایید و یا رد شده را نمی توان انتخاب کرد!!!'], 500);
        }

        if ($customer_surgery->status == -2 && $customer_surgery->adviser_id != $adviser->id) {
            return response()->json(['errors' => ['مشتری مورد نظر در حال مشاوره میباشد']], 500);
        }

        CustomerSurgery::where('customer_id', $request->order_id)->update(['status' => -1, 'adviser_id' => $adviser->id]);
        return response()->json();
    }


    public function show($id)
    {

        $adviser = Auth::user();

        $customer_surgery = CustomerSurgery::find($id);




        if ($customer_surgery->status == -2 && $customer_surgery->adviser_id != $adviser->id) {
            return response()->json(['errors' => ['مشتری مورد نظر در حال مشاوره میباشد']], 500);
        }


        if ($customer_surgery->adviser_id == null) {

            $customer_surgery->update(['status' => -2, 'adviser_id' => ($adviser->id)]);
        }

        if ($customer_surgery->adviser_id == null || $customer_surgery->adviser_id == $adviser->id) {
            $order = DB::table('customer_surgery')
                ->join('customers', 'customer_id', 'customers.id')
                ->where('customer_surgery.id', $id)
                ->first();
            return response()->json($order);
        }

    }



    public function owner(Request $request)
    {
        $adviser = Auth::user()->id;

        if ($request->ajax()) {
            $customers = DB::table('customer_surgery')
                ->join('customers', 'customer_id', 'customers.id')
                ->join('surgeries', 'surgery_id', 'surgeries.id')
                ->where('adviser_id', '=', $adviser)
                ->select('customer_surgery.id as id', 'customer_surgery.status as status', 'customer_surgery.created_at as created', 'customers.name as name', 'customers.last_name as last_name', 'customers.phone as phone', 'surgeries.name as surgery')
                ->get();

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
                    } else if ($row->status  == 1) {
                        return 'تایید شده';
                    } else if ($row->status  == -2) {
                        return 'درحال مشاوره';
                    }
                })
                ->editColumn('created', function ($row) {
                    return \Morilog\Jalali\Jalalian::forge($row->created);
                })

                ->rawColumns(['action'])
                ->make(true);
        }


        return view('adviser.orders.owner');
    }



    public function addOrder(Request $request)
    {
        $adviser = Auth::user();
        $customer = CustomerSurgery::findOrFail($request->order_id);
        if ($customer->status != 0) {
            return response()->json(['error' => 'بیمار توسط مشاور دیگری در حال مشاوره می باشد'], 500);
        } else {
            $customer->update(['adviser_id' => $adviser->id, 'status' => -2]);
        }

        return response()->json();
    }

}
