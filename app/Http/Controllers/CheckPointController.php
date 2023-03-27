<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\CheckPoint;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CheckPointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = "Daftar Area CheckPoint";
        return view('super-admin.check-point.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = "Tambah Area CheckPoint";
        return view('super-admin.check-point.create', $data);
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
     * @param  \App\Models\CheckPoint  $checkPoint
     * @return \Illuminate\Http\Response
     */
    public function show(CheckPoint $checkPoint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CheckPoint  $checkPoint
     * @return \Illuminate\Http\Response
     */
    public function edit(CheckPoint $checkPoint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CheckPoint  $checkPoint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CheckPoint $checkPoint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CheckPoint  $checkPoint
     * @return \Illuminate\Http\Response
     */
    public function destroy(CheckPoint $checkPoint)
    {
        //
    }

    public function datatable()
    {
        $data = CheckPoint::all();
        return DataTables::of($data)
            ->addIndexColumn()
            ->escapeColumns('active')
            ->addColumn('nama', '{{$nama}}')
            ->addColumn('lokasi', '{{$lokasi}}')
            ->addColumn('id_area', '{{$id_area}}')
            ->toJson();
    }
}
