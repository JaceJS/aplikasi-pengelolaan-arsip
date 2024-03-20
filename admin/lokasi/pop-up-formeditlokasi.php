<?php
require_once '../../config/koneksi.php';

$id = $_POST['id'];
$sql = "SELECT * FROM lokasi_penyimpanan WHERE id = $id";
$result = $mysqli->query($sql);

$row = $result->fetch_assoc();
?>

<!-- Inputan ID yang tersembunyi -->
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<!-- Form Inputan -->
<div class="mb-3">
    <label for="lokasi" class="col-form-label"><b>Lokasi</b></label>
    <input type="text" id="lokasi" class="form-control" placeholder="Masukkan Lokasi" name="lokasi" value="<?php echo $row['lokasi'] ?>" required>
</div>