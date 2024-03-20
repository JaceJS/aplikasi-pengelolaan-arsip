<?php
// Mulai sesi jika belum dimulai
session_start();

// Hapus semua data sesi
$_SESSION = array();

// Hapus cookie sesi jika ada
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 3600, '/');
}

// Hancurkan sesi
session_destroy();

// Redirect pengguna ke halaman login
header("Location: index.php");
exit;
