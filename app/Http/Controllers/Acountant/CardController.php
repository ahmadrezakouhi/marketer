<?php

namespace App\Http\Controllers\Acountant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Card;
use DataTables;

class CardController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $cards = Card::with('marketer');
            return Datatables::of($cards)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-icon waves-effect waves-light btn-success acceptCard"><i class="fas fa-check"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-icon waves-effect waves-light btn-danger declineCard"><i class="fas fa-ban"></i></a>';
                    return $btn;
                })->addColumn('fullname',function (Card $card)
                {
                    return $card->marketer->user->full_name;
                })->editColumn('status',function (Card $card)
                {
                    if($card->status==-1){
                        return 'رد شده';
                    }else if($card->status == 0){
                        return 'در حال بررسی';
                    }else {
                        return 'تایید شده';
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('acountant.cards.index');
    }
}
