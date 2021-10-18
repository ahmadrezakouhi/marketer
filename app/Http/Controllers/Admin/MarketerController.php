<?php

namespace App\Http\Controllers\admin;

use App\Commission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Marketer;
use App\User;
use DataTables;

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
            $marketers = Marketer::with('user','commission');
            return Datatables::of($marketers)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-icon waves-effect waves-light btn-warning editMarketer"><i class="fa fa-edit"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-icon waves-effect waves-light btn-danger deleteMarketer"><i class="fas fa-trash"></i></a>';
                    return $btn;
                })->addColumn('name', function (Marketer $marketer) {
                    return $marketer->user->name;

                })->addColumn('last_name', function (Marketer $marketer) {
                    return $marketer->user->last_name;


                })->addColumn('email', function (Marketer $marketer) {
                    return $marketer->user->email;


                })->addColumn('email', function (Marketer $marketer) {
                    return $marketer->user->email;


                })->addColumn('phone', function (Marketer $marketer) {
                    return $marketer->user->phone;
                })
                ->addColumn('level1', function (Marketer $marketer) {
                    return $marketer->commission->level1;
                })
                ->addColumn('level2', function (Marketer $marketer) {
                    return $marketer->commission->level2;
                })
               -> addColumn('level3', function (Marketer $marketer) {
                    return $marketer->commission->level3;
                })
                ->editColumn('status', function (Marketer $marketer)
                {
                    if($marketer->status){
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
    public function store(Request $request)
    {
        $user = User::create([
            'name'=>$request->name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'password'=>bcrypt($request->phone),
            'role_id'=>6

        ]);
        $marketer = new Marketer([
            'tel'=>$request->tel,
            'address'=>$request->address,
            'national_code'=>$request->national_code,
            'status'=>$request->status ? 1: 0,
            'parent_id'=>null
        ]);

        $user->marketer()->save($marketer);

    $commission = new Commission();
    $marketer->commission()->save($commission);

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
