<?php
session_start();
require_once("../../config/koneksi.php");
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../../index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari formulir
    $id = $_GET["id"];

    // Siapkan prepared statement
    $stmt = $mysqli->prepare("DELETE FROM lokasi_penyimpanan WHERE id=?");

    // Bind parameter ke prepared statement
    $stmt->bind_param("i", $id);

    // Eksekusi prepared statement
    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil dihapus.'); window.location.href='kelola-lokasi.php';</script>";
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Tutup prepared statement
    $stmt->close();

    // Tutup koneksi
    $mysqli->close();
}
