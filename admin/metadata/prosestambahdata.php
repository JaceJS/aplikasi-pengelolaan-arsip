<?php
session_start();
require_once("../../config/koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari formulir
    $kata_kunci = $_POST["kata_kunci"];
    $format = $_POST["format"];
    $footage_start = $_POST["footage_start"];
    $lokasi_penyimpanan = $_POST["lokasi_penyimpanan_id"];
    $lokasi_rekaman = $_POST["lokasi_rekaman"];
    $tanggal_rekaman = $_POST["tanggal_rekaman"];
    $kategori_rekaman_id = $_POST["kategori_rekaman_id"];
    $produser = $_POST["produser"];
    $keterangan = $_POST["keterangan"];

    // File gambar yang diupload
    $gambar_name = $_FILES['gambar']['name'];
    $gambar_tmp_name = $_FILES['gambar']['tmp_name'];
    $gambar_size = $_FILES['gambar']['size'];
    $gambar_type = $_FILES['gambar']['type'];

    // Jika ada gambar yang diupload
    if (!empty($gambar_name)) {
        // Lokasi direktori penyimpanan gambar
        $upload_directory = "gambar_upload/";

        // Buat nama file baru dengan tambahan string unik menggunakan uniqid()
        $new_filename = uniqid() . "_" . $gambar_name;

        // Buat path lengkap untuk gambar baru
        $gambar_path = $upload_directory . $new_filename;

        // Validasi ukuran gambar (maksimal 5MB)
        if ($gambar_size > 5 * 1024 * 1024) {
            echo "<script>alert('Ukuran gambar terlalu besar. Maksimal 5MB.'); window.location.href='tambahdata.php';</script>";
            exit();
        }

        // Validasi tipe file gambar (hanya JPG, JPEG, PNG, dan GIF yang diperbolehkan)
        $allowed_formats = array("jpg", "jpeg", "png", "gif");
        $file_extension = strtolower(pathinfo($gambar_name, PATHINFO_EXTENSION));
        if (!in_array($file_extension, $allowed_formats)) {
            echo "<script>alert('Hanya file JPG, JPEG, PNG, dan GIF yang diizinkan.'); window.location.href='tambahdata.php';</script>";
            exit();
        }
        // Pindahkan gambar ke direktori yang ditentukan
        if (!move_uploaded_file($gambar_tmp_name, $gambar_path)) {
            echo "<script>alert('Gagal mengunggah gambar.'); window.location.href='prosestambahdata.php';</script>";
            exit();
        }
    } else {
        // Jika tidak ada gambar yang diupload, gunakan nilai default untuk path gambar
        $gambar_path = null;
    }

    // Siapkan prepared statement untuk menambah data ke database
    $stmt = $mysqli->prepare("INSERT INTO metadata_video (kata_kunci, format, footage_start, lokasi_penyimpanan_id, lokasi_rekaman, tanggal_rekaman, kategori_rekaman_id, produser, keterangan, gambar) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameter ke prepared statement
    $stmt->bind_param("sssississs", $kata_kunci, $format, $footage_start, $lokasi_penyimpanan, $lokasi_rekaman, $tanggal_rekaman, $kategori_rekaman_id, $produser, $keterangan, $gambar_path);

    // Eksekusi prepared statement
    if ($stmt->execute()) {
        echo "<script>alert('Data $kata_kunci berhasil ditambah.'); window.location.href='kelola-metadata.php';</script>";
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Tutup prepared statement
    $stmt->close();

    // Tutup koneksi
    $mysqli->close();
}
