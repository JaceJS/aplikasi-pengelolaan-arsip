<?php
session_start();
require_once("../../config/koneksi.php");
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../../index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari formulir
    if (isset($_GET["id"])) {
        $id = $_GET["id"];

        // Mendapatkan nama gambar lama
        $query_get_old_image = "SELECT gambar FROM metadata_video WHERE id=?";
        $stmt_get_old_image = $mysqli->prepare($query_get_old_image);
        $stmt_get_old_image->bind_param("i", $id);
        $stmt_get_old_image->execute();
        $result_get_old_image = $stmt_get_old_image->get_result();
        if ($result_get_old_image->num_rows === 1) {
            $row_old_image = $result_get_old_image->fetch_assoc();
            $old_image = $row_old_image['gambar'];

            // Hapus gambar lama jika ada
            if (file_exists($old_image)) {
                unlink($old_image);
            }
        } else {
            // Handle error jika data tidak ditemukan
            echo "Error: Data tidak ditemukan.";
            exit();
        }
        $stmt_get_old_image->close();

        // Siapkan prepared statement
        $stmt = $mysqli->prepare("DELETE FROM metadata_video WHERE id=?");

        // Bind parameter ke prepared statement
        $stmt->bind_param("i", $id);

        // Eksekusi prepared statement
        if ($stmt->execute()) {
            echo "<script>alert('Data berhasil dihapus.'); window.location.href='kelola-metadata.php';</script>";
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Tutup prepared statement
        $stmt->close();
    } else {
        // Handle error jika id tidak ditemukan
        echo "Error: ID tidak ditemukan.";
        exit();
    }
}
