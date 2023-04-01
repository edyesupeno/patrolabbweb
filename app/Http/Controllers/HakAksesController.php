<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Wilayah;
use App\Models\HakAkses;
use App\Models\ProjectModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class HakAksesController extends Controller
{
    public function index()
    {
        $data['title'] = 'Daftar Hak Akses';
        return view('super-admin.hak-akses.index', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Hak Akses';
        $data['permission'] = Permission::all();
        $data['wilayah'] = Wilayah::all();
        return view('super-admin.hak-akses.create', $data);
    }

    public function store(Request $request)
    {
         try {
            $validator = Validator::make($request->all(),[
                'name'=>'required|unique:roles',
                'permission_id'=>'required',
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            }
           $validator->validated();
            $role = Role::create(['name' => $request->name]);
            foreach ($request->permission_id as $item) {
                $permission = Permission::find($item);
                $permission->assignRole($role);
            }
            return redirect()->route('hak-akses.index')->with('success', 'Data Berhasil Ditambahkan');
        } catch (Throwable $e) {
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

    public function datatable()
    {
        $data = Role::all();
       return DataTables::of($data)
            ->addIndexColumn()
            ->escapeColumns('active')
            ->addColumn('name', '{{$name}}')
            ->addColumn('permission', function (Role $role){
                $permission = '';
                foreach ($role->permissions as $item) {
                    $permission .= $item->name.'<br>';
                }
                return $permission;
            })
            ->addColumn('action', function (Role $role) {
                $data = [
                    'editurl' => route('hak-akses.edit', $role->id),
                    'deleteurl' => route('hak-akses.destroy', $role->id)
                ];
                return $data;
            })
            ->toJson();
    }
   
}