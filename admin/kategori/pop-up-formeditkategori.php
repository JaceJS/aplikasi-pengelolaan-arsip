<?php
require_once '../../config/koneksi.php';

$id = $_POST['id'];
$sql = "SELECT * FROM kategori_rekaman WHERE id = $id";
$result = $mysqli->query($sql);

$row = $result->fetch_assoc();
?>

<!-- Inputan ID yang tersembunyi -->
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<!-- Form Inputan -->
<div class="mb-3">
    <label for="kategori" class="col-form-label"><b>Kategori</b></label>
    <input type="text" id="kategori" class="form-control" placeholder="Masukkan Kategori" name="kategori" value="<?php echo $row['kategori'] ?>" required>
</div>