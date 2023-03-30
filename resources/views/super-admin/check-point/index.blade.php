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
                    <li class="breadcrumb-item">Area Checkpoint</li>
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
                <a href="{{route('check-point.create')}}" class="btn btn-success">Tambah Area CheckPoint</a>
            </div>
            <table id="mytable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama CheckPoint</th>
                        <th>Lokasi CheckPoint</th>
                        <th>Nama Area</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->
@push('js')
<script>
    $('#mytable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('check-point.datatable') }}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'No'
            },
            {
                data: 'nama',
                name: 'Nama CheckPoint'
            },
            {
                data: 'lokasi',
                name: 'Nama CheckPoint'
            },
            {
                data: 'id_area',
                name: 'Nama Area'
            }
        ]
    });
    active_menu("#menu-checkpoint", "#sub-list-checkpoint")
</script>
@endpush

@endsection