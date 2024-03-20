<?php
session_start();
require_once("config/koneksi.php");

$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Cek apakah username sudah ada di database
$stmt_check_username = $mysqli->prepare("SELECT username FROM users WHERE username = ?");
$stmt_check_username->bind_param("s", $username);
$stmt_check_username->execute();
$stmt_check_username->store_result();

if ($stmt_check_username->num_rows > 0) {
    $_SESSION['registration_error'] = '<div class="alert alert-danger" role="alert">Username sudah digunakan. Pilih username lain.</div>';
    header("Location: register.php");
    exit();
}

$stmt_check_username->close();

// Validasi input (Tambahkan validasi lebih lanjut sesuai kebutuhan)
if (empty($username) || empty($password) || empty($confirm_password)) {
    $_SESSION['registration_error'] = '<div class="alert alert-danger" role="alert">Semua kolom harus diisi</div>';
    header("Location: register.php");
    exit();
}

if ($password !== $confirm_password) {
    $_SESSION['registration_error'] = '<div class="alert alert-danger" role="alert">Konfirmasi password tidak sesuai</div>';
    header("Location: register.php");
    exit();
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$role = "anggota";  // Default role untuk pengguna baru	

// Simpan informasi pengguna ke database (gunakan parameterized query untuk mencegah SQL injection)
$stmt = $mysqli->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $hashed_password, $role);
$stmt->execute();

// Cek apakah pendaftaran berhasil
if ($stmt->affected_rows > 0) {
    $_SESSION['registration_success'] = '<div class="alert alert-success" role="alert">Pendaftaran berhasil. Silahkan login.</div>';
    header("Location: register.php");
    exit;
} else {
    $_SESSION['registration_error'] = '<div class="alert alert-danger" role="alert">Gagal mendaftar. Silahkan coba lagi.</div>';
    header("Location: register.php");
    exit();
}

$stmt->close();
$mysqli->close();
