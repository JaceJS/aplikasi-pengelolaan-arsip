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

    <main class="container shadow p-4 rounded bg-light">
        <center>
            <!-- Tombol Tambah Data -->
            <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#modalTambahData" data-bs-whatever="modalTambahData">
                Tambah
            </button>
        </center>
        <hr>

        <!-- Tabel Kategori -->
        <div class="table-responsive">
            <table class="table table-info table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM kategori_rekaman"; // Ambil 1 data dari tabel kategori_rekaman dari phpmyadmin
                    $result = $mysqli->query($sql);

                    if ($result->num_rows > 0) { // Cek jika masih ada data di tabel kategori_rekaman
                        $no = 1;
                        while ($row = $result->fetch_assoc()) { // Ambil semua data menggunakan perulangan while
                    ?>
                            <tr>
                                <td width="3%"><?php echo $no++; ?></td>
                                <td><?php echo $row["kategori"]; ?></td>
                                <td>
                                    <form action="proseshapusdata.php?id=<?php echo $row['id']; ?>" onsubmit="return confirm('Yakin ingin hapus <?php echo $row['kategori']; ?>?');" method="POST">
                                        <button type="button" class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#modalEditData' data-bs-whatever='modalEditData' onclick="editData(<?php echo $row['id']; ?>)">Edit</button>
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>

            </table>
        </div>

        <?php include 'pop-up-tambahkategori.php'; ?>
        <?php include 'pop-up-editkategori.php'; ?>

    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="<?php echo $base_url ?>/assets/bootstrap-v5.min.js"></script>
    <script src="<?php echo $base_url ?>/assets/bootstrap-v5.bundle.min.js"></script>
    <!-- DataTables -->
    <script src="<?php echo $base_url ?>/assets/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo $base_url ?>/assets/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo $base_url ?>/assets/datatables/datatables-demo.js"></script>
    <script>
        function editData(id) {
            $.ajax({
                method: 'POST',
                url: 'pop-up-formeditkategori.php',
                data: {
                    id: id
                },
                success: function(response) {
                    $('#edit-form').html(response);
                }
            });
        }
    </script>
</body>

</html>