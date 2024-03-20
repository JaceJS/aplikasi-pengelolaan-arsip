<?php
session_start();
require_once("../../config/koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari formulir
    $id = $_POST["id"];
    $kategori = $_POST["kategori"];

    // Siapkan prepared statement
    $stmt = $mysqli->prepare("UPDATE kategori_rekaman SET kategori=? WHERE id=?");

    // Bind parameter ke prepared statement
    $stmt->bind_param("si", $kategori, $id);

    // Eksekusi prepared statement
    if ($stmt->execute()) {
        echo "<script>alert('Data $kategori berhasil diubah.'); window.location.href='kelola-kategori.php';</script>";
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Tutup prepared statement
    $stmt->close();

    // Tutup koneksi
    $mysqli->close();
}
