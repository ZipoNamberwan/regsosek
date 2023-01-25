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
        <span class="alert-text"><strong>Gagal! </strong>{{ session('success-delete') }}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @endif

    <!-- Table -->
    <div class="row">
        @if($statatttoday == null)
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
                        <button class="btn btn-icon btn-primary btn-sm mt-3" type="submit" onclick="attendanceFormClick('in')">
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
                        <button class="btn btn-icon btn-primary btn-sm mt-3" type="submit" onclick="attendanceFormClick('out')">
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
                            <h5 class="card-title text-uppercase text-muted mb-1 mt-2">Tidak Hadir</h5>
                            <span class="">Gunakan menu ini jika hari ini tidak masuk</span>
                        </div>
                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                            <i class="ni ni-chart-bar-32"></i>
                        </div>
                    </div>
                    <button class="btn btn-icon btn-primary btn-sm mt-3" type="submit" onclick="markNoAttendance()">
                        <span class="btn-inner--icon"><i class="ni ni-active-40"></i></span>
                        <span class="btn-inner--text">Rekam</span>
                    </button>
                </div>
            </div>
        </div>
        @else
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-1 mt-2">Tidak Hadir Hari Ini</h5>
                            <h3 class="font-weight-bold text-uppercase mt-1">{{$statatttoday->name}}</h3>
                            @if($note != null)<span>{{$note}}</span>@endif
                        </div>
                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                            <i class="ni ni-chart-bar-32"></i>
                        </div>
                    </div>
                    <form id="cancelnoatt" method="post" action="/attendance/noatt/cancel" class="needs-validation" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('post')
                        <button class="btn btn-icon btn-danger btn-sm mt-3" type="submit" onclick="cancelNoAttendance()">
                            <span class="btn-inner--icon"><i class="ni ni-active-40"></i></span>
                            <span class="btn-inner--text">Batalkan</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endif
    </div>
    @if($numnoatt > 0)
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-gradient-danger border-0">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-2 text-white">Jumlah Ketidakhadiran</h5>
                            <h5 class="card-title text-muted mb-3 text-white">Menunjukkan jumlah hari tidak absen datang atau pulang. *Hari ini belum dihitung</h5>
                            <span class="h1 font-weight-bold mb-0 text-white">{{$numnoatt}}/{{$daytotal}} Hari</span>
                            <div class="progress progress-xs mt-3 mb-0">
                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="{{floor($numnoatt/$daytotal * 100)}}" aria-valuemin="0" aria-valuemax="100" style="width: {{floor($numnoatt/$daytotal * 100)}}%;"></div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-sm btn-neutral mr-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <a href="#!" class="text-white">Untuk mengurangi jumlah ketidakhadiran, gunakan menu tandai kehadiran manual pada tabel di bawah</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endif
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

                <div class="table-responsive py-4">
                    <table class="table" id="datatable-id" width="100%">
                        <thead class="thead-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Datang</th>
                                <th>Pulang</th>
                                <th>Status Ketidakhadiran</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('optionaljs')
<script src="/assets/vendor/sweetalert2/dist/sweetalert2.js"></script>
<script src="/assets/vendor/datatables2/datatables.min.js"></script>
<script src="/assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/vendor/momentjs/moment-with-locales.js"></script>

