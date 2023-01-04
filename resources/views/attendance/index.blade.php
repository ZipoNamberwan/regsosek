@extends('main')

@section('stylesheet')
<link rel="stylesheet" href="/assets/vendor/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="/assets/vendor/datatables2/datatables.min.css" />
<link rel="stylesheet" href="/assets/vendor/@fortawesome/fontawesome-free/css/fontawesome.min.css" />
@endsection

@section('container')
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#"><i class="ni ni-active-40"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Absensi Harian</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->

<div class="container-fluid mt--6">
    @if (session('success-edit') || session('success-create'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="fas fa-check-circle"></i></span>
        <span class="alert-text"><strong>Sukses! </strong>{{ session('success-create') }} {{ session('success-edit') }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @endif

    @if (session('success-delete'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="fas fa-check-circle"></i></span>
        <span class="alert-text"><strong>Sukses! </strong>{{ session('success-delete') }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @endif

    <!-- Table -->
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-1 mt-2">Absen Datang</h5>
                            @if($in != null)
                            <span class="h2 font-weight-bold mb-0">{{$in}}</span>
                            @else
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exclamation-triangle text-warning"></i>

                                <h3><span class="badge badge-warning">Belum Absen</span></h3>
                            </div>
                            @endif
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                <i class="ni ni-active-40"></i>
                            </div>
                        </div>
                    </div>
                    <form id="formin" method="post" action="/attendance" class="needs-validation" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('post')
                        <input type="hidden" value="in" name="type">
                        <input type="hidden" name="datetime">
                        <button class="btn btn-icon btn-primary btn-sm mt-3" type="submit" @if($in!=null) disabled @endif onclick="attendanceFormClick('in')">
                            <span class="btn-inner--icon"><i class="ni ni-active-40"></i></span>
                            <span class="btn-inner--text">Rekam</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-1 mt-2">Absen Pulang</h5>
                            @if($out != null)
                            <span class="h2 font-weight-bold mb-0">{{$out}}</span>
                            @else
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exclamation-triangle text-warning"></i>

                                <h3><span class="badge badge-warning">Belum Absen</span></h3>
                            </div>
                            @endif
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                <i class="ni ni-chart-pie-35"></i>
                            </div>
                        </div>
                    </div>
                    <form id="formout" method="post" action="/attendance" class="needs-validation" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('post')
                        <input type="hidden" value="out" name="type">
                        <input type="hidden" name="datetime">
                        <button class="btn btn-icon btn-primary btn-sm mt-3" type="submit" @if($out!=null) disabled @endif onclick="attendanceFormClick('out')">
                            <span class="btn-inner--icon"><i class="ni ni-active-40"></i></span>
                            <span class="btn-inner--text">Rekam</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h3 class="card-title mb-2">Absensi Harian</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('optionaljs')
<script src="/assets/vendor/sweetalert2/dist/sweetalert2.js"></script>

<script>
    function attendanceFormClick(type) {
        console.log(type)
        event.preventDefault();
        document.getElementById('loading-background').style.display = 'block'
        $.ajax({
            type: 'GET',
            url: '/attendance/time',
            success: function(response) {
                var response = JSON.parse(response);
                var datetimeels = document.getElementsByName("datetime");
                for (var i = 0; i < datetimeels.length; i++) {
                    datetimeels[i].value = response.datetime;
                }
                // console.log(response)
                Swal.fire({
                    title: type == 'in' ? 'Absen Datang' : 'Absen Pulang',
                    text: 'Tandai Kehadiran pada jam: ' + response.time,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('form' + type).submit();
                    }
                })

                document.getElementById('loading-background').style.display = 'none'
            },
        });
    }
</script>
@endsection