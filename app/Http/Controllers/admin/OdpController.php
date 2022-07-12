<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\olt;
use App\Models\odp;

class OdpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $olt = olt::get();
        $odp=odp::with('olt')->get();
        return view('admin.odp.index', compact('olt','odp'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $olt=olt::get();
        return view('admin.odp.create',compact('olt'));
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
            'olt_id'=>'required',
            'nama' => 'required',
            'alamat' => 'required',
            'port' => 'required',
            'terpakai' => 'required',
            'total'=>'required',
            'latitude'=>'required',
            'longitude'=>'required'

        ]);
        odp::create($request->all());
        return redirect()->route('admin.odp.index')->with('success', 'Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $olt=olt::get();
        $odp=odp::find($id);
        return view('admin.odp.show',compact('olt','odp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $olt=olt::get();
        $odp=odp::find($id);
        return view('admin.odp.edit',compact('olt','odp'));
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
            'olt_id'=>'required',
            'nama' => 'required',
            'alamat' => 'required',
            'port' => 'required',
            'terpakai' => 'required',
            'total'=>'required',
            'latitude'=>'required',
            'longitude'=>'required'
        ]);
        $odp=odp::find($id);
        $odp->update($request->all());
        return redirect()->route('admin.odp.index')->with('info', 'Data Berhasil di Hapus');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $odp=odp::find($id);
        $odp->delete();
        return back()->with('warning', 'Data Berhasil di Hapus');
    }
}
