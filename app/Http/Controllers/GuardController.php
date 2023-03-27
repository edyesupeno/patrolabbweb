<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Guard;
use App\Helper\ApiHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class GuardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = "Daftar Petugas";
        return view('super-admin.guard-page.index', $data);
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
     * @param  \App\Models\Guard  $guard
     * @return \Illuminate\Http\Response
     */
    public function show(Guard $guard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Guard  $guard
     * @return \Illuminate\Http\Response
     */
    public function edit(Guard $guard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Guard  $guard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guard $guard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Guard  $guard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guard $guard)
    {
        //
    }

    public function datatable()
    {
        $data = Guard::all();
        return DataTables::of($data)
            ->addIndexColumn()
            ->escapeColumns('active')
            ->addColumn('nama', '{{$nama}}')
            ->addColumn('id_area', '{{$id_area}}')
            ->addColumn('no_badge', '{{$no_badge}}')
            ->addColumn('jabatan', '{{$jabatan}}')
            ->addColumn('action', function (Guard $guard) {
                $data = [
                    'showurl' => route('guard.show', $guard->id),
                    'editurl' => route('guard.edit', $guard->id),
                    'deleteurl' => route('guard.destroy', $guard->id)
                ];
                return $data;
            })
            ->toJson();
    }

    //API METHOD

    public function index_api()
    {
        try {
            $data = Guard::with(['wilayah', 'area'])->get();
            return ApiHelper::response('true', 'berhasil mendapatkan data', $data, 200);
        } catch (Throwable $th) {
            Log::debug('app\Http\Controllers\GuardController.php index_api ' . $th->getMessage());
            return ApiHelper::response('false', 'terjadi masalah', [$th->getMessage()], 500);
        }
    }
    public function show_api($id)
    {
        try {
            $data = Guard::find($id);
            if (!$data) {
                return ApiHelper::response('false', 'gagal mendapatkan data', [$id], 404);
            }
            $data = $data->with(['wilayah', 'area'])->get();
            return ApiHelper::response('true', 'berhasil mendapatkan data', $data, 200);
        } catch (Throwable $th) {
            Log::debug('app\Http\Controllers\GuardController.php show_api ' . $th->getMessage());
            return ApiHelper::response('false', 'terjadi masalah', [$th->getMessage()], 500);
        }

    }
}