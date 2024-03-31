<?php
session_start();
require_once("config/koneksi.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$produser = $mysqli->real_escape_string($_GET['produser']);
$sql = "SELECT *
            FROM metadata_video 
            WHERE metadata_video.produser = '$produser'";
$result = $mysqli->query($sql);

// Menghitung jumlah data
$total_metadata = $result->num_rows;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pencarian Rekaman</title>
    <link rel="stylesheet" href="assets/bootstrap-v5.min.css">
</head>

<body style="background: linear-gradient(to right, #ff9a9e, #fad0c4);">

    <?php include 'templates/homenavbar.php'; ?>

    <main class="container">
        <div class="shadow mb-4 p-4 rounded bg-light">
            <h3 class="mb-4 fw-bold text-center">METADATA</h3>
            <hr>
            <h5>Terdapat total <?= $total_metadata ?> metadata yang diproduseri oleh <?= $produser ?>.</h5>
            <p class="mb-3">Berikut daftar metadata: </p>
            <div class="table-responsive">
                <table class="table table-info table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Tahun</th>
                            <th scope="col">Judul Footage</th>
                            <th scope="col">Format Penyimpanan</th>
                            <th scope="col">Produser</th>
                            <th scope="col">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            $no = 1;
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td width="3%"><?php echo $no++; ?></td>
                                    <td><?php echo date("Y", strtotime($row["tanggal_rekaman"])); ?></td>
                                    <td><?php echo $row["kata_kunci"]; ?></td>
                                    <td><?php echo $row["format"]; ?></td>
                                    <td><?php echo $row["produser"]; ?></td>
                                    <td>
                                        <form action="detail-metadata.php?id=<?php echo $row['id']; ?>" method="POST" target="_blank">
                                            <button type="submit" class='btn btn-info'>Selengkapnya</button>
                                        </form>
                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "<tr><td colspan='10'>Tidak ada arsip metadata</td></tr>";
                        }
                        ?>
                    </tbody>

                </table>
            </div>
        </div>

    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="assets/bootstrap-v5.min.js"></script>
    <script src="assets/bootstrap-v5.bundle.min.js"></script>
</body>

</html>