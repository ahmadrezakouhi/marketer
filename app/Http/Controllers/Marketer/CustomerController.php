<?php

namespace App\Http\Controllers\Marketer;

use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Marketer;
use App\Surgery;
use DataTables;
use Illuminate\Support\Facades\Auth;
use DB;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $marketer_id = Auth::user()->marketer->id;

             $customers = DB::table('customers')->join('marketers','marketer_id','marketers.id')
             ->join('customer_surgery','customer_id','customers.id')
             ->join('surgeries','surgery_id','surgeries.id')
             ->where('marketer_id',$marketer_id)->select('customers.name as name','last_name','gender','age','customers.tel as tel','customers.phone as phone',
             'customers.address as address','surgeries.name as surgery')->get();
            // Marketer::find($marketer_id)->customers()->with('surgeries');
            return Datatables::of($customers)
                ->addIndexColumn()
                // ->addColumn('action', function ($row) {
                //      $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-icon waves-effect waves-light btn-warning editCustomer"><i class="fa fa-edit"></i></a>';
                //      $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-icon waves-effect waves-light btn-danger deleteCustomer"><i class="fas fa-trash"></i></a>';
                //     return $btn;
                // })
                ->editColumn('gender',function($row){
                    return $row->gender ? 'زن':'مرد';
                })
                // ->addColumn('surgery',function(Customer $customer){
                //     return $customer->surgeries()->first()->name;
                // })

                ->rawColumns(['action'])
                ->make(true);

        }
        $surgeries = Surgery::all();

        return view('marketer.customers.index',compact('surgeries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $marketer = Marketer::find(Auth::user()->marketer->id);
        $customer = new Customer([
                'name'=>$request->name,
                'last_name'=>$request->last_name,
                'gender'=>$request->gender,
                'age'=>$request->age,
                'tel'=>$request->tel,
                'phone'=>$request->phone,
                'address'=>$request->address,
        ]);

        $marketer->customers()->save($customer);
        $surgery = Surgery::find($request->surgery_id);
        $customer->surgeries()->save($surgery);
        send_sms($marketer->user->phone,'toranjCilinicMarketerRegisterCustomer','sms','.','.','.','.','.');

        return response()->json($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
