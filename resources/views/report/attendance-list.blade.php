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
                            <li class="breadcrumb-item active" aria-current="page">Daftar Absensi Hari Ini</li>
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
    <!-- Table -->
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <h3 class="card-title mb-2">Daftar Absensi Hari Ini</h3>
                        </div>
                        <div class="col-md-3 text-right">
                            <button onclick="onGenerate()" class="btn btn-icon btn-primary mb-2" type="button" disabled id="generateBtn">
                                <span class="btn-inner--icon"><i class="fas fa-comment-alt"></i></span>
                                <span class="btn-inner--text">Generate Pesan WA</span>
                            </button>
                            <a href="{{url('/mitra/create')}}" class="btn btn-primary btn-round btn-icon mb-2" data-toggle="tooltip" data-original-title="Download">
                                <span class="btn-inner--icon"><i class="fas fa-download"></i></span>
                                <span class="btn-inner--text">Download</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3 ml-4 mt-3">
                        <label class="form-control-label">Shift</span></label>
                        <select onchange="onShiftChange()" id="shift" name="shift" class="form-control" data-toggle="select" name="shift" required>
                            <option value="0" disabled selected> -- Pilih Shift -- </option>
                            @foreach ($shifts as $shift)
                            <option value="{{ $shift->id }}">
                                {{ $shift->name }}
                            </option>
                            @endforeach
                            <option value="99">
                                Semua Shift
                            </option>
                        </select>
                    </div>
                </div>
                <div class="table-responsive py-4">
                    <table class="table" id="datatable-id" width="100%">
                        <thead class="thead-light">
                            <tr>
                                <th>Nama</th>
                                <th>Absen Datang</th>
                                <th>Absen Pulang</th>
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
<script src="/assets/vendor/sweetalert2/dist/sweetalert2.js"></script>
<script src="/assets/vendor/datatables2/datatables.min.js"></script>
<script src="/assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/vendor/momentjs/moment-with-locales.js"></script>
<script src="/assets/vendor/sweetalert2/dist/sweetalert2.js"></script>
<script src="/assets/vendor/select2/dist/js/select2.min.js"></script>

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
            "url": '/attendance/list/data',
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
                "data": "in",
            },
            {
                "responsivePriority": 3,
                "width": "10%",
                "data": "out",
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

<script>
    function onShiftChange() {
        var e = document.getElementById("shift");
        var idshift = e.options[e.selectedIndex].value;
        url = ''
        if (idshift != 99 && idshift != 0) {
            url = '/attendance/list/data/' + idshift
            document.getElementById('generateBtn').disabled = false
        } else {
            url = '/attendance/list/data/'
            document.getElementById('generateBtn').disabled = true
        }
        table.ajax.url(url).load()
    }
</script>

<script>
    function onGenerate() {

        event.preventDefault();
        Swal.fire({
            title: 'Generate Pesan WA untuk yang Belum Absen',
            icon: 'warning',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Datang',
            denyButtonText: `Pulang`,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
        }).then((result) => {
            type = ''
            if (result.isConfirmed) {
                type = 'in'
            } else if (result.isDenied) {
                type = 'out'
            }

            document.getElementById('loading-background').style.display = 'block'
            var e = document.getElementById("shift");
            var idshift = e.options[e.selectedIndex].value;
            $.ajax({
                type: 'GET',
                url: '/message/' + idshift + '/' + type,
                success: function(response) {
                    var response = JSON.parse(response);
                    document.getElementById('loading-background').style.display = 'none'
                    Swal.fire(
                        'Pesan',
                        response.message,
                        'info'
                    )

                },
            });
        })
    }
</script>
@endsection