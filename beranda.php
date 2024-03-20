<?php
session_start();
require_once("config/koneksi.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
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

    <main class="container shadow mb-4 p-4 rounded bg-light">
        <center>
            <!-- Inputan & Tombol Cari  -->
            <form action="beranda.php" method="GET" class="d-flex" style="max-width: 700px;" role="search">
                <label for="kata_kunci"></label>
                <input type="text" class="form-control me-2" id="kata_kunci" name="kata_kunci" placeholder="Masukkan kata kunci...">
                <button type="submit" class="btn btn-lg btn-success d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="white">
                        <path fill="none" d="M0 0h24v24H0z" />
                        <path d="M15.5 14h-.79l-.28-.27a6.5 6.5 0 0 0 1.48-5.34c-.47-2.78-2.79-5-5.59-5.34a6.505 6.505 0 0 0-7.27 7.27c.34 2.8 2.56 5.12 5.34 5.59a6.5 6.5 0 0 0 5.34-1.48l.27.28v.79l4.25 4.25c.41.41 1.08.41 1.49 0 .41-.41.41-1.08 0-1.49L15.5 14zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z" />
                    </svg>
                    <span class="ms-2">Cari</span>
                </button>
            </form>
        </center>
        <?php
        // Periksa apakah ada kata kunci yang dikirimkan melalui URL
        if (isset($_GET['kata_kunci']) && !empty($_GET['kata_kunci'])) {
            $kata_kunci = $_GET['kata_kunci'];

            // Lakukan kueri SQL untuk mencari metadata video berdasarkan kata kunci        
            $sql = "SELECT metadata_video.*, kategori_rekaman.kategori AS kategori_rekaman
            FROM metadata_video
            INNER JOIN kategori_rekaman ON metadata_video.kategori_rekaman_id = kategori_rekaman.id
            WHERE kata_kunci LIKE '%$kata_kunci%'";

            $result = $mysqli->query($sql);

        ?>
            <hr>
            <div class="table-responsive">
                <table class="table table-info table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
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
                                    <td><?php echo $row["kata_kunci"]; ?></td>
                                    <td><?php echo $row["format"]; ?></td>
                                    <td><?php echo $row["produser"]; ?></td>                                    
                                    <td>
                                    <form action="detail.php?id=<?php echo $row['id']; ?>" method="POST" target="_blank">
                                        <button type="submit" class='btn btn-info'>Selengkapnya</button>                                        
                                    </form>
                                </td>
                                </tr>
                    <?php
                            }
                        } else {
                            echo "<tr><td colspan='10'>Tidak ditemukan hasil yang sesuai dengan kata kunci: $kata_kunci</td></tr>";
                        }
                    }
                    ?>
                    </tbody>

                </table>
            </div>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="assets/bootstrap-v5.min.js"></script>
    <script src="assets/bootstrap-v5.bundle.min.js"></script>
</body>

</html>