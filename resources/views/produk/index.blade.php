@extends('layout.template')

@section('konten')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h3 class="page-title">Produk</h3>
                    <p>Halaman ini digunakan untuk menambah, mengedit, dan menghapus Produk</p>
                    <div class="d-sm-flex">
                        <button class="btn btn-tambah mt-3 mb-3 mr-2" id="tambah-produk" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop" type="button" role="tab" style="transition: all 0.3s ease;"
                            onmouseover="this.style.boxShadow='0 0 10px yellow'" onmouseout="this.style.boxShadow='none'">
                            + Tambah Produk
                        </button>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table table-striped datatable" id="user-table">
                            <thead>
                                <tr>
                                    <th class="col-md-1">No.</th>
                                    <th class="col-md-2">Kode</th>
                                    <th class="col-md-2">Nama</th>
                                    <th class="col-md-2">Kategori</th>
                                    <th class="col-md-2">Harga Jual</th>
                                    <th class="col-md-2">Harga Beli</th>
                                    <th class="col-md-2">Stok</th>
                                    <th class="col-md-2">Aksi</th>
                                </tr>
                            </thead>


                            <tbody>
                                <?php $i = $data->firstItem(); ?>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $item->kode_produk }}</td>
                                        <td>{{ $item->nama_produk }}</td>
                                        <td>{{ $item->kategori->nama_kategori }}</td>
                                        <td>{{ $item->harga_jual }}</td>
                                        <td>{{ $item->harga_beli }}</td>
                                        <td>{{ $item->stok }}</td>
                                        <td class="text-center">
                                            <div class="d-grid gap-2">
                                                <button type="button"
                                                    onclick="editProduk('{{ $item->kode_produk }}', '{{ $item->nama_produk }}', '{{ $item->kategori_id }}', '{{ $item->harga_jual }}', '{{ $item->harga_beli }}', '{{ $item->stok }}')"
                                                    data-bs-toggle="modal" data-bs-target="#editProdukModal"
                                                    class="btn btn-outline-success btn-sm px-3 d-flex align-items-center gap-1"
                                                    style="transition: all 0.3s ease;"
                                                    onmouseover="this.style.boxShadow='0 0 10px yellow'"
                                                    onmouseout="this.style.boxShadow='none'"><i class="fas fa-edit"></i>
                                                    Edit</a>
                                                    <form onsubmit="return false" class="d-inline"
                                                        id="delete-produk-{{ $item->kode_produk }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button"
                                                            class="btn btn-outline-danger btn-sm px-3 d-flex align-items-center gap-1"
                                                            style="transition: all 0.3s ease;"
                                                            onmouseover="this.style.boxShadow='0 0 10px yellow'"
                                                            onmouseout="this.style.boxShadow='none'"
                                                            onclick="confirmDeleteProduk('{{ $item->kode_produk }}', '{{ $item->nama_produk }}')">
                                                            <i class="fas fa-trash-alt"></i> Hapus
                                                        </button>
                                                    </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $data->withQueryString()->links() }}
                    </div>

                    <form action='{{ url('produk') }}' method='post' id="produkForm"
                        onsubmit="return validateFormProduk()">
                        @csrf
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content" style="background-color: #aef7c6;">
                                    <div class="modal-header" style="background-color: #5caf67;">
                                        <h1 class="modal-title fs-5 text-center w-100 text-white" id="staticBackdropLabel">
                                            TAMBAH PRODUK
                                        </h1>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="kode_produk" class="form-label">Kode Produk</label>
                                            <input type="number"
                                                class="form-control @error('kode_produk') is-invalid @enderror"
                                                name='kode_produk' id="kode_produk"
                                                value="{{ Session::get('kode_produk') }}">
                                            @error('kode_produk')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="nama_produk" class="form-label">Nama Produk</label>
                                            <input type="text"
                                                class="form-control @error('nama_produk') is-invalid @enderror"
                                                name='nama_produk' id="nama_produk"
                                                value="{{ Session::get('nama_produk') }}">
                                            @error('nama_produk')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="kategori_id" class="form-label">Kategori Produk</label>
                                            <select class="form-control @error('kategori_id') is-invalid @enderror"
                                                name="kategori_id" id="kategori_id">
                                                <option value="">-- Pilih Kategori --</option>
                                                @foreach ($kategoris as $kat)
                                                    <option value="{{ $kat->id }}"
                                                        {{ old('kategori_id', Session::get('kategori_id')) == $kat->id ? 'selected' : '' }}>
                                                        {{ $kat->nama_kategori }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('kategori_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="harga_jual" class="form-label">Harga Jual</label>
                                            <input type="number"
                                                class="form-control @error('harga_jual') is-invalid @enderror"
                                                name='harga_jual' id="harga_jual"
                                                value="{{ Session::get('harga_jual') }}">
                                            @error('harga_jual')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="harga_beli" class="form-label">Harga Beli</label>
                                            <input type="number"
                                                class="form-control @error('harga_beli') is-invalid @enderror"
                                                name='harga_beli' id="harga_beli"
                                                value="{{ Session::get('harga_beli') }}">
                                            @error('harga_beli')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="stok" class="form-label">Stok</label>
                                            <input type="number" class="form-control @error('stok') is-invalid @enderror"
                                                name='stok' id="stok" value="{{ Session::get('stok') }}">
                                            @error('stok')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="modal-footer" style="background-color: #5caf67;">
                                        <button type="button" class="btn bg-danger text-white" data-bs-dismiss="modal"
                                            onmouseover="this.style.boxShadow='0 0 10px yellow'"
                                            onmouseout="this.style.boxShadow='none'">KELUAR</button>
                                        <button type="submit" class="btn bg-success text-white" name="submit"
                                            onmouseover="this.style.boxShadow='0 0 10px yellow'"
                                            onmouseout="this.style.boxShadow='none'">SIMPAN</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>


                    <form action='{{ url('produk') }}' method='post' id="edit-produk-form"
                        onsubmit="return validateEditProduk()">
                        @csrf
                        @method('PUT')
                        <div class="modal fade" id="editProdukModal" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="editProdukModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content" style="background-color: #ecdba1;">
                                    <div class="modal-header" style="background-color: #ac8021;">
                                        <h1 class="modal-title fs-5 text-center w-100 text-white"
                                            id="editProdukModalLabel">EDIT PRODUK</h1>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="edit_kode_produk" class="form-label">Kode Produk</label>
                                            <input type="text"
                                                class="form-control @error('kode_produk') is-invalid @enderror"
                                                name='kode_produk' id="edit_kode_produk">
                                            @error('kode_produk')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="edit_nama_produk" class="form-label">Nama Produk</label>
                                            <input type="text"
                                                class="form-control @error('nama_produk') is-invalid @enderror"
                                                name='nama_produk' id="edit_nama_produk">
                                            @error('nama_produk')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="edit_kategori_id" class="form-label">Kategori</label>
                                            <select class="form-control @error('kategori_id') is-invalid @enderror"
                                                name="kategori_id" id="edit_kategori_id">
                                                <option value="">-- Pilih Kategori --</option>
                                                @foreach ($kategoris as $kat)
                                                    <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('kategori_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="edit_harga_jual" class="form-label">Harga Jual</label>
                                            <input type="number"
                                                class="form-control @error('harga_jual') is-invalid @enderror"
                                                name='harga_jual' id="edit_harga_jual">
                                            @error('harga_jual')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="edit_harga_beli" class="form-label">Harga Beli</label>
                                            <input type="number"
                                                class="form-control @error('harga_beli') is-invalid @enderror"
                                                name='harga_beli' id="edit_harga_beli">
                                            @error('harga_beli')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="edit_stok" class="form-label">Stok</label>
                                            <input type="number"
                                                class="form-control @error('stok') is-invalid @enderror" name='stok'
                                                id="edit_stok">
                                            @error('stok')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer" style="background-color: #ac8021;">
                                        <button type="button" class="btn bg-danger text-white" data-bs-dismiss="modal"
                                            onmouseover="this.style.boxShadow='0 0 10px yellow'"
                                            onmouseout="this.style.boxShadow='none'">Batal</button>
                                        <button type="submit" class="btn bg-warning text-black" name="submit"
                                            onmouseover="this.style.boxShadow='0 0 10px yellow'"
                                            onmouseout="this.style.boxShadow='none'">Simpan Perubahan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                @endsection


                @include('komponen.pesan')
                <!-- AKHIR DATA -->
