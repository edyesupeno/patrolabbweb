<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Area;
use App\Models\Wilayah;
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
        $data['wilayah'] = Wilayah::all();
        $data['area'] = Area::all();
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
        return dd($request->all());
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
            ->addColumn('kode', '{{$kode}}')
            ->addColumn('lokasi', '{{$lokasi}}')
            ->addColumn('status', '{{$status}}')
            ->addColumn('id_area', function (CheckPoint $checkpoints) {
                return $checkpoints->area->nama;
            })
            ->addColumn('id_project', function (CheckPoint $checkpoints) {
                return $checkpoints->project->nama_project;
            })
            ->addColumn('id_wilayah', function (CheckPoint $checkpoints) {
                return $checkpoints->wilayah->nama;
            })
            ->toJson();
    }
}
