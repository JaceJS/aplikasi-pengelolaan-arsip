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

    <main class="container mb-4 shadow p-4 rounded bg-light">
        <center>
            <!-- Tombol Tambah Data -->
            <a href="tambahdata.php" type="button" class="btn btn-primary mt-3">
                Tambah
            </a>
        </center>
        <hr>
        <div class="table-responsive">
            <table class="table table-info table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Judul Footage</th>
                        <th scope="col">Format Penyimpanan</th>
                        <th scope="col">Lokasi Penyimpanan</th>
                        <th scope="col">Footage (Waktu)</th>
                        <th scope="col">Lokasi Syuting</th>
                        <th scope="col">Tanggal Rekaman</th>
                        <th scope="col">Kategori Rekaman</th>
                        <th scope="col">Produser</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT metadata_video.*, kategori_rekaman.kategori AS kategori_rekaman, lokasi_penyimpanan.lokasi AS lokasi_penyimpanan
                            FROM metadata_video
                            LEFT JOIN kategori_rekaman ON metadata_video.kategori_rekaman_id = kategori_rekaman.id
                            LEFT JOIN lokasi_penyimpanan ON metadata_video.lokasi_penyimpanan_id = lokasi_penyimpanan.id";
                    $result = $mysqli->query($sql);

                    if ($result->num_rows > 0) {
                        $no = 1;
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <tr>
                                <td width="3%"><?php echo $no++; ?></td>
                                <td><?php echo $row["kata_kunci"]; ?></td>
                                <td><?php echo $row["format"]; ?></td>
                                <td><?php echo $row["lokasi_penyimpanan"]; ?></td>
                                <td><?php echo $row["footage_start"]; ?></td>
                                <td><?php echo $row["lokasi_rekaman"]; ?></td>
                                <td><?php echo $row["tanggal_rekaman"]; ?></td>
                                <td><?php echo $row["kategori_rekaman"]; ?></td>
                                <td><?php echo $row["produser"]; ?></td>
                                <td><?php echo $row["keterangan"]; ?></td>
                                <td>
                                    <?php if (!empty($row['gambar'])) : ?>
                                        <a data-fslightbox="mygalley" class="rounded-4" target="_blank" data-type="image" href="<?= $row['gambar'] ?>">
                                            <img style="max-width: 100px; max-height: 100px; margin: auto;" class="rounded-4 fit" src="<?= $row['gambar'] ?>" />
                                        </a>
                                    <?php else : ?>
                                        <p>Gambar tidak tersedia.</p>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <form action="proseshapusdata.php?id=<?php echo $row['id']; ?>" onsubmit="return confirm('Yakin ingin hapus <?php echo $row['kata_kunci']; ?>?');" method="POST">
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

        <?php include 'pop-up-editdata.php'; ?>

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
                url: 'pop-up-formeditdata.php',
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