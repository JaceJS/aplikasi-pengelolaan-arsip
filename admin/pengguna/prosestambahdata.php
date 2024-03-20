<?php
session_start();
require_once("../../config/koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari formulir    
    $username = $_POST['username'];
    $password = $_POST['password'];    
    $role = $_POST['role'];
    
    // Cek apakah username sudah ada di database
    $stmt_check_username = $mysqli->prepare("SELECT username FROM users WHERE username = ?");
    $stmt_check_username->bind_param("s", $username);
    $stmt_check_username->execute();
    $stmt_check_username->store_result();

    if ($stmt_check_username->num_rows > 0) {
        echo "<script>alert('GAGAL menambahkan, username $username sudah ada, gunakan yang lain.'); window.location.href='kelola-pengguna.php';</script>";
        exit();        
    }

    // tutup prepared stetement untuk username
    $stmt_check_username->close();

    // hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Simpan informasi pengguna ke database (gunakan prepared statement untuk mencegah SQL injection)
    $stmt = $mysqli->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hashed_password, $role);
    $stmt->execute();

    // Cek apakah pendaftaran berhasil
    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Data $username berhasil ditambah.'); window.location.href='kelola-pengguna.php';</script>";
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Tutup prepared statement
    $stmt->close();

    // Tutup koneksi
    $mysqli->close();

}
