<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\HakAkses;
use App\Models\ProjectModel;
use App\Models\Wilayah;
use Throwable;

class HakAksesController extends Controller
{
    public function index()
    {
        $data['title'] = 'Daftar Hak Akses';
        $data['hak_akses'] = HakAkses::all();
        return view('super-admin.hak-akses.index', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Hak Akses';
        $data['permission'] = [
            'Aset' => [
                'Menu Aset' => "aset_menu",
                'Melihat data Aset' => "aset_index",
                'Membuat data Aset' => "aset_create",
                'Mengedit data Aset' => "aset_edit",
                'Melihat detail data Aset' => "aset_show",
                'Menghapus data Aset' => "aset_destroy",
            ],
            'Wilayah' => [
                'Menu Wilayah' => "wilayah_menu",
                'Melihat data Wilayah' => "wilayah_index",
                'Membuat data Wilayah' => "wilayah_create",
                'Mengedit data Wilayah' => "wilayah_edit",
                'Melihat detail data Wilayah' => "wilayah_show",
                'Menghapus data Wilayah' => "wilayah_destroy",
            ]
        ];
        $data['wilayah'] = Wilayah::all();
        return view('super-admin.hak-akses.create', $data);
    }

    public function store(Request $request)
    {
        return dd($request->all());
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(),[
                'role_name'=>'required',
                'permission_id'=>'required',
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            }
            $data = $validator->validated();

            HakAkses::create($data);
            DB::commit();
            return redirect()->route('hak-akses.index')->with('success', 'Data Berhasil Ditambahkan');
        } catch (Throwable $e) {
            DB::rollback();
            Log::debug('HakAksesController store() ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $data['title'] = 'Detail Hak Akses';
        $data['hak_akses'] = HakAkses::find($id);
        return view('super-admin.hak-akses.show', $data);
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Hak Akses';
        $data['hak_akses'] = HakAkses::find($id);
        return view('super-admin.hak-akses.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(),[
                'role_name'=>'required',
                'permission_id'=>'required',
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            }
            $data = $validator->validated();

            HakAkses::find($id)->update($data);
            DB::commit();
            return redirect()->route('hak-akses.index')->with('success', 'Data Berhasil Diedit');
        } catch (Throwable $e) {
            DB::rollback();
            Log::debug('HakAksesController update() ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            HakAkses::find($id)->delete();
            DB::commit();
            return redirect()->route('hak-akses.index')->with('success', 'Data Berhasil Dihapus');
        } catch (Throwable $e) {
            DB::rollback();
            Log::debug('HakAksesController destroy() ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
   
}