<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Peminjaman Proyektor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f1f5f9; /* Abu-abu terang */
        }
        .card {
            border-radius: 15px; /* Sudut card lebih bulat */
        }
        .card-header {
            background-color: #003366; /* Biru tua */
            color: #ffffff; /* Putih */
        }
        .login-icon {
            font-size: 4rem; /* Ukuran ikon besar */
            color: #ffffff; /* Putih */
        }
        .btn-primary {
            background-color: #004080; /* Biru gelap */
            border: none; /* Menghapus border tombol */
        }
        .btn-primary:hover {
            background-color: #00264d; /* Biru lebih gelap saat hover */
        }
        .card-footer {
            background-color: #f1f5f9; /* Abu-abu terang */
        }
        .text-danger {
            color: #ff4d4d; /* Merah terang */
        }
        .login-info {
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #6c757d; /* Warna teks abu-abu */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header text-center">
                        <i class="bi bi-projector login-icon"></i> <!-- Ikon besar di atas judul -->
                        <h4 class="mt-3"><i class="bi bi-person-lock"></i> Login</h4> <!-- Ikon login di judul -->
                    </div>
                    <div class="card-body">
                        <form action="authenticate.php" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                    </div>
                    <?php if (isset($_GET['error'])): ?>
                    <div class="card-footer text-danger text-center">
                        <?php echo $_GET['error']; ?>
                    </div>
                    <?php endif; ?>
                    <div class="card-footer text-center login-info">
                        <p><strong>Username:</strong> admin</p>
                        <p><strong>Password:</strong> password123</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
