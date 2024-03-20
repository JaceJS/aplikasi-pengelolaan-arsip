<!-- Pop-up form tambah data -->
<div class="modal fade" id="modalTambahData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Metadata</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form method="POST" action="prosestambahdata.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="kata_kunci" class="col-form-label"><b>Kata Kunci</b></label>
                        <input type="text" id="kata_kunci" class="form-control" placeholder="Masukkan Kata Kunci" name="kata_kunci" required>
                    </div>
                    <div class="mb-3">
                        <label for="format" class="col-form-label"><b>Format</b></label>
                        <select class="form-select" id="format" name="format" required>
                            <option value="" disabled selected>Pilih Format</option>
                            <option value="DVD">DVD</option>
                            <option value="HD">HD</option>
                            <option value="File">File</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="footage_start" class="col-form-label"><b>Waktu Mulai (jj:mm:dd)</b></label>
                        <input type="text" id="footage_start" class="form-control" placeholder="Masukkan Waktu Mulai (jj:mm:dd)" name="footage_start" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" title="Format waktu harus jj:mm:dd" required>
                    </div>

                    <div class="mb-3">
                        <label for="lokasi_rekaman" class="col-form-label"><b>Lokasi Syuting</b></label>
                        <input type="text" id="lokasi_rekaman" class="form-control" placeholder="Masukkan Lokasi Syuting" name="lokasi_rekaman">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_rekaman" class="col-form-label"><b>Tanggal Rekaman</b></label>
                        <input type="date" id="tanggal_rekaman" class="form-control" name="tanggal_rekaman" required>
                    </div>
                    <div class="mb-3">
                        <label for="kategori_rekaman_id" class="col-form-label"><b>Kategori Rekaman</b></label>
                        <select class="form-select" id="kategori_rekaman_id" name="kategori_rekaman_id">
                            <option value="" disabled selected>Pilih Kategori Rekaman</option>
                            <?php
                            $kategori_query = "SELECT * from kategori_rekaman";
                            $result_kategori = $mysqli->query($kategori_query);

                            if ($result_kategori->num_rows > 0)
                                while ($row_kategori = $result_kategori->fetch_assoc()) {
                                    echo "<option value='" . $row_kategori['id'] . "'>" . $row_kategori['kategori'] . "</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="produser" class="col-form-label"><b>Produser</b></label>
                        <input type="text" id="produser" class="form-control" placeholder="Masukkan Produser" name="produser">
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="col-form-label"><b>Keterangan</b></label>
                        <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Masukkan keterangan"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="col-form-label"><b>Gambar</b></label>
                        <input type="file" class="form-control" id="gambar" name="gambar"></textarea>
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