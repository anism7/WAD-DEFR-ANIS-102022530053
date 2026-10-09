<?php
require_once 'koneksi.php';

// Cek apakah ada parameter 'id' di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data berdasarkan ID
    $query = "DELETE FROM topik_riset WHERE id = '$id'";
    $delete = mysqli_query($koneksi, $query);

    if ($delete) {
        // Berhasil hapus, balikkan ke daftar topik
        header("Location: daftar_topik.php");
        exit();
    } else {
        echo "Gagal menghapus data: " . mysqli_error($koneksi);
    }
} else {
    // Jika diakses tanpa ID, lempar balik ke daftar topik
    header("Location: daftar_topik.php");
    exit();
}
?>