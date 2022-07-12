<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
         $user=user::get();

    //  $user=DB::table('users')
    // //  ->select('id','name','email','role_id','password')
    //  ->join('users','users.role_id','=','roles.id')
    //  ->get();

    //     dd($user);
        return view('admin.user.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role=Role::get();
        return view('admin.user.create',compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'role_id'=>'required',
            'password'=>'required'
        ]);

        $user=user::create([
            'name'=> $request['name'],
            'email'=> $request['email'],
            'role_id'=> $request['role_id'],
            'password' => bcrypt($request['password']),
        ]);
        $user->assignRole($request['role_id']);
        return redirect()->route('admin.user.index')->with('success', 'Data Berhasil Disimpan');
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
        $user=user::find($id);
        $role=Role::get();
        return view('admin.user.edit',compact('user','role'));
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
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'role_id'=>'required',
            'password'=>'required'
        ]);
        $user = user::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->password = bcrypt($request->password);
        $user->assignRole($request["role"]);
        $user->save();

        return redirect()->route('admin.user.index')->with('warning','Data Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=user::Find($id)->delete()->with('warning', 'Data Berhasil Disimpan');
        return back();
    }
}
