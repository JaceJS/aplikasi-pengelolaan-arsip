<?php
session_start();
require_once("../../config/koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari formulir
    $lokasi = $_POST["lokasi"];

    // Siapkan prepared statement
    $stmt = $mysqli->prepare("INSERT INTO lokasi_penyimpanan (lokasi) VALUES (?)");

    // Bind parameter ke prepared statement
    $stmt->bind_param("s",  $lokasi);

    // Eksekusi prepared statement
    if ($stmt->execute()) {
        echo "<script>alert('Data $lokasi berhasil ditambah.'); window.location.href='kelola-lokasi.php';</script>";
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Tutup prepared statement
    $stmt->close();

    // Tutup koneksi
    $mysqli->close();
}
