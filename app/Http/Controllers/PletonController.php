<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Guard;
use App\Models\Pleton;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PletonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $pletonData = Pleton::withCount('guards')->get();
        // dd($pletonData);

        $data['title'] = "Daftar Pleton";
        return view('super-admin.pleton-page.index', $data);
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

    public function datatable()
    {
        $data = Pleton::withCount('guards')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->escapeColumns('active')
            ->addColumn('name', '{{$name}}')
            ->addColumn('code', '{{$code}}')
            ->addColumn('guards_count', '{{$guards_count}}')
            // ->addColumn('created_at', function (Guard $guard) {
            //     return date('d M y', strtotime($guard->created_at));
            // })
            // ->addColumn('action', function (Guard $guard) {
            //     $data = [
            //         'showurl' => route('guard.show', $guard->id),
            //         'editurl' => route('guard.edit', $guard->id),
            //         'deleteurl' => route('guard.destroy', $guard->id)
            //     ];
            //     return $data;
            // })
            ->toJson();
    }
}
