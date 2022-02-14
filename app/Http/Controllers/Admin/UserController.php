<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Role;
use App\User;
use DataTables;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $user = Auth::user();
            $data =DB::table('users')->join('roles','roles.id','=','users.role_id')->
            select('users.id','users.name as username','users.last_name','users.email','users.phone','users.active','roles.farsi_name as role_name')->where([['role_id','!=','5'],['users.id','!=',$user->id]])->get();//User::with('role')->where('role_id','!=',6);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-icon waves-effect waves-light btn-warning editUser"><i class="fa fa-edit"></i></a>';
                    // $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-icon waves-effect waves-light btn-danger deleteUser"><i class="fas fa-trash"></i></a>';
                    // $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-icon waves-effect waves-light btn-success acceptCard"><i class="fas fa-check"></i></a>';
                    // $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-icon waves-effect waves-light btn-danger declineCard"><i class="fas fa-ban"></i></a>';
                    return $btn;
                })->editColumn('active',function($row){
                    if($row->active){
                        return 'فعال';
                    }else{
                        return 'غیر فعال';
                    }
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        $roles = Role::where('name','!=','marketer')->get();
        return view('admin.users.index', compact('roles', $roles));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {

        User::updateOrCreate(['id'=>$request->user_id],[
            'name'=>$request->name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'role_id'=>$request->role_id,
            'password'=>bcrypt($request->phone),
            'active'=>$request->active ? 1 : 0
        ]);
        $user = User::findOrFail($request->user_id);
        if($user->active){
            send_sms($user->phone,'toranjCilinicActiveAcount','sms',$request->phone,'','.','.','.');
        }else {
            send_sms($user->phone,'toranjCilinicNonActiveAcount','sms','.','.','.','.','.');

        }
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
        $user  = User::findOrFail($id);
        return response()->json($user);
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
        User::find($id)->delete();
        // DB::table('users')->where('id','=',$id)->delete();
    }
}
