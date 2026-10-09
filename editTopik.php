<?php
require_once 'koneksi.php';

// 1. Ambil ID dari URL
$id = $_GET['id'] ?? "";
if (empty($id)) {
    header("Location: daftar_topik.php");
    exit();
}

$namaTopik = $rumpunIlmu = $kataKunci = $deskripsi = "";
$namaTopikErr = $rumpunIlmuErr = $kataKunciErr = $deskripsiErr = "";

// 2. Ambil data lama dari database berdasarkan ID (Untuk isi Form)
$queryAmbil = "SELECT * FROM topik_riset WHERE id = '$id'";
$resultAmbil = mysqli_query($koneksi, $queryAmbil);
$data = mysqli_fetch_assoc($resultAmbil);

if (!$data) {
    header("Location: daftar_topik.php");
    exit();
}

// Isi nilai variabel awal dengan data lama dari DB
$namaTopik  = $data['namaTopik'];
$rumpunIlmu = $data['rumpunIlmu'];
$kataKunci  = $data['kataKunci'];
$deskripsi  = $data['deskripsi'];

// 3. Proses UPDATE data saat form di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namaTopik  = trim($_POST["namaTopik"] ?? "");
    $rumpunIlmu = trim($_POST["rumpunIlmu"] ?? "");
    $kataKunci  = trim($_POST["kataKunci"] ?? "");
    $deskripsi  = trim($_POST["deskripsi"] ?? "");

    // Validasi
    if (empty($namaTopik))  { $namaTopikErr  = "Nama Topik wajib diisi!!!"; }
    if (empty($rumpunIlmu)) { $rumpunIlmuErr = "Rumpun Ilmu wajib diisi!!!"; }
    if (empty($kataKunci))  { $kataKunciErr  = "Kata Kunci wajib diisi!!!"; }
    if (empty($deskripsi))  { $deskripsiErr  = "Deskripsi wajib diisi!!!"; }

    // Jika tidak ada error, jalankan query UPDATE
    if (empty($namaTopikErr) && empty($rumpunIlmuErr) && empty($kataKunciErr) && empty($deskripsiErr)) {
        $queryUpdate = "UPDATE topik_riset SET 
                            namaTopik  = '$namaTopik',
                            rumpunIlmu = '$rumpunIlmu',
                            kataKunci  = '$kataKunci',
                            deskripsi  = '$deskripsi'
                        WHERE id = '$id'";

        $update = mysqli_query($koneksi, $queryUpdate);

        if ($update) {
            header("Location: daftar_topik.php");
            exit();
        } else {
            echo "Gagal mengupdate data: " . mysqli_error($koneksi);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Topik Riset</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <h1 class="text-center mt-4">Edit Topik Riset</h1>
    <p class="text-center">Silakan ubah informasi topik riset di bawah ini.</p>
    
    <div class="container mt-4 mb-5">
        <form method="POST" action="">
            <div class="mb-3">
                <label for="namaTopik" class="form-label">Nama Topik</label>
                <input type="text" name="namaTopik" class="form-control" id="namaTopik" value="<?php echo htmlspecialchars($namaTopik); ?>">
                <span class="text-danger"><?php echo $namaTopikErr ? "* $namaTopikErr" : ""; ?></span>
            </div>

            <div class="mb-3">
                <label for="rumpunIlmu" class="form-label">Rumpun Ilmu</label>
                <input type="text" name="rumpunIlmu" class="form-control" id="rumpunIlmu" value="<?php echo htmlspecialchars($rumpunIlmu); ?>">
                <span class="text-danger"><?php echo $rumpunIlmuErr ? "* $rumpunIlmuErr" : ""; ?></span>
            </div>

            <div class="mb-3">
                <label for="kataKunci" class="form-label">Kata Kunci Penelitian</label>
                <input type="text" name="kataKunci" class="form-control" id="kataKunci" value="<?php echo htmlspecialchars($kataKunci); ?>">
                <span class="text-danger"><?php echo $kataKunciErr ? "* $kataKunciErr" : ""; ?></span>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="4"><?php echo htmlspecialchars($deskripsi); ?></textarea>
                <span class="text-danger"><?php echo $deskripsiErr ? "* $deskripsiErr" : ""; ?></span>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="daftar_topik.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>