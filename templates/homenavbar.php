<nav class="navbar navbar-expand-lg topbar mb-4 static-top shadow text-dark" style="background-color: #ffd3b6;">
    <div class="container">
        <a class="navbar-brand fw-bold" href="home.php">
            <img src="<?php echo $base_url ?>/images/logo.png" width="80px" alt="logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto">

                <!-- Menu staff -->
                <?php if ($_SESSION['role'] == 'anggota') { ?>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold me-3" href="<?php echo $base_url ?>/beranda.php">Beranda</a>
                    </li>
                <?php } ?>

                <!-- Menu admin -->
                <?php if ($_SESSION['role'] == 'admin') { ?>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold me-3" href="<?php echo $base_url ?>/admin/metadata/kelola-metadata.php">Metadata</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold me-3" href="<?php echo $base_url ?>/admin/kategori/kelola-kategori.php">Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold me-3" href="<?php echo $base_url ?>/admin/lokasi/kelola-lokasi.php">Lokasi Penyimpanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold me-3" href="<?php echo $base_url ?>/admin/pengguna/kelola-pengguna.php">Pengguna</a>
                    </li>
                    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold me-3" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Menu Admin
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo $base_url ?>/admin/metadata/kelola-metadata.php">Metadata</a></li>
                            <li><a class="dropdown-item" href="<?php echo $base_url ?>/admin/kategori/kelola-kategori.php">Kategori</a></li>
                            <li><a class="dropdown-item" href="<?php echo $base_url ?>/admin/lokasi/kelola-lokasi.php">Lokasi Penyimpanan</a></li>
                            <li><a class="dropdown-item" href="<?php echo $base_url ?>/admin/pengguna/kelola-pengguna.php">Pengguna</a></li>
                        </ul>
                    </li> -->
                <?php } ?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold me-3" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $_SESSION['username'] ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo $base_url ?>/logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</nav>