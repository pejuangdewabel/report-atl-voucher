<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>AYAM TEPI LAUT | ANCOL</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/demo_1/style.css') }}" />
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
</head>

<body>
    <div class="container-scroller">
        <!-- partial:../../partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item nav-profile border-bottom">
                    <a href="#" class="nav-link flex-column">
                        <div class="nav-profile-text d-flex ms-0 mb-3 flex-column">
                            <span class="font-weight-semibold mb-1 mt-2 text-center">Ayam Tepi Laut</span>
                            <span class="text-secondary icon-sm text-center">ANCOL</span>
                        </div>
                    </a>
                </li>

                <li class="pt-2 pb-1">
                    <span class="nav-item-head">Main Menu</span>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('report') }}">
                        <i class="mdi mdi-compass-outline menu-icon"></i>
                        <span class="menu-title">Download Laporan</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:../../partials/_settings-panel.html -->
            {{-- <div id="settings-trigger"><i class="mdi mdi-settings"></i></div> --}}
            <!-- partial -->
            <!-- partial:../../partials/_navbar.html -->
            <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
                <div class="navbar-menu-wrapper d-flex align-items-stretch">
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                        data-toggle="offcanvas">
                        <span class="mdi mdi-menu"></span>
                    </button>
                </div>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title">Download Laporan Transaksi Voucher Ayam Tepi Laut</h3>
                    </div>
                    <div class="row">
                        <div class="col-md-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Filter Tanggal</h4>
                                    <form class="forms-sample" method="POST" action="{{ route('report-filter') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="dateStart">Tanggal Awal</label>
                                                    <input type="date" class="form-control" id="dateStart"
                                                        name="dateStart" value="{{ $dateStart }}" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="dateFinish">Tanggal Akhir</label>
                                                    <input type="date" class="form-control" id="dateFinish"
                                                        name="dateFinish" value="{{ $dateFinish }}" />
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary me-2 w-100">Filter Data</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Data</h4>
                                    @if ($countData != 0)
                                        <p class="card-description"> Periode Tanggal :<code>
                                                {{ tanggal_indonesia($dateStart) }} -
                                                {{ tanggal_indonesia($dateFinish) }}</code>
                                        </p>
                                        <p class="card-description"> Total Data :<code>{{ $countData }}</code>
                                        </p>
                                        <form class="forms-sample mb-3" method="POST"
                                            action="{{ route('report-excel') }}">
                                            @csrf
                                            <input type="hidden" class="form-control" id="dateStart" name="dateStart"
                                                value="{{ $dateStart }}" />
                                            <input type="hidden" class="form-control" id="dateFinish" name="dateFinish"
                                                value="{{ $dateFinish }}" />
                                            <button type="submit" class="btn btn-success me-2 btn-sm">
                                                <i class="mdi mdi-file-excel"></i>
                                            </button>
                                        </form>
                                    @endif

                                    <div class="table-responsive">
                                        <table class="table table-hover" id="tableData">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Voucher</th>
                                                    <th>Tanggal Struk</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $d)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $d->voucherno }}</td>
                                                        <td>{{ tanggal_indonesia($d->strukdate) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- content-wrapper ends -->
                <!-- partial:../../partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright ©
                            2023</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
        crossorigin="anonymous"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    <!-- endinject -->

    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tableData').DataTable();
        });
    </script>
</body>

</html>
