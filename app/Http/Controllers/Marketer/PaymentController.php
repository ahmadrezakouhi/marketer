<?php

namespace App\Http\Controllers\Marketer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Marketer;
use App\Payment;
use DataTables;
use Illuminate\Support\Facades\Auth;
use DB;

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

            $payments = DB::table('payments')->join('cards', 'card_id', 'cards.id')
                ->join('banks', 'bank_id', 'banks.id')
                ->where('marketer_id', Auth::user()->marketer->id)
                ->select('banks.name as bank_name','cards.name as name','last_name', 'identification', 'amount', 'payments.status')->get();
            // Marketer::find($marketer_id)->payments()->with('card');
            return Datatables::of($payments)
                ->addIndexColumn()
                // ->addColumn('name',function (Payment $payment)
                // {
                //     return $payment->card->bank->name;
                // })
                // ->addColumn('identification',function (Payment $payment)
                // {
                //     return $payment->card->identification;
                // })
                ->editColumn('status', function ($row) {
                    if ($row->status == -1) {
                        return 'رد شده';
                    } else if ($row->status == 0) {
                        return 'در حال بررسی';
                    } else {
                        return 'تایید شده';
                    }
                })
                ->make(true);
        }
        $cards = Marketer::find($marketer_id)->cards;
        $amount = Marketer::find($marketer_id)->wallet->amount;
        return view('marketer.payments.index', compact('cards', 'amount'));
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
        $wallet = Auth::user()->marketer->wallet;
        if ($wallet->amount == 0) {
            return response()->json(['errors' => ['موجودی صفر می باشد.']], 500);
        } else if ($wallet->amount < $request->amount) {
            return response()->json(['errors' => ['میزان موجودی کمتر از میزان درخواست می باشد.']], 500);
        }

        $wallet->update(['amount' => ($wallet->amount - $request->amount)]);


        Payment::create([
            'card_id' => $request->card_id,
            'amount' => $request->amount,
            'status' => 0
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


    public function getWalletAmount()
    {
        $amount = Auth::user()->marketer->wallet->amount;
        return response()->json(['amount' => $amount]);
    }
}
