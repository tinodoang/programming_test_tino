@extends('layout.template')
<style>
    .btn:hover {
        transform: scale(1.03);
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.3);
    }

    .btn-outline-primary:hover {
        background-color: #0d6efd;
        color: white;
        border-color: #0d6efd;
    }

    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white;
        border-color: #dc3545;
    }
</style>

<!-- START DATA -->
@section('konten')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h3 class="page-title">User</h3>
                    <p>Halaman ini digunakan untuk menambah, mengedit, dan menghapus user</p>
                    <div class="d-sm-flex">
                        <button data-bs-target="#staticBackdrop" class="btn btn-tambah mt-3 mb-3 mr-2" id="tambah-user"
                            data-bs-toggle="modal" type="button" role="tab" style="transition: all 0.3s ease;"
                            onmouseover="this.style.boxShadow='0 0 10px yellow'" onmouseout="this.style.boxShadow='none'">
                            + Tambah User
                        </button>
                    </div>
                    <div class="table-responsive mt-4">
                        <table class="table table-striped datatable" id="user-table">
                            <thead>
                                <tr>
                                    <th class="col-md-1">No.</th>
                                    <th class="col-md-2">Nama</th>
                                    <th class="col-md-3">Email</th>
                                    <th class="col-md-2">Peran</th>
                                    <th class="col-md-2">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if ($data->count() > 0)
                                    <?php $i = $data->firstItem(); ?>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->peran }}</td>
                                            <td class="text-center">
                                                <div class="d-grid gap-2">
                                                    <button type="button"
                                                        onclick="editUser('{{ $item->email }}', '{{ $item->name }}', '{{ $item->peran }}')"
                                                        data-bs-toggle="modal" data-bs-target="#editUserModal"
                                                        class="btn btn-outline-success btn-sm px-3 d-flex align-items-center gap-1"
                                                        style="transition: all 0.3s ease;">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>

                                                    <form onsubmit="return false" class="d-inline"
                                                        id="delete-email-{{ $item->email }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button"
                                                            class="btn btn-outline-danger btn-sm px-3 d-flex align-items-center gap-1"
                                                            onclick="confirmDeleteUser('{{ $item->email }}', '{{ $item->name }}')"
                                                            style="transition: all 0.3s ease;">
                                                            <i class="fas fa-trash-alt"></i> Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center border">Tidak ada data yang ditemukan</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        {{ $data->withQueryString()->links() }}
                    </div>

                    <form action='{{ url('user') }}' method='post' id="userForm" onsubmit="return validateForm()">
                        @csrf
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content" style="background-color: #aee2f7;">
                                    <div class="modal-header" style="background-color: #5c99af;">
                                        <h1 class="modal-title fs-5 text-center w-100 text-white" id="staticBackdropLabel">
                                            TAMBAH USER</h1>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nama : </label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name='name' id="name" value="{{ Session::get('name') }}">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email :</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                name='email' id="email" value="{{ Session::get('email') }}">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password :</label>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror" name='password'
                                                id="password">
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="peran" class="form-label">Peran : </label>
                                            <select name='peran' id="peran"
                                                class="form-select @error('peran') is-invalid @enderror"
                                                aria-label="Pilih Peran">
                                                <option selected disabled>-- Pilih Peran --</option>
                                                <option value="Admin"
                                                    {{ Session::get('peran') == 'Admin' ? 'selected' : '' }}>Admin</option>
                                                <option value="Kasir"
                                                    {{ Session::get('peran') == 'Kasir' ? 'selected' : '' }}>Kasir</option>
                                            </select>
                                            @error('peran')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="modal-footer" style="background-color: #5c99af;">
                                        <button type="button" class="btn bg-danger text-white" data-bs-dismiss="modal"
                                            onmouseover="this.style.boxShadow='0 0 10px yellow'"
                                            onmouseout="this.style.boxShadow='none'">KELUAR</button>
                                        <button type="submit" class="btn bg-primary text-white" name="submit"
                                            onmouseover="this.style.boxShadow='0 0 10px yellow'"
                                            onmouseout="this.style.boxShadow='none'">SIMPAN</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>


                    <form action='{{ url('user') }}' method='post' id="edit-user-form"
                        onsubmit="return validateEdit()">
                        @csrf
                        @method('PUT')
                        <div class="modal fade" id="editUserModal" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content" style="background-color: #ecdba1;">
                                    <div class="modal-header" style="background-color: #ac8021;">
                                        <h1 class="modal-title fs-5 text-center w-100 text-white" id="editUserModalLabel">
                                            EDIT USER</h1>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="edit_name" class="form-label">Nama : </label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name='name' id="edit_name">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="edit_email" class="form-label">Email : </label>
                                            <input type="email"
                                                class="form-control @error('email') is-invalid @enderror" name='email'
                                                id="edit_email">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="edit_password" class="form-label">Password : </label>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name='password' id="edit_password"
                                                placeholder="Kosongkan jika tidak ingin mengubah password">
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="edit_peran" class="form-label">Peran : </label>
                                            <select name="peran" id="edit_peran"
                                                class="form-control @error('peran') is-invalid @enderror"
                                                aria-label="Pilih Peran">
                                                <option disabled selected>-- Pilih Peran --</option>
                                                <option value="Admin">Admin</option>
                                                <option value="Kasir">Kasir</option>
                                            </select>
                                            @error('peran')
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
                <!-- AKHIR DATA -->
