<?php

namespace App\Http\Controllers\admin;

use App\Commission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MarketerRequest;
use App\Marketer;
use App\Role;
use App\User;
use App\Wallet;
use DataTables;
use DB;
class MarketerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index(Request $request)
    {
        if ($request->ajax()) {
            $marketers = DB::table('users')->join('marketers','users.id','=','marketers.user_id')
            ->join('commissions','marketers.id','=','commissions.marketer_id')->select('marketers.id as id','name'
            ,'last_name','email','phone','tel','address','national_code','status','level1','level2','level3')->get();
            ; //Marketer::with('user', 'commission');
            return Datatables::of($marketers)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // dd($row);
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-icon waves-effect waves-light btn-warning editMarketer"><i class="fa fa-edit"></i></a>';
                    if($row->status != 1){
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-icon waves-effect waves-light btn-danger deleteMarketer"><i class="fas fa-trash"></i></a>';
                    }
                    return $btn;
                 })//->addColumn('name', function (Marketer $marketer) {
                //     return $marketer->user->name;
                // })->addColumn('last_name', function (Marketer $marketer) {
                //     return $marketer->user->last_name;
                // })->addColumn('email', function (Marketer $marketer) {
                //     return $marketer->user->email;
                // })->addColumn('phone', function (Marketer $marketer) {
                //     return $marketer->user->phone;
                // })
                // ->addColumn('level1', function (Marketer $marketer) {
                //     return $marketer->commission->level1;
                // })
                // ->addColumn('level2', function (Marketer $marketer) {
                //     return $marketer->commission->level2;
                // })
                // ->addColumn('level3', function (Marketer $marketer) {
                //     return $marketer->commission->level3;
                // })
                ->editColumn('status', function ($row) {
                    if ($row->status) {
                        return 'فعال';
                    }
                    return 'غیر فعال';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.marketer.index');
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
    public function store(MarketerRequest $request)
    {
        $role = Role::where('name','marketer')->first();
        $request->validated();
        if ($request->level1 + $request->level2 + $request->level3 > 15) {
            return response()->json(['errors'=>['commissions' => 'جمع پورسانت های تعیین شده باید کمتر از 15 درصد باشد.']], 500);
        }

        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->phone),
            'role_id' => $role->id

        ]);
        $marketer = new Marketer([
            'tel' => $request->tel,
            'address' => $request->address,
            'national_code' => $request->national_code,
            'status' => $request->active ? 1: 0,
            'parent_id' => null
        ]);

        $user->marketer()->save($marketer);

        $commission = new Commission([
            'level1'=>$request->level1,
            'level2'=>$request->level2,
            'level3'=>$request->level3,
        ]);
        $marketer->commission()->save($commission);
        $wallet = new Wallet();
        $marketer->wallet()->save($wallet);
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $marketer = Marketer::with('user', 'commission')->findOrFail($id);
        $marketer = DB::table('users')->join('marketers','users.id','=','marketers.user_id')
        ->join('commissions','marketers.id','=','commissions.marketer_id')->select('marketers.id as id','users.id as user_id','name'
        ,'last_name','email','phone','tel','address','national_code','status','level1','level2','level3')->where('marketers.id',
        '=',$id)->first();
        return response()->json($marketer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MarketerRequest $request, $id)
    {
        $role = Role::where('name','marketer')->first();

        if ($request->level1 + $request->level2 + $request->level3 > 15) {
            return response()->json(['errors'=>['commissions' => 'جمع پورسانت های تعیین شده باید کمتر از 15 درصد باشد.']], 500);
        }
        $marketer = Marketer::findOrFail($id);
        $marketer->user()->update([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->phone),
            'role_id' => $role->id


        ]);
        $marketer->update([
            'tel' => $request->tel,
            'address' => $request->address,
            'national_code' => $request->national_code,
            'status' => $request->active ? 1 : 0
        ]);

        $marketer->commission()->update([
            'level1'=> $request->level1,
            'level2'=> $request->level2,
            'level3'=> $request->level3
        ]);
        return response()->json($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $marketer = Marketer::findOrFail($id);
        $marketer->commission()->delete();
        $marketer->user()->delete();
        $marketer->wallet()->delete();
        $marketer->delete();



        return response()->json();
    }
}
