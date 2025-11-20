<?php
include 'config.php';
checkLogin();

$query = "SELECT * FROM kue ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Toko Roti</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Toko Roti</a>
            <div class="navbar-nav ms-auto">
                <span class="navbar-text me-3">Welcome, <?php echo $_SESSION['username']; ?></span>
                <a class="nav-link" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Katalog Kue</h2>
        
        <div class="row mt-4">
            <?php while ($kue = mysqli_fetch_assoc($result)): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="uploads/<?php echo $kue['foto']; ?>" class="card-img-top" alt="<?php echo $kue['nama']; ?>" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $kue['nama']; ?></h5>
                        <p class="card-text">Harga: Rp <?php echo number_format($kue['harga'], 0, ',', '.'); ?></p>
                        <p class="card-text">Stok: <?php echo $kue['stok']; ?></p>
                        <div class="d-flex gap-2">
                            <a href="edit_kue.php?id=<?php echo $kue['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapus_kue.php?id=<?php echo $kue['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        
        <div class="mt-4">
            <a href="tambah_kue.php" class="btn btn-primary">Tambah Kue</a>
        </div>
    </div>
</body>
</html>