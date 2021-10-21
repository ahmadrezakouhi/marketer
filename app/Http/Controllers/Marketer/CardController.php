<?php

namespace App\Http\Controllers\Marketer;

use App\Bank;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Marketer;
use App\Card;
use DataTables;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $cards = Marketer::find(1)->cards()->with('bank');
            return Datatables::of($cards)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-icon waves-effect waves-light btn-warning editCard"><i class="fa fa-edit"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-icon waves-effect waves-light btn-danger deleteCard"><i class="fas fa-trash"></i></a>';
                    return $btn;
                })
                ->addColumn('name', function (Card $card) {
                    return $card->bank->name;
                })
                ->rawColumns(['action'])
                ->make(true);;
        }
        $banks = Bank::all();
        return view('marketer.cards.index', compact('banks'));
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
        $marketer = Marketer::find(1);

        $bank = Bank::findOrFail($request->bank_id);
        $card = new Card([
            'identification'=>$request->identification
            ,
            'bank_id'=>$request->bank_id
        ]);
        $marketer->cards()->save($card);
        // $bank->cards()->save($card);


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
