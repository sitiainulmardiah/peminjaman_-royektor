<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen Proyektor - Peminjaman Proyektor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .navbar {
            background-color: #003366; /* Biru tua untuk navbar */
        }
        .nav-link {
            transition: background-color 0.3s;
        }
        #satu {
            background-color: #003366; /* Biru tua untuk sidebar item */
            border-radius: 10px;
        }
        .nav-item#satu.active .nav-link {
            background-color: #003366; /* Biru tua untuk item aktif */
        }
        .nav-link:hover {
            background-color: #cccccc; /* Abu-abu terang saat hover */
        }
        .footer {
            background-color: #003366; /* Biru tua untuk footer */
            padding: 10px;
            color: #ffffff; /* Teks putih untuk kontras */
        }
        .offcanvas {
            background-color: #f0f0f0; /* Abu-abu terang untuk sidebar */
        }
        .table {
            border-color: #cccccc; /* Abu-abu untuk border tabel */
        }
        .btn-primary {
            background-color: #003366; /* Biru tua untuk tombol */
            border-color: #003366;
        }
        .btn-primary:hover {
            background-color: #002244; /* Biru lebih gelap untuk hover */
            border-color: #002244;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand navbar-dark">
        <div class="container-lg">
            <a class="navbar-brand" href="#"><i class="bi bi-projector"></i> Peminjaman Proyektor </a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $_SESSION['username']; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end mt-2">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person-bounding-box"></i> Profil</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-sliders2-vertical"></i> Pengaturan</a></li>
                            <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-left"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Header -->

    <div class="container-lg">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3">
                <nav class="navbar navbar-expand-lg bg-light rounded border mt-2">
                    <div class="container-fluid">   
                        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" style="width: 250px;">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <ul class="navbar-nav nav-pills flex-column justify-content-end flex-grow-1">
                                    <li class="nav-item" id="satu">
                                        <a class="nav-link link-light" aria-current="page" href="index.php"><i class="bi bi-house-door-fill"></i> Beranda </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link link-dark" href="manajemen_pengguna.php"><i class="bi bi-person-fill"></i> Manajemen Pengguna </a>
                                    </li> 
                                    <li class="nav-item">
                                        <a class="nav-link link-dark active" href="manajemen_proyektor.php"><i class="bi bi-credit-card-fill"></i> Manajemen Proyektor </a>
                                    </li>    
                                    <li class="nav-item">
                                        <a class="nav-link link-dark" href="proses_peminjaman.php"><i class="bi bi-person-lines-fill"></i> Proses Peminjaman dan Pengembalian </a>
                                    </li>    
                                    <li class="nav-item">
                                        <a class="nav-link link-dark" href="monitoring_laporan.php"><i class="bi bi-bar-chart-fill"></i> Monitoring dan Laporan </a>
                                    </li>       
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <!-- End Sidebar -->

            <!-- Content -->
            <div class="col-lg-9 mt-2">
                <h2>Manajemen Proyektor</h2>
                <p>Di sini Anda dapat mengelola proyektor yang tersedia di sistem.</p>

                <!-- Button to trigger modal -->
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addProjectorModal">
                    Tambah Proyektor
                </button>

                <!-- Projector Table -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Proyektor</th>
                            <th>Jenis</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example projector data -->
                        <tr>
                            <td>1</td>
                            <td>Proyektor X1</td>
                            <td>4K</td>
                            <td>Tersedia</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Proyektor X2</td>
                            <td>HD</td>
                            <td>Dipinjam</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Proyektor Y1</td>
                            <td>4K</td>
                            <td>Tersedia</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Proyektor Z1</td>
                            <td>HD</td>
                            <td>Tersedia</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Proyektor X3</td>
                            <td>4K</td>
                            <td>Dipinjam</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Proyektor Y2</td>
                            <td>HD</td>
                            <td>Tersedia</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Proyektor Z2</td>
                            <td>4K</td>
                            <td>Dipinjam</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>Proyektor X4</td>
                            <td>HD</td>
                            <td>Tersedia</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- End Content -->
        </div>
    </div>

    <!-- Add Projector Modal -->
    <div class="modal fade" id="addProjectorModal" tabindex="-1" aria-labelledby="addProjectorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProjectorModalLabel">Tambah Proyektor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="projectorName" class="form-label">Nama Proyektor</label>
                            <input type="text" class="form-control" id="projectorName" required>
                        </div>
                        <div class="mb-3">
                            <label for="projectorType" class="form-label">Jenis</label>
                            <select class="form-select" id="projectorType" required>
                                <option value="4K">4K</option>
                                <option value="HD">HD</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="projectorStatus" class="form-label">Status</label>
                            <select class="form-select" id="projectorStatus" required>
                                <option value="Tersedia">Tersedia</option>
                                <option value="Dipinjam">Dipinjam</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Add Projector Modal -->

    <!-- Footer -->
    <footer class="footer mt-auto">
        <div class="container text-center">
            <p>&copy; 2024 Siti Ainul Mardiah</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9pNhn5wclHq6G68dUz5mXr5LM4f8WzovXo8XnLf4pQX4v2dXrN5" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-xr7pW0k3w5CT5e0hKZzwn4Ior6zO1cph3JXN67J8B+qPC5Y5VSCjx7Bq3U9/0nXn3" crossorigin="anonymous"></script>
</body>
</html>
