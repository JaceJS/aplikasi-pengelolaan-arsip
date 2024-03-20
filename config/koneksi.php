<?php
// membuat variabel sesuai host, username, pass, nama_database, untuk koneksi ke database mysql
$host = "localhost:3307";
$username = "root";
$password = "";
$db = "arsip_db";

// membuat koneksi berdasarkan variabel diatas
$mysqli = new mysqli($host, $username, $password, $db);

// menampilkan pesan error jika koneksi gagal
if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

// membuat variabel base_url untuk menyimpan alamat website
$base_url = "http://localhost/web_arsip";
