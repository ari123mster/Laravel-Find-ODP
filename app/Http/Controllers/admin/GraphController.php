<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Charts\admin\GraphChart;
use App\Charts\admin\GraphChart2;
use App\Models\olt;
use App\Models\odp;
use App\Models\odc;
class GraphController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $olt = olt::get();
        $olts = [];
        $count = [];
        foreach ($olt as $key => $value) {
            array_push($olts, $value->nama);
            $odcs = odc::where('olt_id', $value->id)->count();
            array_push($count, $odcs);
        }
        $chart = new GraphChart;
        $chart->labels($olts);
        $chart->dataset('Jumlah odc', 'bar', $count)->options([
            'color' => '#1c6ae8',
            'backgroundColor' => '#1c6ae8'
        ]);
        return view('admin.graph.odc', compact('chart'));
    }

    public function index2()
    {
        $olt = olt::get();
        $olts = [];
        $count = [];

        foreach ($olt as $key => $value) {
            array_push($olts, $value->nama);
            $odps = odp::where("olt_id", $value->id)->count();
            array_push($count, $odps);
        }

        $chart = new GraphChart2;
        $chart->labels($olts);
        $chart->dataset('Jumlah odp', 'bar', $count)->options([
            'color' => '#1c6ae8',
            'backgroundColor' => '#1c6ae8'
        ]);

        return view('admin.graph.odp', compact('chart'));
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
        //
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
