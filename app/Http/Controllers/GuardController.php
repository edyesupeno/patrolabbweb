<?php

namespace App\Http\Controllers;

use App\Models\PivotGuardProject;
use Throwable;
use App\Models\Shift;
use App\Models\Guard;
use App\Models\Pleton;
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
        $data['pleton'] = Pleton::all();
        $data['shift'] = Shift::all();
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
        // dd($request);
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(),[
                'badge_number'=>'required|numeric',
                'name'=>'required|string',
                'dob'=>'required',
                'gender'=>'required|in:MALE,FEMALE',
                'email'=>'required|unique:guards',
                'address'=>'required|string',
                'img_avatar'=>'required',
                'wa'=>'required|numeric',
                'pleton_id'=>'required|numeric',
                'shift_id'=>'required|numeric',
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            }
            $data = $validator->validated();

            $guard = Guard::create($data);
            // foreach($request->id_project as $item){
            //     PivotGuardProject::create([
            //         'id_guard'=>$guard->id,
            //         'id_project'=>$item
            //     ]);
            // }
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
        $data['title'] = 'Edit Guard';
        $data['wilayah'] = Wilayah::all();
        $data['area'] = Area::all();
        $data['guard'] = $guard;
        return view('super-admin.guard-page.edit',$data);
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
            ->addColumn('no_badge', '{{$badge_number}}')
            ->addColumn('nama', '{{$name}}')
            ->addColumn('email', '{{$email}}')
            ->addColumn('created_at', function (Guard $guard) {
                return date('d M y', strtotime($guard->created_at));
            })
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