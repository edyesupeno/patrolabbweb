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
<!-- Container-fluid starts-->
<div class="container-fluid">
    <form action="{{ route('hak-akses.store') }}" method="post">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">

                    <div class="col">
                        <div class="mb-3 col-lg-3">
                            <label for="role_name" class="form-label">Role <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('role_name') is-invalid @enderror" name="role_name" id="role_name" placeholder="Masukkan Role" value="{{ old('role_name') }}">
                            @error('role_name')<span class="text-danger d-block">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="id_wilayah" class="form-label">Level Akses <span class="text-danger">*</span></label>
                            <select onchange="get_project(this.value)" class="form-select" name="id_wilayah" id="myselect0">
                                <option selected value="" disabled>Pilih Wilayah</option>
                                @foreach ($wilayah as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('id_wilayah') <span class="text-danger d-block">{{$message}}</span> @enderror
                        </div>

                        <div class="list-group mb-2" id="data_roject">

                        </div>
                        <div id="project_item" class="d-none">
                            <label class="list-group-item">
                                <input class="form-check-input me-1" type="checkbox" value="">
                                <span></span>
                            </label>
                        </div>

                        <div class="mb-3">
                            <label for="permission_id" class="form-label">Permission <span class="text-danger">*</span></label>
                            <div>
                                <!-- <b>Aset</b> -->

                                @foreach ($permission as $key=>$item)
                                <b>{{$key}}</b>
                                <ul class="list-group list-group-horizontal my-2">
                                    @foreach ($item as $index=>$value)
                                    <li class="list-group-item ">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="">
                                            <label class="form-check-label" for="">
                                                {{ $index }}
                                            </label>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                                @endforeach
                            </div>

                            @error('permission_id')<span class="text-danger d-block">{{ $message }}</span>@enderror
                        </div>
                    </div>

                </div>
                <div class="d-flex justify-content-start">
                    <button class="btn btn-success">Simpan</button>
                </div>
            </div>
        </div>
    </form>
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
<!-- Container-fluid Ends-->
@endsection