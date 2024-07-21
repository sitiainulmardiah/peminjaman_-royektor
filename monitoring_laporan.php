<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

// Dummy data for example
$reports = [
    ['id' => 1, 'user' => 'John Doe', 'projector' => 'Proyektor X1', 'borrow_date' => '2024-07-10', 'return_date' => '2024-07-15', 'status' => 'Tersedia'],
    ['id' => 2, 'user' => 'Jane Smith', 'projector' => 'Proyektor X2', 'borrow_date' => '2024-07-12', 'return_date' => '2024-07-17', 'status' => 'Dipinjam'],
    ['id' => 3, 'user' => 'Alice Johnson', 'projector' => 'Proyektor Y1', 'borrow_date' => '2024-07-14', 'return_date' => '2024-07-19', 'status' => 'Tersedia'],
    ['id' => 4, 'user' => 'Michael Wilson', 'projector' => 'Proyektor X3', 'borrow_date' => '2024-07-15', 'return_date' => '2024-07-20', 'status' => 'Dipinjam'],
    ['id' => 5, 'user' => 'Laura White', 'projector' => 'Proyektor Z1', 'borrow_date' => '2024-07-16', 'return_date' => '2024-07-21', 'status' => 'Tersedia'],
    ['id' => 6, 'user' => 'Daniel Green', 'projector' => 'Proyektor X4', 'borrow_date' => '2024-07-17', 'return_date' => '2024-07-22', 'status' => 'Dipinjam'],
    ['id' => 7, 'user' => 'Sophie Brown', 'projector' => 'Proyektor Y2', 'borrow_date' => '2024-07-18', 'return_date' => '2024-07-23', 'status' => 'Tersedia'],
    ['id' => 8, 'user' => 'James Black', 'projector' => 'Proyektor Z2', 'borrow_date' => '2024-07-19', 'return_date' => '2024-07-24', 'status' => 'Dipinjam']
];

// Count borrowings for each projector
$projector_counts = [];
foreach ($reports as $report) {
    $projector = $report['projector'];
    if (!isset($projector_counts[$projector])) {
        $projector_counts[$projector] = 0;
    }
    $projector_counts[$projector]++;
}

// Prepare data for the chart
$projectors = array_keys($projector_counts);
$counts = array_values($projector_counts);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Monitoring dan Laporan - Peminjaman Proyektor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .navbar {
            background-color: #003366; /* Biru tua untuk navbar */
        }
        .nav-link {
            transition: background-color 0.3s;
        }
        #satu {
            background-color: #003366; /* Biru tua untuk menu aktif */
            border-radius: 10px;
        }
        .nav-item#satu.active .nav-link {
            background-color: #003366; /* Biru tua untuk latar belakang menu beranda */
        }
        .nav-link:hover {
            background-color: #d0d0d0; /* Abu-abu terang untuk hover */
        }
        .footer {
            background-color: #003366; /* Biru tua untuk footer */
            padding: 10px;
            color: #fff; /* Warna teks putih untuk kontras */
        }
        .offcanvas {
            background-color: #f8f9fa; /* Abu-abu terang untuk sidebar */
        }
        .offcanvas .nav-link {
            color: #003366; /* Biru tua untuk link di sidebar */
        }
        .offcanvas .nav-link.active {
            background-color: #003366; /* Biru tua untuk link aktif di sidebar */
            color: #fff; /* Teks putih untuk link aktif */
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f8f9fa; /* Abu-abu terang untuk baris tabel */
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
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
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
                                        <a class="nav-link link-dark" href="manajemen_proyektor.php"><i class="bi bi-credit-card-fill"></i> Manajemen Proyektor </a>
                                    </li>    
                                    <li class="nav-item">
                                        <a class="nav-link link-dark" href="proses_peminjaman.php"><i class="bi bi-person-lines-fill"></i> Proses Peminjaman dan Pengembalian </a>
                                    </li>    
                                    <li class="nav-item">
                                        <a class="nav-link link-dark active" href="monitoring_laporan.php"><i class="bi bi-graph-up"></i> Monitoring dan Laporan </a>
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
                <h2 class="mb-4">Laporan Peminjaman Proyektor</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Pengguna</th>
                            <th>Proyektor</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reports as $report): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($report['id']); ?></td>
                            <td><?php echo htmlspecialchars($report['user']); ?></td>
                            <td><?php echo htmlspecialchars($report['projector']); ?></td>
                            <td><?php echo htmlspecialchars($report['borrow_date']); ?></td>
                            <td><?php echo htmlspecialchars($report['return_date']); ?></td>
                            <td><?php echo htmlspecialchars($report['status']); ?></td>
                            <td>
                                <a href="monitoring_laporan.php?edit_id=<?php echo htmlspecialchars($report['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="monitoring_laporan.php?delete_id=<?php echo htmlspecialchars($report['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
                <div class="mt-4">
                    <h3>Grafik Peminjaman Proyektor</h3>
                    <canvas id="borrowingsChart"></canvas>
                </div>
            </div>
            <!-- End Content -->
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer text-center mt-4">
        <p>&copy; 2024 Siti Ainul Mardiah.</p>
    </footer>
    <!-- End Footer -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9g5hlTZH4DsnzpG6q6Zo1c8A9qBoc2a4HqdzMG13KzuqO3TG9dT" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-dR4gG9Qb7FAl3dU6QPAuJ6G9IkxA6IDtFS0R2ZCkpG7SA4hdyx0pPCFmgKjzjtp0" crossorigin="anonymous"></script>
    <script>
        const ctx = document.getElementById('borrowingsChart').getContext('2d');
        const borrowingsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($projectors); ?>,
                datasets: [{
                    label: 'Jumlah Peminjaman',
                    data: <?php echo json_encode($counts); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
