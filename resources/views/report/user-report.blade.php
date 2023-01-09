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
                            <li class="breadcrumb-item active" aria-current="page">Rekap Entri</li>
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

    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h3 class="card-title mb-2">Rekap Entri Dokumen K Menurut Petugas</h3>
                        </div>
                        <div class="col-md-3 text-right">
                            <button onclick="onGenerate()" class="btn btn-icon btn-primary mb-2" type="button" disabled id="generateBtn">
                                <span class="btn-inner--icon"><i class="fas fa-download"></i></span>
                                <span class="btn-inner--text">Download</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive py-4">
                    <table class="table" id="datatable-id" width="100%">
                        <thead class="thead-light">
                            <tr>
                                <th>Nama</th>
                                <th>Jumlah SLS Selesai Entry</th>
                                <th>Jumlah SLS Sedang Entry</th>
                                <th>Jumlah SLS</th>
                                <th>Jumlah Dok K</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
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

<script>
    var table = $('#datatable-id').DataTable({
        // "responsive": true,
        // "fixedColumns": true,
        // "fixedHeader": true,
        "scrollX": true,
        "order": [],
        "aLengthMenu": [
            [-1],
            ["All"]
        ],
        "iDisplayLength": -1,
        "serverSide": true,
        "processing": true,
        "ajax": {
            "url": '/report/user/data',
            "type": 'GET'
        },
        "columns": [{
                "responsivePriority": 1,
                "width": "10%",
                "data": "name",
            },
            {
                "responsivePriority": 2,
                "width": "10%",
                "data": "entried",
            },
            {
                "responsivePriority": 3,
                "width": "10%",
                "data": "entrying",
            },
            {
                "responsivePriority": 3,
                "width": "10%",
                "data": "total_sls",
            },
            {
                "responsivePriority": 3,
                "width": "10%",
                "data": "total_entry",
            },
            {
                "responsivePriority": 3,
                "width": "10%",
                "data": "id",
                "orderable": false,
                "render": function(data, type, row) {
                    return "<a href=\"/report/user/" + data + "\" class=\"btn btn-outline-success btn-icon btn-sm\" target=\"_blank\" data-toggle=\"tooltip\" data-original-title=\"Tambah SLS\">" +
                        "<span class=\"btn-inner--icon\"><i class=\"fas fa-eye\"></i></span>" +
                        "</a>";
                }
            },
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