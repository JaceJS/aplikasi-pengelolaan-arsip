<?php
session_start();
require_once("../../config/koneksi.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pencarian Rekaman</title>
    <link rel="stylesheet" href="<?php echo $base_url ?>/assets/bootstrap-v5.min.css">
    <link rel="stylesheet" href="<?php echo $base_url ?>/assets/datatables/dataTables.bootstrap4.min.css">
</head>

<body style="background: linear-gradient(to right, #ff9a9e, #fad0c4);">

    <?php include '../../templates/homenavbar.php'; ?>

    <main class="container shadow mb-4 p-4 rounded bg-light" style="max-width: 500px;">
        <form method="POST" action="prosestambahdata.php" enctype="multipart/form-data" class="mx-auto">
            <div class="mb-5 text-center">
                <h1 class="modal-title fs-3">Tambah Metadata</h1>
            </div>
            <div class="mb-3">
                <label for="kata_kunci" class="col-form-label"><b>Judul Footage</b></label>
                <input type="text" id="kata_kunci" class="form-control" placeholder="Masukkan Judul Footage" name="kata_kunci" required>
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
                <label for="lokasi_penyimpanan_id" class="col-form-label"><b>Lokasi Penyimpanan</b></label>
                <select class="form-select" id="lokasi_penyimpanan_id" name="lokasi_penyimpanan_id" required>
                    <option value="" disabled selected>Pilih Lokasi Penyimpanan</option>
                    <?php
                    $lokasi_query = "SELECT * from lokasi_penyimpanan";
                    $result_lokasi = $mysqli->query($lokasi_query);

                    if ($result_lokasi->num_rows > 0)
                        while ($row_lokasi = $result_lokasi->fetch_assoc()) {
                            echo "<option value='" . $row_lokasi['id'] . "'>" . $row_lokasi['lokasi'] . "</option>";
                        }
                    ?>
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
                <select class="form-select" id="kategori_rekaman_id" name="kategori_rekaman_id" required>
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
                <input type="file" class="form-control" id="gambar" name="gambar">
            </div>

            <div class="d-flex justify-content-between mt-5">
                <a href="kelola-metadata.php" type="button" class="btn btn-danger">Kembali</a>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>

    </main>

    <script src="<?php echo $base_url ?>/assets/bootstrap-v5.min.js"></script>
    <script src="<?php echo $base_url ?>/assets/bootstrap-v5.bundle.min.js"></script>
</body>

</html>