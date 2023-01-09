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
                            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="{{url('/report/user')}}">Rekap Entri</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$user->name}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->

<div class="container-fluid mt--6">
    <!-- Table -->
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h3 class="card-title mb-2">Daftar Entrian Dokumen K {{$user->name}}</h3>
                        </div>
                    </div>
                </div>
                <div class="table-responsive py-4">
                    <table class="table" id="datatable-id" width="100%">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Status Entri</th>
                                <th>Kecamatan</th>
                                <th>Desa</th>
                                <th>SLS</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                                <th>Jumlah Entri</th>
                                <th>Status Dokumen</th>
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
<script src="/assets/vendor/datatables2/datatables.min.js"></script>
<script src="/assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/vendor/sweetalert2/dist/sweetalert2.js"></script>
<script src="/assets/vendor/momentjs/moment-with-locales.js"></script>

<script>
    var table = $('#datatable-id').DataTable({
        // "responsive": true,
        // "fixedColumns": true,
        // "fixedHeader": true,
        "scrollX": true,
        "order": [],
        "aLengthMenu": [
            [10, 50, -1],
            [10, 50, "All"]
        ],
        "iDisplayLength": -1,
        "serverSide": true,
        "processing": true,
        "ajax": {
            "url": '/report/user/data/{{$user->id}}',
            "type": 'GET'
        },
        "columns": [{
                "responsivePriority": 3,
                "width": "2%",
                "data": "index",
            }, {
                "responsivePriority": 1,
                "width": "5%",
                "data": "status_id",
                "orderable": false,
                "render": function(data, type, row) {
                    if (type == "display") {
                        let type = ""
                        let icon = ""
                        if (data == 2) {
                            type = "warning"
                            icon = "<i class=\"fas fa-exclamation-triangle text-warning\"></i>"
                        } else if (data == 3) {
                            type = "success"
                        } else {
                            type = "secondary"
                            icon = "<i class=\"fas fa-exclamation-triangle\"></i>"
                        }

                        return "<div class=\"d-flex align-items-center\">" + icon + "<h3><span class=\"badge badge-" + type + "\">" + row.status + "</span></h3></div>";
                    }
                    return data
                }
            },
            {
                "responsivePriority": 2,
                "width": "5%",
                "data": "subdistrict_code",
                "render": function(data, type, row) {
                    if (type == "display") {
                        return "[" + data + "] " + row.subdistrict;
                    }
                    return data
                }
            },
            {
                "responsivePriority": 2,
                "width": "5%",
                "data": "village_code",
                "render": function(data, type, row) {
                    if (type == "display") {
                        return "[" + data + "] " + row.village;
                    }
                    return data
                }
            },
            {
                "responsivePriority": 2,
                "width": "15%",
                "data": "sls_code",
                "render": function(data, type, row) {
                    if (type == "display") {
                        return "[" + data + "] " + row.sls;
                    }
                    return data
                }
            },
            {
                "responsivePriority": 2,
                "width": "5%",
                "data": "begin",
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
                "data": "finish",
                "render": function(data, type, row) {
                    var unixTimestamp = new Date(data).getTime() / 1000 - (new Date).getTimezoneOffset() * 60;
                    if ((type === 'display' || type === 'filter') && data != null) {
                        return moment.unix(unixTimestamp).locale('id').format('LL');
                    } else {
                        return "-"
                    }
                    return unixTimestamp;
                }
            },
            {
                "responsivePriority": 2,
                "width": "5%",
                "data": "total_entry",
            },
            {
                "responsivePriority": 2,
                "width": "5%",
                "data": "status_doc_id",
                "render": function(data, type, row) {
                    if (type == "display") {
                        let type = ""
                        if (data == 1) {
                            type = "success"
                        } else if (data == 2) {
                            type = "warning"
                        } else if (data == 3) {
                            type = "danger"
                        }

                        return "<h3><span class=\"badge badge-" + type + "\">" + row.status_doc + "</span></h3>";
                    }
                    return data
                }
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
@endsection