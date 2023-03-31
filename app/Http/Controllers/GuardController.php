<?php

namespace App\Http\Controllers;

use App\Models\PivotGuardProject;
use Throwable;
use App\Models\Area;
use App\Models\Guard;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class GuardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return dd(Guard::first());
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
        $data['title'] = 'Tambah Guard';
        $data['wilayah'] = Wilayah::all();
        $data['area'] = Area::all();
        $data['shift'] = (object)[(object)['id'=>1,'nama'=>'test']];
        return view('super-admin.guard-page.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(),[
                'no_badge'=>'required|numeric',
                'nama'=>'required|string',
                'ttl'=>'required',
                'jenis_kelamin'=>'required|in:laki laki, perempuan',
                'email'=>'required|unique:guards',
                'wa'=>'required|numeric',
                'alamat'=>'required',
                'id_wilayah'=>'required|numeric',
                'id_project'=>'required|array',
                'id_project.*'=>'required|numeric',
                'id_area'=>'required|numeric',
                'id_shift'=>'required|numeric',
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            }
            $data = $validator->validated();

            $guard = Guard::create($data);
            foreach($request->id_project as $item){
                PivotGuardProject::create([
                    'id_guard'=>$guard->id,
                    'id_project'=>$item
                ]);
            }
            DB::commit();
            return redirect()->route('guard.index')->with('success', 'Data Berhasil Ditambahkan');
        } catch (Throwable $e) {
            DB::rollback();
            Log::debug('GuardController store() ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
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
}