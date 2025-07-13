@extends('layout.template')

<!-- START DATA -->
@section('konten')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h3 class="page-title">Kategori</h3>
                    <p>Halaman ini digunakan untuk menambah, mengedit, dan menghapus kategori</p>
                    <div class="d-sm-flex">
                        <button class="btn btn-tambah mt-3 mb-3 mr-2" id="tambah-kategori" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop" type="button" role="tab" style="transition: all 0.3s ease;"
                            onmouseover="this.style.boxShadow='0 0 10px yellow'" onmouseout="this.style.boxShadow='none'">
                            + Tambah Kategori
                        </button>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table table-striped datatable" id="user-table">
                            <thead>
                                <tr>
                                    <th class="col-md-1">No.</th>
                                    <th class="col-md-2">Nama Kategori</th>
                                    <th class="col-md-2">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = $data->firstItem(); ?>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $item->nama_kategori }}</td>
                                        <td class="text-center">
                                            <div class="d-grid gap-2">
                                                <button type="button"
                                                    onclick="editKategori({{ $item->id }}, '{{ $item->nama_kategori }}')"
                                                    data-bs-toggle="modal" data-bs-target="#editKategoriModal"
                                                    class="btn btn-outline-success btn-sm px-3 d-flex align-items-center gap-1"
                                                    style="transition: all 0.3s ease;">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <form onsubmit="return false" class="d-inline"
                                                    id="delete-kategori-{{ $item->nama_kategori }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-outline-danger btn-sm px-3 d-flex align-items-center gap-1"
                                                        style="transition: all 0.3s ease;"
                                                        onmouseover="this.style.boxShadow='0 0 10px yellow'"
                                                        onmouseout="this.style.boxShadow='none'"
                                                        onclick="confirmDeleteKategori('{{ $item->nama_kategori }}')">
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

                    <form action='{{ url('kategori') }}' method='post' id="tambah-kategori-form"
                        onsubmit="return validateFormKategori()">
                        @csrf
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content" style="background-color: #aef7c6;">
                                    <div class="modal-header" style="background-color: #5caf67;">
                                        <h1 class="modal-title fs-5 text-center w-100 text-white" id="staticBackdropLabel">
                                            TAMBAH KATEGORI
                                        </h1>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="nama_kategori" class="form-label">Nama Kategori : </label>
                                                <input type="text"
                                                    class="form-control @error('nama_kategori') is-invalid @enderror"
                                                    name='nama_kategori' id="nama_kategori"
                                                    value="{{ Session::get('nama_kategori') }}">
                                                @error('nama_kategori')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
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
                        </div>
                    </form>

                    <form action='' method='post' id="edit-kategori-form" onsubmit="return validateEditKategori()">
                        @csrf
                        @method('PUT')
                        <div class="modal fade" id="editKategoriModal" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="editKategoriModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content" style="background-color: #ecdba1;">
                                    <div class="modal-header" style="background-color: #ac8021;">
                                        <h1 class="modal-title fs-5 text-center w-100 text-white"
                                            id="editKategoriModalLabel">
                                            EDIT KATEGORI
                                        </h1>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="edit_nama_kategori" class="form-label">Nama Kategori : </label>
                                            <input type="text"
                                                class="form-control @error('nama_kategori') is-invalid @enderror"
                                                name='nama_kategori' id="edit_nama_kategori">
                                            @error('nama_kategori')
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

                </div>
            </div>
        </div>
    </div>
@endsection

@include('komponen.pesan')
