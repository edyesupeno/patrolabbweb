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
                    <li class="breadcrumb-item">Master Asset</li>
                    <li class="breadcrumb-item">{{ $title }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="d-flex mb-3 justify-content-end">
                <a href="{{route('aset.create')}}" class="btn btn-success">Tambah Aset</a>
            </div>
            <table id="mytable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th style="max-width: 40px;">No</th>
                        <th>Nama</th>
                        <th>Area</th>
                        <th>No Badge</th>
                        <th>Posisi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<div id="actionbase" class="d-none">
    <div class="d-flex">
        <a id="show" class="btn btn-primary me-2"><i class="fa fa-check-circle fs-5"></i></a>
        <a id="edit" class="btn btn-warning me-2">Edit</a>
        <form method="post" class="d-inline">
            @csrf
            @method('delete')
            <button onclick="hapus_data(event)" class="btn btn-danger me-2" type="button">Hapus</button>
        </form>
    </div>
</div>
<!-- Container-fluid Ends-->
@push('js')
<script>
    $('#mytable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('guard.datatable') }}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'No'
            },
            {
                data: 'nama',
                name: 'nama'
            },
            {
                data: 'id_area',
                name: 'id_area'
            },
            {
                data: 'no_badge',
                name: 'no_badge'
            },
            {
                data: 'jabatan',
                name: 'jabatan'
            },
            {
                name: "Action",
                render: function(data, type, row) {
                    console.log(row)
                    let html = $('#actionbase').clone()
                    html = html.find('.d-flex')
                    html.find('#show').attr('href', row.action.showurl)
                    html.find('#edit').attr('href', row.action.editurl)
                    let form = html.find('form').attr('action', row.action.deleteurl)
                        .attr('id', 'delete_form' + row.id)
                    form.find('button').attr('form-id', '#delete_form' + row.id)
                    return html.html()
                }
            }
        ]
    });
</script>
<div class="d-flex">
    <a class="btn btn-warning me-2">Edit</a>
    <button class="btn btn-danger me-2">Hapus</button>
</div>
@endpush

@endsection