<script>
    var table = $('#datatable-id').DataTable({
        // "responsive": true,
        // "fixedColumns": true,
        // "fixedHeader": true,
        "scrollX": true,
        "order": [],
        "aLengthMenu": [
            [10, 30, -1],
            [10, 30, "All"]
        ],
        "iDisplayLength": 10,
        "serverSide": true,
        "processing": true,
        "ajax": {
            "url": '/attendance/data',
            "type": 'GET'
        },
        "columns": [{
                "responsivePriority": 2,
                "width": "5%",
                "data": "date",
                "orderable": true,
                "render": function(data, type, row) {
                    var unixTimestamp = new Date(data).getTime() / 1000 - (new Date).getTimezoneOffset() * 60;
                    if (type === 'display' || type === 'filter') {
                        return moment.unix(unixTimestamp).locale('id').format('LL');
                    }
                    return unixTimestamp;
                }
            },
            {
                "responsivePriority": 2,
                "width": "5%",
                "data": "in",
                "orderable": false,
                "render": function(data, type, row) {
                    if (type === 'display') {
                        if (data == null) {
                            return `<button class="btn btn-icon btn-primary btn-sm" type="button" onclick="attendanceManualClick('in', '` + row.date + `')">
                            <span class="btn-inner--icon"><i class="ni ni-active-40"></i></span>
                            <span class="btn-inner--text">Rekam Manual</span>
                        </button>`
                        }
                    }
                    return data + (row.is_in_manual == true ? ' **' : '');
                }
            },
            {
                "responsivePriority": 2,
                "width": "5%",
                "data": "out",
                "orderable": false,
                "render": function(data, type, row) {
                    if (type === 'display') {
                        if (data == null) {
                            return `<button class="btn btn-icon btn-primary btn-sm" type="button" onclick="attendanceManualClick('out', '` + row.date + `')">
                            <span class="btn-inner--icon"><i class="ni ni-active-40"></i></span>
                            <span class="btn-inner--text">Rekam Manual</span>
                        </button>`
                        }
                    }
                    return data + (row.is_out_manual == true ? ' **' : '');
                }
            },
            {
                "responsivePriority": 2,
                "width": "3%",
                "data": "status_id",
                "orderable": false,
                "render": function(data, type, row) {
                    if (type === 'display') {
                        if (row.status_id != null) {
                            return "<div class=\"d-flex align-items-center\"><i class=\"fas fa-exclamation-triangle text-warning mr-1\"></i><h3><span class=\"badge badge-warning\">" + row.status_name + "</span></h3></div>";
                        } else {
                            return '-'
                        }
                    }
                    return data
                }
            },
            {
                "responsivePriority": 2,
                "width": "3%",
                "data": "note",
                "orderable": false,
            }
        ],
        "language": {
            'paginate': {
                'previous': '<i class="fas fa-angle-left"></i>',
                'next': '<i class="fas fa-angle-right"></i>'
            }
        }
    });
</script>

<script>
    function attendanceFormClick(type) {
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

<script>
    function markNoAttendance() {
        event.preventDefault();
        Swal.fire({
            title: 'Alasan Ketidakhadiran Hari Ini',
            html: `<form id="noatt" method="post" action="/attendance/noatt" class="needs-validation" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('post') <select id="statatt" name="statatt" class="form-control" data-toggle="select" name="statatt" required>
                                        <option value="0" disabled selected> -- Pilih Alasan -- </option>
                                        @foreach ($statatts as $statatt)
                                        <option value="{{ $statatt->id }}" {{ old('statatt') == $statatt->id ? 'selected' : '' }}>
                                            {{ $statatt->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                     <input type="text" id="note" name="note" class="swal2-input" placeholder="Catatan" required> </form>
            `,
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('noatt').submit();
            }
        })
    }
</script>

<script>
    function cancelNoAttendance() {
        event.preventDefault();
        Swal.fire({
            title: 'Batalkan Ketidakhadiran Hari Ini?',
            text: 'Membatalkan ketidakhadiran akan membuka absen kembali',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('cancelnoatt').submit();
            }
        })
    }
</script>

<script>
    function attendanceManualClick(type, date) {
        event.preventDefault();

        let maxdate = new Date(date);
        maxdate.setDate(maxdate.getDate() + 1);

        var unixTimestamp = new Date(date).getTime() / 1000 - (new Date).getTimezoneOffset() * 60;
        dateStr = moment.unix(unixTimestamp).locale('id').format('LL');

        Swal.fire({
            title: 'Absensi ' + (type == 'in' ? 'Datang' : 'Pulang') + ' Manual Tanggal ' + dateStr,
            html: `<form id="manualatt" method="post" action="/attendance/manual" class="needs-validation" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('post')
                        <input name="type" type="hidden" value="` + type + `">
                        <input name="date" type="hidden" value="` + date + `">
                        <div class="row">
         ` + (type == 'out' ? `<div class="col mb-2"><input name="datepick" type="date" value="` + date + `" max="` + maxdate.getFullYear() + `-` + String((maxdate.getMonth() + 1)).padStart(2, '0') + `-` + maxdate.getDate() + `" min="` + date + `" class="form-control">
            </div> ` : `<input name="datepick" type="hidden" value="` + date + `">`) + ` 
            <div class="col"><input name="timepick" type="time" class="form-control">
            </div>
            </div>
            </form>`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('manualatt').submit();
            }
        })
    }
</script>
@endsection