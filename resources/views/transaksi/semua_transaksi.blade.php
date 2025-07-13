@extends('layout.template')

@section('konten')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h3 class="page-title">Kategori</h3>
                    <p>Halaman ini digunakan untuk menambah, mengedit, dan menghapus kategori</p>

                    <!-- Tombol Cetak -->
                    <button onclick="printPenjualan()" class="btn btn-primary mb-3 no-print">
                        <i class="bi bi-printer"></i> Cetak Data Penjualan
                    </button>

                    <!-- Header Cetak (Hanya tampil saat print) -->
                    <div class="text-center mb-4 d-none d-print-block">
                        <h4><strong>Laporan Data Penjualan</strong></h4>
                        <p>Tanggal Cetak: {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }}</p>
                    </div>

                    <!-- Area Cetak -->
                    <div id="cetak-area" class="table-responsive mt-4">
                        <table class="table table-striped" id="user-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Nama Produk</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach ($transaksi as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>

                                        <td>
                                            <ul class="mb-0 ps-3">
                                                @foreach ($item->detail as $detail)
                                                    <li>{{ $detail->produk->nama_produk ?? '-' }}</li>
                                                @endforeach
                                            </ul>
                                        </td>

                                        <td>
                                            <ul class="mb-0 ps-3">
                                                @foreach ($item->detail as $detail)
                                                    <li>{{ $detail->jumlah }} Pcs</li>
                                                @endforeach
                                            </ul>
                                        </td>

                                        <td>
                                            <ul class="mb-0 ps-3">
                                                @foreach ($item->detail as $detail)
                                                    <li>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</li>
                                                @endforeach
                                            </ul>
                                        </td>

                                        <td>
                                            <strong>Total:</strong> Rp {{ number_format($item->total_harga, 0, ',', '.') }}<br>
                                            <strong>Bayar:</strong> Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}<br>
                                            <strong>Kembalian:</strong> Rp {{ number_format($item->kembalian, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@include('komponen.pesan')

<!-- Script Cetak -->
<script>
    function printPenjualan() {
        window.print();
    }
</script>

<!-- Style Untuk Print -->
<style>
    @media print {
        body * {
            visibility: hidden;
        }

        #cetak-area, #cetak-area * {
            visibility: visible;
        }

        #cetak-area {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            padding: 20px;
        }

        .no-print {
            display: none !important;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }

        ul {
            padding-left: 1rem;
        }
    }
</style>
