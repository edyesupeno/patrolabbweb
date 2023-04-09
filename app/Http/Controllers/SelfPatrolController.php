<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\SelfPatrol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SelfPatrolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Report Self Patrol';
        $data['self-patrol'] = SelfPatrol::all();
        return view('super-admin.self-patrol.index', $data);
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
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), 
            [
                'id_guard' => ['required', 'numeric'],
                'tanggal' => ['required'],
                'status_lokasi' => ['required', 'in:aman,kebakaran,pencurian,lain-lain'],
                'deskripsi' => ['required'],
                'foto' => ['nullable','array'],
                'foto.*' => ['image', 'mimes:jpg,png,jpeg,gif', 'max:5000']
            ]);

            //return $request->file('foto.0')->getClientOriginalExtension();

            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'input tidak valid',
                    'data' => $validator->errors()
                ],401);
            }
            $data = $validator->validated();

            if($request->hasFile('foto')){
                $paths = [];
                $inc_name = 0;
                foreach ($request->file('foto') as $file) {
                    $inc_name++;
                    $extension = $file->getClientOriginalExtension();
                    $file_name = time() .'-'.$inc_name. '.' . $extension;
                    $path = $file->storeAs(
                        'self-patrol',
                        $file_name
                    );
                    array_push($paths,$path);
                }
                $data['foto'] = json_encode($paths);
            }
            
            $action = SelfPatrol::create($data);
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'data berhasil di simpan',
                'data' => $action
            ], 200);

        } catch (Throwable $e) {
            DB::rollback();
            Log::debug('SelfPatrol store ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'terjadi kesalahan',
                'data' => [$e->getMessage()]
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SelfPatrol  $selfPatrol
     * @return \Illuminate\Http\Response
     */
    public function show(SelfPatrol $selfPatrol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SelfPatrol  $selfPatrol
     * @return \Illuminate\Http\Response
     */
    public function edit(SelfPatrol $selfPatrol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SelfPatrol  $selfPatrol
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SelfPatrol $selfPatrol)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SelfPatrol  $selfPatrol
     * @return \Illuminate\Http\Response
     */
    public function destroy(SelfPatrol $selfPatrol)
    {
        //
    }
}
