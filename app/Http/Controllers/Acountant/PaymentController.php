<?php

namespace App\Http\Controllers\Acountant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Payment;
use DataTables;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $payments = Payment::with('card');
            return Datatables::of($payments)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="accept" class="edit btn btn-icon waves-effect waves-light btn-success acceptPayment"><i class="fas fa-check"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="decline" class="btn btn-icon waves-effect waves-light btn-danger declinePayment"><i class="fas fa-ban"></i></a>';
                    return $btn;
                })
                ->addColumn('fullname', function (Payment $payment) {

                    return $payment->card->marketer->user->fullname;
                })
                ->addColumn('identification', function (Payment $payment) {

                    return $payment->card->identification;
                })
                ->editColumn('status', function (Payment $payment) {
                    if ($payment->status == -1) {
                        return 'رد شده';
                    } else if ($payment->status == 0) {
                        return 'در حال بررسی';
                    } else {
                        return 'تایید شده';
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }



        return view('acountant.payments.index');
    }



    public function accept(Request $request)
    {
        Payment::find($request->payment_id)->update(['status' => 1]);
    }




    public function decline(Request $request)
    {
        Payment::find($request->payment_id)->update(['status' => -1]);
    }
}
