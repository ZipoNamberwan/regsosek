@extends('main')

@section('stylesheet')
<link rel="stylesheet" href="/assets/vendor/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="/assets/vendor/datatables2/datatables.min.css" />
<link rel="stylesheet" href="/assets/vendor/@fortawesome/fontawesome-free/css/fontawesome.min.css" />
<link rel="stylesheet" href="/assets/css/container.css">
<link rel="stylesheet" href="/assets/css/text.css">
@endsection

@section('container')
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#"><i class="fas fa-bell"></i></a></li>
                            <li class="breadcrumb-item"><a href="/attendance/list">Daftar Absensi Hari Ini</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Ubah Absensi Petugas</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
            <div class="card-wrapper">
                <!-- Custom form validation -->
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <h3 class="mb-3">Ubah Absensi Petugas</h3>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <form id="formupdate" autocomplete="off" method="post" action="/attendance/change" class="needs-validation" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-control-label">Nama <span class="text-danger">*</span></label>
                                    <select id="name" name="name" class="form-control" data-toggle="select" name="name" required>
                                        <option value="0" disabled selected> -- Pilih Nama Petugas -- </option>
                                        @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ old('name') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('name')
                                    <div class="text-valid mt-2">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label class="form-control-label" for="type">Tipe Absen <span class="text-danger">*</span></label>
                                    <div class="custom-control custom-radio mb-3">
                                        <input name="type" class="custom-control-input" id="type1" value="in" type="radio" {{ old('type') == '1' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="type1">
                                            <h3><span class="badge badge-success">Datang</span></h3>
                                        </label>
                                    </div>
                                    <div class="custom-control custom-radio mb-3">
                                        <input name="type" class="custom-control-input" id="type2" value="out" type="radio" {{ old('type') == '2' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="type2">
                                            <h3><span class="badge badge-info">Pulang</span></h3>
                                        </label>
                                    </div>
                                    @error('type')
                                    <div class="text-valid">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div>
                                        <label class="form-control-label" for="exampleDatepicker">Tanggal ABsen <span class="text-danger">*</span></label>
                                        <input name="date" class="form-control @error('date') is-invalid @enderror" placeholder="Select date" type="date" value="{{ @old('date') }}">
                                        @error('date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label class="form-control-label" for="type">Waktu <span class="text-danger">*</span></label>
                                    <input class="form-control" type="datetime-local" value="{{ @old('time') }}" id="example-datetime-local-input" name="time">
                                    @error('time')
                                    <div class="text-valid mt-2">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary mt-3" id="sbmtbtn" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('optionaljs')
<script src="/assets/vendor/select2/dist/js/select2.min.js"></script>

@endsection