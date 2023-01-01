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
                            <li class="breadcrumb-item"><a href="/">Daftar Entrian K</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Rekap Entri K</li>
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
                        <h3 class="mb-3">Rekap Entri K</h3>
                        <h4>[{{$entry->slsdetail->fullcode()}}] {{$entry->slsdetail->fullname()}}</h4>
                        <!-- <p>Tanggal Mulai Entri: {{$entry->begin}}</p> -->
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <form id="formupdate" autocomplete="off" method="post" action="/entry/{{$entry->id}}/finish" class="needs-validation" enctype="multipart/form-data" novalidate>
                            @csrf
                            <input type="hidden" value="{{$entry->begin}}" name="begin">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div>
                                        <label class="form-control-label" for="exampleDatepicker">Tanggal Selesai Entri <span class="text-danger">*</span></label>
                                        <input name="finish" class="form-control @error('finish') is-invalid @enderror" placeholder="Select date" type="date" value="{{ @old('finish') }}">
                                        @error('finish')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-control-label" for="total_entry">Jumlah Dokumen K yang Dientri <span class="text-danger">*</span></label>
                                    <input type="number" name="total_entry" class="form-control @error('total_entry') is-invalid @enderror" id="validationCustom03" value="{{ @old('total_entry') }}">
                                    @error('total_entry')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label class="form-control-label" for="status_doc">Status Dokumen <span class="text-danger">*</span></label>
                                    <div class="custom-control custom-radio mb-3">
                                        <input name="status_doc" class="custom-control-input" id="status_doc1" value="1" type="radio" {{ old('status_doc') == '1' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="status_doc1">
                                            <h3><span class="badge badge-success">Clean</span></h3>
                                        </label>
                                    </div>

                                    <div class="custom-control custom-radio mb-3">
                                        <input name="status_doc" class="custom-control-input" id="status_doc2" value="2" type="radio" {{ old('status_doc') == '2' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="status_doc2">
                                            <h3><span class="badge badge-warning">Warning</span></h3>
                                        </label>
                                    </div>

                                    <div class="custom-control custom-radio mb-3">
                                        <input name="status_doc" class="custom-control-input" id="status_doc3" value="3" type="radio" {{ old('status_doc') == '3' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="status_doc3">
                                            <h3><span class="badge badge-danger">Error</span></h3>
                                        </label>
                                    </div>
                                    @error('status_doc')
                                    <div class="text-valid">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label" for="note">Catatan</label>
                                        <textarea class="form-control" id="note" name="note" rows="3">{{old('note')}}</textarea>
                                    </div>
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
<script src="/assets/vendor/sweetalert2/dist/sweetalert2.js"></script>
<script src="/assets/vendor/select2/dist/js/select2.min.js"></script>


@endsection