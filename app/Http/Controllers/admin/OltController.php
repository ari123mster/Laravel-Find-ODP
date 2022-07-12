<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\olt;

class OltController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $olt = olt::get();
        return view('admin.olt.index', compact('olt'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.olt.create');
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
            'nama' => 'required',
            'alamat' => 'required',
            'slot' => 'required',
            'port' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);
        olt::create($request->all());
        return redirect()->route('admin.olt.index')->with('success', 'Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $olt = olt::find($id);
        return view('admin.olt.show', compact('olt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $olt = olt::find($id);
        return view('admin.olt.edit', compact('olt'));
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
            'nama' => 'required',
            'alamat' => 'required',
            'slot' => 'required',
            'port' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);
        $olt = olt::find($id);
        $olt->update($request->all());
        return redirect()->route('admin.olt.index')->with('info', 'Data berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        olt::where('id', $id)->delete();
        return redirect()->route('admin.olt.index')->with('warning', 'Data Berhasil di hapus');
    }
}
