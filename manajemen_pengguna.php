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
    <title>Manajemen Pengguna - Peminjaman Proyektor</title>
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
            background-color: #003366; /* Sesuaikan dengan navbar */
            border-radius: 10px;
        }
        .nav-item#satu.active .nav-link {
            background-color: #003366; /* Warna latar belakang beranda */
        }
        .nav-link:hover {
            background-color: #b0bec5; /* Abu-abu cerah untuk highlight saat hover */
        }
        .footer {
            background-color: #003366; /* Biru tua untuk footer */
            padding: 10px;
            color: #ffffff; /* Warna teks putih untuk kontras */
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #e3f2fd; /* Biru muda untuk baris ganjil */
        }
        .table-striped tbody tr:nth-of-type(even) {
            background-color: #ffffff; /* Putih untuk baris genap */
        }
        .modal-content {
            border: 1px solid #003366; /* Border biru tua untuk modal */
        }
        .modal-header {
            background-color: #003366; /* Biru tua untuk header modal */
            color: #ffffff; /* Warna teks putih untuk kontras */
        }
        .btn-primary {
            background-color: #003366; /* Biru tua untuk tombol utama */
            border-color: #003366; /* Border biru tua untuk tombol utama */
        }
        .btn-primary:hover {
            background-color: #002244; /* Biru lebih gelap saat hover */
            border-color: #002244; /* Border biru lebih gelap saat hover */
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
                            <?php echo htmlspecialchars($_SESSION['username']); ?>
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
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <ul class="navbar-nav nav-pills flex-column justify-content-end flex-grow-1">
                                    <li class="nav-item" id="satu">
                                        <a class="nav-link link-light" aria-current="page" href="index.php"><i class="bi bi-house-door-fill"></i> Beranda </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link link-dark active" href="manajemen_pengguna.php"><i class="bi bi-person-fill"></i> Manajemen Pengguna </a>
                                    </li> 
                                    <li class="nav-item">
                                        <a class="nav-link link-dark" href="manajemen_proyektor.php"><i class="bi bi-credit-card-fill"></i> Manajemen Proyektor </a>
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
                <h2>Manajemen Pengguna</h2>
                <p>Di sini Anda dapat mengelola pengguna sistem.</p>

                <!-- Button to trigger modal -->
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    Tambah Pengguna
                </button>

                <!-- User Table -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>John Doe</td>
                            <td>john.doe@example.com</td>
                            <td>Admin</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Jane Smith</td>
                            <td>jane.smith@example.com</td>
                            <td>Pengguna</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Robert Brown</td>
                            <td>robert.brown@example.com</td>
                            <td>Admin</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Emily White</td>
                            <td>emily.white@example.com</td>
                            <td>Pengguna</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Michael Black</td>
                            <td>michael.black@example.com</td>
                            <td>Admin</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Sarah Green</td>
                            <td>sarah.green@example.com</td>
                            <td>Pengguna</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>David Blue</td>
                            <td>david.blue@example.com</td>
                            <td>Admin</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>Laura Red</td>
                            <td>laura.red@example.com</td>
                            <td>Pengguna</td>
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

        <!-- Modal Tambah Pengguna -->
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">Tambah Pengguna Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="userName" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="userName" placeholder="Masukkan nama pengguna">
                            </div>
                            <div class="mb-3">
                                <label for="userEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="userEmail" placeholder="Masukkan email pengguna">
                            </div>
                            <div class="mb-3">
                                <label for="userRole" class="form-label">Role</label>
                                <select class="form-select" id="userRole">
                                    <option selected>Pengguna</option>
                                    <option>Admin</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer fixed-bottom text-center mb-2">
            &copy; 2024 Siti Ainul Mardiah
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
