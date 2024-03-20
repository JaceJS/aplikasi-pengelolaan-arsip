<?php
session_start();
require_once("../../config/koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari formulir
    $kategori = $_POST["kategori"];

    // Siapkan prepared statement
    $stmt = $mysqli->prepare("INSERT INTO kategori_rekaman (kategori) VALUES (?)");

    // Bind parameter ke prepared statement
    $stmt->bind_param("s",  $kategori);

    // Eksekusi prepared statement
    if ($stmt->execute()) {
        echo "<script>alert('Data $kategori berhasil ditambah.'); window.location.href='kelola-kategori.php';</script>";
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Tutup prepared statement
    $stmt->close();

    // Tutup koneksi
    $mysqli->close();
}
