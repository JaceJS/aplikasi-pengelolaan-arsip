<?php
session_start();
require_once("../../config/koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari formulir
    $id = $_POST["id"];
    $lokasi = $_POST["lokasi"];

    // Siapkan prepared statement
    $stmt = $mysqli->prepare("UPDATE lokasi_penyimpanan SET lokasi=? WHERE id=?");

    // Bind parameter ke prepared statement
    $stmt->bind_param("si", $lokasi, $id);

    // Eksekusi prepared statement
    if ($stmt->execute()) {
        echo "<script>alert('Data $lokasi berhasil diubah.'); window.location.href='kelola-lokasi.php';</script>";
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Tutup prepared statement
    $stmt->close();

    // Tutup koneksi
    $mysqli->close();
}
