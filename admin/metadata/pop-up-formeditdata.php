<?php
require_once '../../config/koneksi.php';

$id = $_POST['id'];
$sql = "SELECT * FROM metadata_video WHERE id = $id";
$result = $mysqli->query($sql);

$row = $result->fetch_assoc();
?>

<!-- Inputan ID yang tersembunyi -->
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<!-- Form Inputan -->
<div class="mb-3">
    <label for="kata_kunci" class="col-form-label"><b>Judul Footage</b></label>
    <input type="text" id="kata_kunci" class="form-control" placeholder="Masukkan Judul Footage" name="kata_kunci" value="<?php echo $row['kata_kunci'] ?>" required>
</div>
<div class="mb-3">
    <label for="format" class="col-form-label"><b>Format</b></label>
    <select class="form-select" id="format" name="format" required>
        <option value="<?php echo $row['format'] ?>" selected><?php echo $row['format'] ?></option>
        <option value="DVD">DVD</option>
        <option value="HD">HD</option>
        <option value="File">File</option>
    </select>
</div>
<div class="mb-3">
    <label for="lokasi_penyimpanan_id" class="col-form-label"><b>Lokasi Penyimpanan</b></label>
    <select class="form-select" id="lokasi_penyimpanan_id" name="lokasi_penyimpanan_id">
        <?php
        $lokasi_query = "SELECT * FROM lokasi_penyimpanan";
        $result_lokasi = $mysqli->query($lokasi_query);

        if ($result_lokasi->num_rows > 0) {
            while ($row_lokasi = $result_lokasi->fetch_assoc()) {
                $selected = ($row_lokasi['id'] == $row['lokasi_penyimpanan_id']) ? 'selected' : '';
                echo "<option value='" . $row_lokasi['id'] . "' $selected>" . $row_lokasi['lokasi'] . "</option>";
            }
        }
        ?>
    </select>
</div>
<div class="mb-3">
    <label for="footage_start" class="col-form-label"><b>Waktu Mulai (jj:mm:dd)</b></label>
    <input type="text" id="footage_start" class="form-control" placeholder="Masukkan Waktu Mulai (jj:mm:dd)" name="footage_start" value="<?php echo $row['footage_start'] ?>" pattern="([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]" title="Format waktu harus jj:mm:dd" required>
</div>
<div class="mb-3">
    <label for="lokasi_rekaman" class="col-form-label"><b>Lokasi Syuting</b></label>
    <input type="text" id="lokasi_rekaman" class="form-control" placeholder="Masukkan Lokasi Syuting" name="lokasi_rekaman" value="<?php echo $row['lokasi_rekaman'] ?>">
</div>
<div class="mb-3">
    <label for="tanggal_rekaman" class="col-form-label"><b>Tanggal Rekaman</b></label>
    <input type="date" id="tanggal_rekaman" class="form-control" name="tanggal_rekaman" value="<?php echo $row['tanggal_rekaman'] ?>" crequired>
</div>
<div class="mb-3">
    <label for="kategori_rekaman" class="col-form-label"><b>Kategori Rekaman</b></label>
    <select class="form-select" id="kategori_rekaman" name="kategori_rekaman">
        <?php
        $kategori_query = "SELECT * FROM kategori_rekaman";
        $result_kategori = $mysqli->query($kategori_query);

        if ($result_kategori->num_rows > 0) {
            while ($row_kategori = $result_kategori->fetch_assoc()) {
                $selected = ($row_kategori['id'] == $row['kategori_rekaman_id']) ? 'selected' : '';
                echo "<option value='" . $row_kategori['id'] . "' $selected>" . $row_kategori['kategori'] . "</option>";
            }
        }
        ?>
    </select>
</div>
<div class="mb-3">
    <label for="produser" class="col-form-label"><b>Produser</b></label>
    <input type="text" id="produser" class="form-control" placeholder="Masukkan Produser" value="<?php echo $row['produser'] ?>" name="produser">
</div>
<div class="mb-3">
    <label for="keterangan" class="col-form-label"><b>Keterangan</b></label>
    <textarea class="form-control" id="keterangan" name="keterangan" value="<?php echo $row['keterangan'] ?>" placeholder="Masukkan keterangan"><?php echo $row['keterangan'] ?></textarea>
</div>
<div class="mb-3">
    <label for="gambar" class="col-form-label"><b>Gambar</b></label>
    <input type="file" class="form-control" id="gambar" name="gambar">
</div>