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
                    <li class="breadcrumb-item">Aset</li>
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
            <div class="d-flex justify-content-end">
                <button onclick="window.history.back()" class="btn btn-warning">
                    << Kembali</button>
            </div>
            <form action="{{route('wilayah.store')}}" method="POST">
                @csrf
                <div class="row row-cols-1 row-cols-lg-2">
                    <div class="col">
                        <div class="mb-3">
                            <label for="kode" class="form-label">Kode Aset <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('kode') is-invalid @enderror" name="kode" id="kode" value="{{old('kode')}}" placeholder="Masukkan kode aset">
                            @error('kode') <span class="text-danger d-block">{{$message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Aset <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" id="nama" value="{{old('nama')}}" placeholder="Masukkan Nama wilayah">
                            @error('nama') <span class="text-danger d-block">{{$message}}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('status') is-invalid @enderror" name="status" id="status" value="{{old('status')}}" placeholder="Masukkan status aset ">
                            @error('status') <span class="text-danger d-block">{{$message}}</span> @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->


<div class="mb-3 col-lg-3">
    <label for="id_wilayah" class="form-label">Level Akses Wilayah <span class="text-danger">*</span></label>
    <select onchange="get_project(this.value)" class="form-select" name="id_wilayah" id="myselect0">
        <option selected value="" disabled>Pilih Wilayah</option>
        @foreach ($wilayah as $item)
        <option value="{{ $item->id }}">{{ $item->nama }}</option>
        @endforeach
    </select>
    @error('id_wilayah') <span class="text-danger d-block">{{$message}}</span> @enderror
</div>

<div class="row row-cols-1 row-cols-lg-6 mb-2" id="data_roject">

    <div id="project_item" class="d-none">
        <label class="col">
            <input class="form-check-input me-1" type="checkbox" value="" name="project[]">
            <span></span>
        </label>
    </div>

    <script>
        function get_project(id_wilayah) {
            let project_base = $('#data_roject')
            let project_item = $('#project_item').clone().removeAttr('id')

            $.ajax({
                url: "{{url('/super-admin/hak-akses/project')}}/" + id_wilayah,
                method: 'get',
                //menghapus checkbox sebelumnya jika di select form lain
                beforeSend: function() {
                    project_base.html('')
                },

                success: function(response) {
                    let data = response.data
                    $.each(data, function(index, item) {
                        let project_item = $('#project_item').clone().removeAttr('id')
                        project_item.find('input').val(item.id)
                        project_item.find('span').text(item.nama_project)
                        //console.log(project_item.html())
                        project_item.find('label').appendTo(project_base)
                    })
                },
                error: function(response) {
                    project_base.html('<span>Tidak ada data project di wilayah ini</span>')
                }
            })
        }
    </script>
    @endsection