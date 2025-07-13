<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Kasir Mini Tino</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    {{-- <link rel="stylesheet" href="{{ asset('/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('js/select.dataTables.min.css') }}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> --}}
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/custom.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('/img/logosd.png') }}" />
</head>

<style>
    /* .scrollable-element {
        height: 600px;
        overflow-y: auto;
    }

    .scrollable-element::-webkit-scrollbar {
        display: none;
    }

    .scrollable-element {
        scrollbar-width: none;
    } */

    .modal-content {
        border-radius: 10px;
        /* Rounded corners for the modal */
        border: none;
        background: #fff;
        padding: 20px;
    }

    /* Header Styling */
    .modal-header {
        border-bottom: 2px solid #e0e0e0;
        padding: 20px 25px;
    }

    .modal-title {
        font-size: 1.25rem;
        font-weight: bold;
    }

    /* Button Styling */
    .btn-primary {
        background-color: #5a52d4;
        border-color: #5a52d4;
        padding: 10px 20px;
        border-radius: 5px;
    }

    .btn-primary:hover {
        background-color: #645be7;
        border-color: #645be7;
    }

    .btn-outline-secondary {
        border-radius: 5px;
        border: 1px solid #6c757d;
        color: #6c757d;
    }

    .form-control {
        border-radius: 8px;
        padding: 12px;
        border: 1px solid #ced4da;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    /* Close Button */
    .close {
        font-size: 1.5rem;
        color: #fff;
        opacity: 0.8;
    }

    .close:hover {
        opacity: 1;
    }

    /* Error messages styling */
    .alert-danger {
        border-radius: 5px;
        padding: 10px;
    }
</style>

<body class="scrollable-element">

    <div class="d-flex flex-column min-vh-100">
        @include('layouts.sidebar')
        <main class="col-md-12 flex-grow-1">
            @yield('konten')
            @include('komponen.pesan')
        </main>
        <footer class="py-6 px-6 text-center">
            <p class="mb-0 fs-3">
                Design and Developed by
                <a href="https://minarsih.com/" target="_blank" class="pe-1"
                    style="color: #051df5; font-weight: bold; text-decoration: none">
                    Maretino Dikhwa
                </a>
            </p>
        </footer>
    </div>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin Mau Keluar</h5>
                    <button class="close align-content-between" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Logout" Jika Anda Ingin Keluar</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="{{ asset('logout') }}" method="post">
                        @csrf
                        <button class="btn btn-primary" type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('js/dataTables.select.min.js') }}"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('js/Chart.roundedBarCharts.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('scripts')
</body>

</html>
