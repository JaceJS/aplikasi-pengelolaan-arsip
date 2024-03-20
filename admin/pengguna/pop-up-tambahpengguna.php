<!-- Pop-up form tambah data -->
<div class="modal fade" id="modalTambahData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pengguna</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form method="POST" action="prosestambahdata.php">
                    <div class="mb-3">
                        <label for="username" class="col-form-label"><b>Username</b></label>
                        <input type="text" id="username" class="form-control" placeholder="Masukkan Username" name="username" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="col-form-label"><b>Password</b></label>
                        <input type="password" id="password" class="form-control" placeholder="Masukkan Password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="col-form-label"><b>Role</b></label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="" disabled selected>Pilih Role</option>
                            <option value="Admin">Admin</option>
                            <option value="Anggota">Anggota</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>