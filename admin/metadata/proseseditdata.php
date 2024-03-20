<?php
session_start();
require_once("../../config/koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari formulir
    $id = $_POST["id"];
    $kata_kunci = $_POST["kata_kunci"];
    $format = $_POST["format"];
    $footage_start = $_POST["footage_start"];
    $lokasi_penyimpanan = $_POST["lokasi_penyimpanan_id"];
    $lokasi_rekaman = $_POST["lokasi_rekaman"];
    $tanggal_rekaman = $_POST["tanggal_rekaman"];
    $kategori_rekaman = $_POST["kategori_rekaman"];
    $produser = $_POST["produser"];
    $keterangan = $_POST["keterangan"];

    // File gambar yang diupload
    $gambar_name = $_FILES['gambar']['name'];
    $gambar_tmp_name = $_FILES['gambar']['tmp_name'];
    $gambar_size = $_FILES['gambar']['size'];
    $gambar_type = $_FILES['gambar']['type'];

    // Mendapatkan nama gambar lama
    $query_get_old_image = "SELECT gambar FROM metadata_video WHERE id=?";
    $stmt_get_old_image = $mysqli->prepare($query_get_old_image);
    $stmt_get_old_image->bind_param("i", $id);
    $stmt_get_old_image->execute();
    $result_get_old_image = $stmt_get_old_image->get_result();
    if ($result_get_old_image->num_rows === 1) {
        $row_old_image = $result_get_old_image->fetch_assoc();
        $old_image = $row_old_image['gambar'];
    } else {
        // Handle error jika data tidak ditemukan
        echo "Error: Data tidak ditemukan.";
        exit();
    }

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

        // Hapus gambar lama jika ada
        if (file_exists($old_image)) {
            unlink($old_image);
        }

        // Pindahkan gambar ke direktori yang ditentukan
        if (!move_uploaded_file($gambar_tmp_name, $gambar_path)) {
            echo "<script>alert('Gagal mengunggah gambar.'); window.location.href='prosestambahdata.php';</script>";
            exit();
        }
    } else {
        // Jika tidak ada gambar yang diupload, gunakan nilai default untuk path gambar
        $gambar_path = $old_image;
    }

    $stmt_get_old_image->close();

    // Siapkan prepared statement
    $stmt = $mysqli->prepare("UPDATE metadata_video SET kata_kunci=?, format=?, footage_start=?, lokasi_penyimpanan_id=?, lokasi_rekaman=?, tanggal_rekaman=?, kategori_rekaman_id=?, produser=?, keterangan=?, gambar=? WHERE id=?");

    // Bind parameter ke prepared statement
    $stmt->bind_param("sssississsi", $kata_kunci, $format, $footage_start, $lokasi_penyimpanan, $lokasi_rekaman, $tanggal_rekaman, $kategori_rekaman, $produser, $keterangan, $gambar_path, $id);

    // Eksekusi prepared statement
    if ($stmt->execute()) {
        echo "<script>alert('Data $kata_kunci berhasil diubah.'); window.location.href='kelola-metadata.php';</script>";
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Tutup prepared statement
    $stmt->close();

    // Tutup koneksi
    $mysqli->close();
}
