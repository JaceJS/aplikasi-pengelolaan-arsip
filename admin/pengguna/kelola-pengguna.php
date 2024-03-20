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
        <div class="table-responsive">
            <table class="table table-info table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Username</th>
                        <th scope="col">Role</th>
                        <th scope="col">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM users";
                    $result = $mysqli->query($sql);

                    if ($result->num_rows > 0) {
                        $no = 1;
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <tr>
                                <td width="3%"><?php echo $no++; ?></td>
                                <td><?php echo $row["username"]; ?></td>
                                <td><?php echo $row["role"]; ?></td>
                                <td>
                                    <form action="proseshapusdata.php?id=<?php echo $row['id']; ?>" onsubmit="return confirm('Yakin ingin hapus <?php echo $row['username']; ?>?');" method="POST">
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

        <?php include 'pop-up-tambahpengguna.php'; ?>

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
                url: 'pop-up-formeditpengguna.php',
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