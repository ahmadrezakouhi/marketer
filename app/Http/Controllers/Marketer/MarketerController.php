<?php

namespace App\Http\Controllers\Marketer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Marketer;
use App\Commission;
use App\Role;
use DataTables;
use Illuminate\Support\Facades\Auth;
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
             $marketer_id = Auth::user()->marketer->id;
            $marketers =
            DB::table('users')->join('marketers','users.id','=','marketers.user_id')
            ->select('marketers.id as id','name'
            ,'last_name','email','phone','tel','address','national_code','status','parent_id')
            ->where('parent_id','=',$marketer_id)->get();
             //Marketer::find($marketer_id)->marketers()->with('user');
            return Datatables::of($marketers)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-icon waves-effect waves-light btn-warning editMarketer"><i class="fa fa-edit"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-icon waves-effect waves-light btn-danger deleteMarketer"><i class="fas fa-trash"></i></a>';
                    $btn = $btn . ' <a href="'.route("marketers.show",$row->id).'" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-icon waves-effect waves-light btn-info showSubMarketer"><i class="fas fa-sitemap"></i></a>';
                    return $btn;
                })
                // ->addColumn('name', function (Marketer $marketer) {
                //     return $marketer->user->name;
                // })->addColumn('last_name', function (Marketer $marketer) {
                //     return $marketer->user->last_name;
                // })->addColumn('email', function (Marketer $marketer) {
                //     return $marketer->user->email;
                // })->addColumn('email', function (Marketer $marketer) {
                //     return $marketer->user->email;
                // })->addColumn('phone', function (Marketer $marketer) {
                //     return $marketer->user->phone;
                // })
                // ->editColumn('status', function (Marketer $marketer) {
                //     if ($marketer->status) {
                //         return 'فعال';
                //     }
                //     return 'غیر فعال';
                // })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('marketer.marketers.index');
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
        $marketer_role_id = Role::where('name','marketer')->first()->id;
        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->phone),
            'role_id' => $marketer_role_id

        ]);
        $marketer = new Marketer([
            'tel' => $request->tel,
            'address' => $request->address,
            'national_code' => $request->national_code,
            'status' => $request->status ? 1 : 0,
            'parent_id' => Auth::user()->marketer->id
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
    public function show(Request $request , $id)
    {
        if ($request->ajax()) {
            $marketers = Marketer::find($id)->marketers()->with('user');
            return Datatables::of($marketers)
                ->addIndexColumn()
                ->addColumn('name', function (Marketer $marketer) {
                    return $marketer->user->name;
                })->addColumn('last_name', function (Marketer $marketer) {
                    return $marketer->user->last_name;
                })->addColumn('email', function (Marketer $marketer) {
                    return $marketer->user->email;
                })->addColumn('phone', function (Marketer $marketer) {
                    return $marketer->user->phone;
                })
                ->editColumn('status', function (Marketer $marketer) {
                    if ($marketer->status) {
                        return 'فعال';
                    }
                    return 'غیر فعال';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $selectedMarketer = Marketer::with('user')->find($id);


        return view('marketer.marketers.show',compact('selectedMarketer', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $marketer = Marketer::find(1)->marketers()->with('user')->find($id);
        return response()->json($marketer);
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
        $marketer_role_id = Role::where('name','marketer')->first()->id;


        $marketer = Marketer::find(1)->marketers()->find($id);
        $marketer->user()->update([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->phone),
            'role_id' => $marketer_role_id
        ]);
        $marketer->update([
            'tel' => $request->tel,
            'address' => $request->address,
            'national_code' => $request->national_code,
            'status' => $request->status ? 1 : 0,
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
        $marketer = Marketer::find(Auth::user()->marketer->id)->marketers()->find($id);

        if ($marketer->status == 1) {
            return response()->json(['message'=>'بازاریاب تایید شده رو نمی توان حذف کرد .'],500);
        }
        $marketer->commission->delete();
        $marketer->user()->delete();

        return response()->json();
    }
}
