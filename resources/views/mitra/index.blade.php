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
                            <li class="breadcrumb-item active" aria-current="page">Daftar Petugas</li>
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
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h3 class="card-title mb-2">Daftar Petugas Pengolahan</h3>
                        </div>
                        <div class="col-md-3 text-right">
                            <a href="{{url('/mitra/create')}}" class="btn btn-primary btn-round btn-icon" data-toggle="tooltip" data-original-title="Tambah Mitra">
                                <span class="btn-inner--icon"><i class="fas fa-plus-circle"></i></span>
                                <span class="btn-inner--text">Tambah Mitra</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="table-responsive py-4">
                    <table class="table" id="datatable-id" width="100%">
                        <thead class="thead-light">
                            <tr>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Shift</th>
                                <th>Aksi</th>
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
<script src="/assets/vendor/sweetalert2/dist/sweetalert2.js"></script>

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
            "url": '/mitra/data',
            "type": 'GET'
        },
        "columns": [{
                "responsivePriority": 1,
                "width": "10%",
                "data": "name",
            },
            {
                "responsivePriority": 2,
                "width": "5%",
                "data": "username",
            },
            {
                "responsivePriority": 3,
                "width": "5%",
                "data": "shift",
                "orderable": false,
            },
            {
                "responsivePriority": 4,
                "width": "5%",
                "data": "id",
                "orderable": false,
                "render": function(data, type, row) {
                    return "<a href=\"/mitra/" + data + "/edit\" class=\"btn btn-outline-success btn-icon btn-sm\" data-toggle=\"tooltip\" data-original-title=\"Tambah SLS\">" +
                        "<span class=\"btn-inner--icon\"><i class=\"fas fa-edit\"></i></span>" +
                        // "<span class=\"btn-inner--text\">Selesai</span>" +
                        "</a>" +
                        "<form class=\"d-inline\" id=\"formdelete" + data + "\" name=\"formdelete" + data + "\" onsubmit=\"deletemitra('" + data + "','" + row.name + "')\" method=\"POST\" action=\"/mitra/" + data + "\">" +
                        '@method("delete")' +
                        '@csrf' +
                        "<button class=\"btn btn-icon btn-outline-danger btn-sm\" type=\"submit\" data-toggle=\"tooltip\" data-original-title=\"Hapus Data\">" +
                        "<span class=\"btn-inner--icon\"><i class=\"fas fa-trash-alt\"></i></span></button></form>";
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

<script>
    function deletemitra($id, $name) {
        event.preventDefault();
        Swal.fire({
            title: 'Yakin Hapus Mitra Ini?',
            text: $name,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('formdelete' + $id).submit();
            }
        })
    }
</script>
@endsection