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
        <div class="table-responsive">
            <table class="table table-hover table-bordered" id="my_table">
                <thead class="bg-light">
                    <tr>
                        <th class="text-nowrap" style="width:50px">No</th>
                        <th class="text-nowrap">Role</th>
                        <th class="text-nowrap">Permission</th>
                        <th class="text-nowrap" style="width: 100px">Tindakan</th>
                    </tr>
                </thead>
                <!-- <tbody>
                    @foreach ($hak_akses as $item)
                    <tr>
                        <td class="text-nowrap">{{ $loop->iteration }}</td>
                        <td class="text-nowrap">{{ $item->role_name }}</td>
                        <td class="text-nowrap">{{ $item->permission_id }}</td>
                        <td class="text-nowrap">
                            <div class="d-flex">
                                <a href="{{ route('hak-akses.edit',$item->id) }}" class="btn btn-warning me-2">Edit</a>
                                <form action="{{ route('hak-akses.destroy',$item->id) }}" method="post" id="delete_form{{ $item->id }}">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-danger" onclick="delete_item('delete_form{{ $item->id }}')">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody> -->
            </table>
        </div>
    </div>
</div>
<script>
    function delete_item(form) {
        let cf = confirm('Yakin Menghapus Data ?')
        if (cf) {
            document.getElementById(form).submit();
        }
    }
</script>
@push('js')
<script>
    active_menu("#data_master", "#hak_akses")
</script>
@endpush
@endsection