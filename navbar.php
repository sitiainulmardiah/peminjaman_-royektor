<nav class="navbar navbar-expand navbar-dark bg-dark">
    <div class="container-lg">
        <a class="navbar-brand" href="index.php"><i class="bi bi-projector"></i> Peminjaman Proyektor </a>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $_SESSION['username']; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end mt-2">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person-bounding-box"></i> Profil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-sliders2-vertical"></i> Pengaturan</a></li>
                        <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-left"></i> logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
