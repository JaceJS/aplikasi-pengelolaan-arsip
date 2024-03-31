<?php
session_start();
require_once("config/koneksi.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}


$id = $_GET['id'];
$sql = "SELECT metadata_video.*, kategori_rekaman.kategori AS kategori_rekaman, lokasi_penyimpanan.lokasi AS lokasi_penyimpanan
            FROM metadata_video
            LEFT JOIN kategori_rekaman ON metadata_video.kategori_rekaman_id = kategori_rekaman.id
            LEFT JOIN lokasi_penyimpanan ON metadata_video.lokasi_penyimpanan_id = lokasi_penyimpanan.id
            WHERE metadata_video.id = $id";

$result = $mysqli->query($sql);

$row = $result->fetch_assoc();

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

    <?php include 'templates/homenavbar.php'; ?>

    <main class="container shadow mb-4 p-4 rounded bg-light">
        <section class="pt-5">
            <div class="container">
                <div class="row gx-5">
                    <aside class="col-lg-6">
                        <div class="border rounded-4 mb-3 d-flex justify-content-center">
                            <?php if (!empty($row['gambar'])) : ?>
                                <a data-fslightbox="mygalley" class="rounded-4" target="_blank" data-type="image" href="<?= "admin/metadata/" .  $row['gambar'] ?>">
                                    <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit" src="<?= "admin/metadata/" . $row['gambar'] ?>" />
                                </a>
                            <?php else : ?>
                                <p>Gambar tidak tersedia.</p>
                            <?php endif; ?>
                        </div>
                    </aside>
                    <main class="col-lg-6">
                        <div class="ps-lg-3">
                            <h3 class="title text-dark mb-4">
                                <?php echo $row['kata_kunci'] ?>
                            </h3>

                            <div class="row">
                                <dt class="col-4">Format Penyimpanan</dt>
                                <dd class="col-5">: <?php echo $row["format"]; ?></dd>
                                <hr>
                                <dt class="col-4">Lokasi Penyimpanan</dt>
                                <dd class="col-5">: <?php echo $row["lokasi_penyimpanan"]; ?></dd>
                                <hr>
                                <dt class="col-4">Footage (Waktu)</dt>
                                <dd class="col-5">: <?php echo $row["footage_start"]; ?></dd>
                                <hr>
                                <dt class="col-4">Lokasi Syuting</dt>
                                <dd class="col-5">: <?php echo $row["lokasi_rekaman"]; ?></dd>
                                <hr>
                                <dt class="col-4">Tanggal Syuting</dt>
                                <dd class="col-5">: <?php echo $row["tanggal_rekaman"]; ?></dd>
                                <hr>
                                <dt class="col-4">Kategori (Program)</dt>
                                <dd class="col-5">: <?php echo $row["kategori_rekaman"]; ?></dd>
                                <hr>
                                <dt class="col-4">Produser</dt>
                                <dd class="col-5">: <a href="detail-produser.php?produser=<?php echo $row["produser"]; ?>"><?php echo $row["produser"]; ?></a></dd>
                                <hr>
                                <dt class="col-4">Keterangan</dt>
                                <dd class="col-5">: <?php echo $row["keterangan"]; ?></dd>
                                <hr>
                            </div>


                            <a href="beranda.php" class="btn btn-danger shadow-0 my-2">Kembali</a>
                        </div>
                    </main>
                </div>
            </div>
        </section>
        <!-- content -->

    </main>

    <script src="<?php echo $base_url ?>/assets/bootstrap-v5.min.js"></script>
    <script src="<?php echo $base_url ?>/assets/bootstrap-v5.bundle.min.js"></script>
</body>

</html>