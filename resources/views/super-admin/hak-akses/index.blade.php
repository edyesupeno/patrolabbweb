<!-- @php
$page = 'data-master';
$section = 'wilayah';
@endphp -->
@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h3>{{ $title }}</h3>
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"> <i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Hak Akses</li>
                    <li class="breadcrumb-item">{{ $title }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-lg-end mb-3">
            <a class="btn btn-success" href="{{ route('hak-akses.create') }}">Tambah Hak Akses</a>
        </div>
        <table class="table table-hover table-bordered" id="mytable">
            <thead class="bg-light">
                <tr>
                    <th class="text-nowrap" style="width:50px">No</th>
                    <th class="text-nowrap">Name</th>
                    <th class="text-nowrap">Permission</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<div id="actionbase" class="d-none">
    <div class="d-flex">
        <a class="btn btn-warning me-2">Edit</a>
        <form method="post" class="d-inline">
            @csrf
            @method('delete')
            <button onclick="hapus_data(event)" class="btn btn-danger me-2" type="button">Hapus</button>
        </form>
    </div>
</div>
@push('js')
<script>
    $('#mytable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('hak-akses.datatable') }}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'No'
            },
            {
                data: 'name',
                name: 'Name'
            },
            {
                data: 'permission',
                name: 'Permission'
            }
        ]
    });
    active_menu("#data_master", "#hak_akses")
</script>
@endpush
@endsection