<?php  
    require_once 'koneksi.php';

    $query = "select * from topik_riset order by id desc";
    $result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Topik Riset</title>
    <link rel="stylesheet" href="style_topik.css">
</head>
<body>

    <!-- navbar -->
    <header class="navbar">
        <div class="nav-container">
            <a href="daftar_topik.html" class="nav-brand">
                <span>iRiset</span>
            </a>
            <nav>
                <ul class="nav-menu">
                    <li><a href="#" class="nav-btn">Home</a></li>
                    <li><a href="" class="nav-btn" >Mahasiswa</a></li>
                    <li><a href="" class="nav-btn">Dosen</a></li>
                    <li><a href="" class="nav-btn">Ruang Sidang</a></li>
                    <li><a href="" class="active nav-btn">Topik Riset</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-container">
        
        <!-- Header Halaman -->
        <section class="page-header">
            <h1 class="page-title">Katalog Topik Riset</h1>
        </section>

        <!-- Searchbar & Tombol Tambah -->
        <section class="action-toolbar">
            
            <form action="#" method="get" class="search-form">
                <div class="search-input-wrapper">
                    <input 
                        type="text" 
                        name="q" 
                        class="search-input" 
                        placeholder="Cari berdasarkan nama topik atau kata kunci penelitian..."
                    >
                </div>
                <button type="submit" class="btn btn-primary">
                    Cari
                </button>
            </form>
            <div class="btn-action">
                <a href="tambahTopik.php" class="btn-link">Tambah Topik</a>
            </div>
        </section>

        <!-- daftar topik riset -->
        <section class="topic-grid">

            <!-- card dinamis -->
            <?php while ($topik = mysqli_fetch_assoc($result)): ?>
                <article class="topic-card">
                    <div class="card-top">
                        <span class="badge-rumpun"><?php echo htmlspecialchars($topik['rumpunIlmu']) ?></span>
                    </div>
                    <h2 class="card-title"><?php echo htmlspecialchars($topik['namaTopik']) ?></h2>
                    <p class="card-description">
                        <?php echo nl2br(htmlspecialchars($topik['deskripsi'])) ?>
                    </p>
                    <div class="card-footer">
                    <span class="keywords-label">Kata Kunci Penelitian:</span>
                    <div class="tag-list">
                        <?php 
                        $tags = explode(',', $topik['kataKunci']); 
                        foreach ($tags as $tag): 
                            $tag = trim($tag);
                            if (!empty($tag)):
                        ?>
                            <span class="tag-item"><?php echo htmlspecialchars($tag); ?></span>
                        <?php 
                            endif;
                        endforeach; 
                        ?>
                    </div>
                    <div class="action-card">
                        <a href="hapustopik.php?id=<?php echo $topik['id']; ?>" onclick="return confirm('Yakin ingin menghapus topik ini?')" class="btn-hapus">Hapus</a>
                        <a href="editTopik.php?id=<?php echo $topik['id']; ?>" class="btn-edit">Edit</a>
                    </div>
                </div>
            </article>
    <?php endwhile; ?>
        </section>

    </main>

    <!-- footer -->
    <footer class="site-footer">
        <p>&copy; 2026 iRiset - Kelompok 11</p>
    </footer>

</body>
</html>
