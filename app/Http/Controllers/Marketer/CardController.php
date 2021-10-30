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
                ->editColumn('status',function(Card $card){
                    if($card->status == 0){
                        return 'در انتظار تایید ';
                    }else if($card->status==1){
                        return 'تایید شده';
                    }else {
                        return 'رد شده';
                    }
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


        $card = new Card([
            'identification'=>$request->identification
            ,
            'bank_id'=>$request->bank_id
        ]);
        $marketer->cards()->save($card);
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
        $card = Marketer::find(1)->cards()->find($id)->first();
        if($card->status == 1){
            return response()->json(['message'=>'کارت تایید شده امکان ادیت آن وجود ندارد'],500);
        }
        return response()->json($card);
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
        Marketer::find(1)->cards()->find($id)->update([

            'identification'=>$request->identification,
            'bank_id'=>$request->bank_id,
            'status'=>0


        ]);




        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $card = Marketer::find(1)->cards()->where('id',$id)->first();
        if($card->status == 1){
            return response()->json(['message'=>'این کارت تایید شده است نمی توان آن را حذف کرد.'],500);

        }else {
            $card->delete();
        }

        return response()->json();

    }
}
