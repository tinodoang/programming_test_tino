@extends('layout.template')

@section('konten')
    <div class="box-custom">
        <h3 class="page-title">Dashboard</h3>
        <span class="span-db">Selamat datang <span style="color: #423978; font-weight: bold">{{ auth()->user()->name }}</span> di halaman Dashboard</span>
        <div class="col-md-12 grid-margin mt-4">
            <div class="row">

                <div class="col-md-3 mb-4 stretch-card transparent">
                    <div class="card card-custom-6 shadow-sm">
                        <a href="{{ url('/user') }}" class="nav-link text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-users fa-3x mb-3"></i>
                                <p class="mb-2">Total User</p>
                                <h4 class="fs-30 mb-2">{{ $jumlahUser }}</h4>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-3 mb-4 stretch-card transparent">
                    <div class="card card-custom-1 shadow-sm">
                        <a href="{{ url('/kategori') }}" class="nav-link text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-tasks fa-3x mb-3"></i>
                                <p class="mb-2">Total Kategori</p>
                                <h4 class="fs-30 mb-2">{{ $jumlahKategori }}</h4>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-3 mb-4 stretch-card transparent">
                    <div class="card card-custom-2 shadow-sm">
                        <a href="{{ url('/produk') }}" class="nav-link text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-computer fa-3x mb-3"></i>
                                <p class="mb-2">Total Produk</p>
                                <h4 class="fs-30 mb-2">{{ $jumlahProduk }}</h4>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-3 mb-4 stretch-card transparent">
                    <div class="card card-custom-8 shadow-sm">
                        <a href="{{ url('/transaksi') }}" class="nav-link text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-dollar-sign fa-3x mb-3"></i>
                                <p class="mb-2">Pendapatan</p>
                                <h4 class="fs-4 mb-2">Rp. {{ number_format($totalPendapatan, 0, ',', '.') }}</h4>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@if (session('success'))
<script>
    Swal.fire({
        title: "Sukses!",
        text: "{{ session('success') }}",
        icon: "success",
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "OK"
    });
</script>
@endif
@endsection

