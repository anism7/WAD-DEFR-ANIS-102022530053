<?php
    require_once 'koneksi.php';

    $namaTopik = $rumpunIlmu = $kataKunci = $deskripsi = "";
    $namaTopikErr = $rumpunIlmuErr = $kataKunciErr = $deskripsiErr = "";

    //validasi form
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $namaTopik = trim($_POST["namaTopik"]);
        if (empty($namaTopik)) {
            $namaTopikErr = "Nama Topik wajib diisi!!!";
        }
        $rumpunIlmu = trim($_POST["rumpunIlmu"]);
        if (empty($rumpunIlmu)) {
            $rumpunIlmuErr = "Rumpun Ilmu wajib diisi!!!";
        }
        $kataKunci = trim($_POST["kataKunci"]);
        if (empty($kataKunci)) {
            $kataKunciErr = "Kata Kunci wajib diisi!!!";
        }
        $deskripsi = trim($_POST["deskripsi"]);
        if (empty($deskripsi)) {
            $deskripsiErr = "Deskripsi wajib diisi!!!";
        }

        if (empty($namaTopikErr) && empty($rumpunIlmuErr) && empty($kataKunciErr) && empty($deskripsiErr)) {
            $query = "INSERT INTO topik_riset (namaTopik, rumpunIlmu, kataKunci, deskripsi) values ('$namaTopik', '$rumpunIlmu', '$kataKunci', '$deskripsi')";

            $simpan = mysqli_query($koneksi, $query);
            if ($simpan) {
                header("Location: daftar_topik.php");
                exit();
            }else{
                echo "Gagal menyimpan data: " . mysqli_error($koneksi);
            }
        }


    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Topik</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <h1 class="text-center mt-4">Tambah Topik</h1>
    <p class="text-center">Silakan isi form di bawah ini untuk menambahkan topik baru.</p>
    <div class="container mt-4">
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <div class="mb-3">
                <label for="namaTopik" class="form-label">Nama Topik</label>
                <input type="text" name="namaTopik" class="form-control" id="namaTopik" placeholder="Masukkan nama topik" value="<?php echo $namaTopik; ?>">
                <span class="eror">
                    <?php echo $namaTopikErr ? "* $namaTopikErr" : ""; ?>
                </span>
            </div>
            <div class="mb-3">
                <label for="rumpunIlmu" class="form-label">Rumpun Ilmu</label>
                <input type="text" name="rumpunIlmu" class="form-control" id="rumpunIlmu" placeholder="Masukkan rumpun ilmu" value="<?php echo $rumpunIlmu; ?>">
                <span class="eror">
                    <?php echo $rumpunIlmuErr ? "* $rumpunIlmuErr" : ""; ?>
                </span>
            </div>
            <div class="mb-3">
                <label for="kataKunci" class="form-label">Kata Kunci Penelitian</label>
                <input type="text" name="kataKunci" class="form-control" id="kataKunci" placeholder="Masukkan kata kunci penelitian" value="<?php echo $kataKunci; ?>">
                <span class="eror">
                    <?php echo $kataKunci ? "* $kataKunciErr" : ""; ?>
                </span>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" placeholder="Masukkan deskripsi topik" value="<?php echo $deskripsi; ?>"></textarea>
                <span class="eror">
                    <?php echo $deskripsiErr ? "* $deskripsiErr" : ""; ?>
                </span>
            </div>
            <button type="submit" class="btn btn-dark">Tambah Topik</button>

        </form>
</body>
</html>