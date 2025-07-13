@extends('layout.template')

<!-- START DATA -->
@section('konten')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h3 class="page-title">Kategori</h3>
                    <p>Halaman ini digunakan untuk menambah, mengedit, dan menghapus kategori</p>
                    <div class="table-responsive mt-4">
                        <table class="table table-striped datatable" id="user-table">
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
                                    @foreach ($item->detail as $details)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}</td>
                                            <td>{{ $details->produk->nama_produk ?? '-' }}</td>
                                            <td>{{ $details->jumlah }}</td>
                                            <td>Rp {{ number_format($details->sub_total, 0, ',', '.') }}</td>
                                            <td>
                                                <strong>Total:</strong><br>
                                                Rp {{ number_format($item->total_harga, 0, ',', '.') }}<br>
                                                <strong>Bayar:</strong><br>
                                                Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}<br>
                                                <strong>Kembalian:</strong><br>
                                                Rp {{ number_format($item->kembalian, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @include('komponen.pesan')
