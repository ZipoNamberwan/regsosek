@extends('main')

@section('stylesheet')
<link rel="stylesheet" href="/assets/vendor/select2/dist/css/select2.min.css">
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
                            <li class="breadcrumb-item active" aria-current="page">Tambah Entri K</li>
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
                        <h3 class="mb-0">Tambah Entrian K</h3>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <form id="formupdate" autocomplete="off" method="post" action="/IB21" class="needs-validation" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-control-label">Kecamatan <span class="text-danger">*</span></label>
                                    <select id="subdistrict" name="subdistrict" class="form-control" data-toggle="select" name="subdistrict" required>
                                        <option value="0" disabled selected> -- Pilih Kecamatan -- </option>
                                        @foreach ($subdistricts as $subdistrict)
                                        <option value="{{ $subdistrict->id }}" {{ old('subdistrict') == $subdistrict->id ? 'selected' : '' }}>
                                            [{{ $subdistrict->code}}] {{ $subdistrict->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('subdistrict')
                                <div class="text-valid">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <label class="form-control-label">Desa <span class="text-danger">*</span></label>
                                    <select id="village" name="village" class="form-control" data-toggle="select" name="village">
                                    </select>
                                </div>
                                @error('village')
                                <div class="text-valid">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <label class="form-control-label">SLS <span class="text-danger">*</span></label>
                                    <select id="sls" name="sls" class="form-control" data-toggle="select" name="sls">
                                    </select>
                                </div>
                                @error('sls')
                                <div class="text-valid">
                                    {{ $message }}
                                </div>
                                @enderror
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

<script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="/assets/vendor/js-cookie/js.cookie.js"></script>
<script src="/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>

<script src="/assets/vendor/select2/dist/js/select2.min.js"></script>
<script src="/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script>
    $(document).ready(function() {
        $('#subdistrict').on('change', function() {
            loadVillage('0');
        });
        $('#village').on('change', function() {
            loadSls('0');
        });
        $('#sls').on('change', function() {
            loadSls('0');
        });
    });

    function loadVillage(selectedvillage) {
        let id = $('#subdistrict').val();
        $('#village').empty();
        $('#village').append(`<option value="0" disabled selected>Processing...</option>`);
        $.ajax({
            type: 'GET',
            url: '/entry/village/' + id,
            success: function(response) {
                var response = JSON.parse(response);
                $('#village').empty();
                $('#village').append(`<option value="0" disabled selected>Pilih Desa</option>`);
                $('#sls').empty();
                $('#sls').append(`<option value="0" disabled selected>Pilih SLS</option>`);
                response.forEach(element => {
                    if (selectedvillage == String(element.id)) {
                        $('#village').append('<option value=\"' + element.id + '\" selected>' +
                            '[' + element.code + ']' + element.name + '</option>');
                    } else {
                        $('#village').append('<option value=\"' + element.id + '\">' + '[' +
                            element.code + '] ' + element.name + '</option>');
                    }
                });
            }
        });
    }

    function loadSls(selectedsls) {
        let id = $('#village').val();
        $('#sls').empty();
        $('#sls').append(`<option value="0" disabled selected>Processing...</option>`);
        $.ajax({
            type: 'GET',
            url: '/entry/sls/' + id,
            success: function(response) {
                var response = JSON.parse(response);
                $('#sls').empty();
                $('#sls').append(`<option value="0" disabled selected>Pilih SLS</option>`);
                response.forEach(element => {
                    if (selectedsls == String(element.id)) {
                        $('#sls').append('<option value=\" ' + element.id + ' \" selected>' +
                            '[' + element.code + ']' + element.name + '</option>');
                    } else {
                        $('#sls').append('<option value=\" ' + element.id + ' \">' + '[' +
                            element.code + '] ' + element.name + '</option>');
                  