<?php

namespace App\Http\Controllers\Marketer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Marketer;
use App\Payment;
use DataTables;
use Illuminate\Support\Facades\Auth;
class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $marketer_id = Auth::user()->marketer->id;
        if ($request->ajax()) {

            $payments = Marketer::find($marketer_id)->payments()->with('card');
            return Datatables::of($payments)
                ->addIndexColumn()
                ->addColumn('name',function (Payment $payment)
                {
                    return $payment->card->bank->name;
                })
                ->addColumn('identification',function (Payment $payment)
                {
                    return $payment->card->identification;
                })
                ->editColumn('status',function (Payment $payment)
                {
                    if ($payment->status == -1) {
                        return 'رد شده';
                    } else if($payment->status == 0) {
                        return 'در حال بررسی';

                    }else {
                        return 'تایید شده';
                    }

                })
                ->make(true);
        }
        $cards = Marketer::find($marketer_id)->cards;
        $amount = Marketer::find($marketer_id)->wallet->amount;
        return view('marketer.payments.index',compact('cards','amount'));
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
        Payment::create([
            'card_id'=>$request->card_id,
            'amount'=>$request->amount,
            'status'=>0
        ]);
        return response()->json();
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
        //
    }
}
