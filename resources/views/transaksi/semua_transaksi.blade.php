@extends('layout.template')

@section('konten')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h3 class="page-title">Riwayat Transaksi</h3>
                    <p>Halaman ini digunakan untuk melihat data transaksi yang telah berhasil</p>

                    <button onclick="printPenjualan()" class="btn btn-tambah mt-3 mb-3 mr-2 no-print">
                        <i class="fa-solid fa-print"></i> Cetak Data Penjualan
                    </button>

                    <div id="cetak-area" class="table-responsive mt-4">
                        <div class="text-center mb-4 d-print-block" style="display: none;">
                            <h4 class="fw-bold mb-0">LAPORAN DATA PENJUALAN</h4>
                            <small>Tanggal Cetak: {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }}</small>
                            <hr style="border: 1px solid #000;">
                        </div>

                        <div class="table-responsive mt-3">
                            <table class="table table-striped datatable" id="user-table">
                                <thead>
                                    <tr>
                                        <th style="width: 3%;">No.</th>
                                        <th style="width: 12%;">Tanggal</th>
                                        <th style="width: 15%;">Nama Kasir</th>
                                        <th style="width: 20%;">Nama Produk</th>
                                        <th style="width: 10%;">Jumlah</th>
                                        <th style="width: 15%;">Subtotal</th>
                                        <th style="width: 25%;">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($transaksi as $item)
                                        <tr style="page-break-inside: avoid;">
                                            <td>{{ $i++ }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>
                                            <td>{{ $item->user->name ?? 'Tidak diketahui' }}</td>
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
                                                <strong>Total:</strong> Rp
                                                {{ number_format($item->total_harga, 0, ',', '.') }}<br>
                                                <strong>Bayar:</strong> Rp
                                                {{ number_format($item->jumlah_bayar, 0, ',', '.') }}<br>
                                                <strong>Kembalian:</strong> Rp
                                                {{ number_format($item->kembalian, 0, ',', '.') }}
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
    </div>
@endsection

@include('komponen.pesan')

<script>
    function printPenjualan() {
        window.print();
    }
</script>

<style>
    /* Tampilan Cetak */
    @media print {
        @page {
            size: A4 portrait;
            margin: 1cm;
        }

        body * {
            visibility: hidden;
        }

        #cetak-area,
        #cetak-area * {
            visibility: visible;
        }

        #cetak-area {
            position: fixed;
            left: 0;
            top: 0;
            width: 100vw;
            height: 100vh;
            padding: 20px;
            background: white;
        }

        .no-print {
            display: none !important;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #000 !important;
            padding: 6px;
            text-align: left;
            vertical-align: top;
        }

        .d-print-block {
            display: block !important;
        }

        tr {
            page-break-inside: avoid;
        }
    }
</style>
