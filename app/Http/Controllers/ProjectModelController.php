<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\ProjectModel;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ProjectModelController extends Controller
{
    public function index()
    {
        $data['title'] = 'Daftar Project';
        $data['project_model'] = ProjectModel::all();
        return view('super-admin.project.index', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Project';
        return view('super-admin.project.create', $data);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'nama_project' => 'required',
                'wilayah' => 'required|in:option1',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            }
            $data = $validator->validated();

            ProjectModel::create($data);
            DB::commit();
            return redirect()->route('project-model.index')->with('success', 'Data Berhasil Ditambahkan');
        } catch (Throwable $e) {
            DB::rollback();
            Log::debug('ProjectModelController store() ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        //return dd(ProjectModel::find($id)->data_wilayah);
        $data['title'] = 'Detail Project Model';
        $data['project_model'] = ProjectModel::find($id);
        return view('super-admin.project.show', $data);
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Project Model';
        $data['project_model'] = ProjectModel::find($id);
        return view('super-admin.project.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'nama_project' => 'required',
                'wilayah' => 'required|in:option1',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput($request->all());
            }
            $data = $validator->validated();

            ProjectModel::find($id)->update($data);
            DB::commit();
            return redirect()->route('project-model.index')->with('success', 'Data Berhasil Diedit');
        } catch (Throwable $e) {
            DB::rollback();
            Log::debug('ProjectModelController update() ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            ProjectModel::find($id)->delete();
            DB::commit();
            return redirect()->route('project-model.index')->with('success', 'Data Berhasil Dihapus');
        } catch (Throwable $e) {
            DB::rollback();
            Log::debug('ProjectModelController destroy() ' . $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function datatable()
    {
        $data = ProjectModel::all();
        return DataTables::of($data)
            ->addIndexColumn()
            ->escapeColumns('active')
            ->addColumn('nama_project', '{{$nama_project}}')
            ->addColumn('wilayah', function (ProjectModel $project){
                return $project->data_wilayah->nama;
            })
            ->addColumn('action', function (ProjectModel $project) {
                $data = [
                    'editurl' => route('project-model.edit', $project->id),
                    'deleteurl' => route('project-model.destroy', $project->id)
                ];
                return $data;
            })
            ->toJson();
    }
}
