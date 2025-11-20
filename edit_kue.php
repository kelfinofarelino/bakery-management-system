<?php
include 'config.php';
checkLogin();

$id = mysqli_real_escape_string($conn, $_GET['id']);
$query = "SELECT * FROM kue WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$kue = mysqli_fetch_assoc($result);

if (!$kue) {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $harga = mysqli_real_escape_string($conn, $_POST['harga']);
    $stok = mysqli_real_escape_string($conn, $_POST['stok']);
    
    $foto_name = $kue['foto']; // Keep old photo by default
    
    // Handle file upload if new photo is provided
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $file_extension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $foto_name = uniqid() . '.' . $file_extension;
        $upload_path = 'uploads/' . $foto_name;
        
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $upload_path)) {
            // Delete old photo
            if (file_exists('uploads/' . $kue['foto'])) {
                unlink('uploads/' . $kue['foto']);
            }
        } else {
            $error = "Failed to upload photo";
            $foto_name = $kue['foto']; // Revert to old photo
        }
    }
    
    if (!isset($error)) {
        $query = "UPDATE kue SET nama = '$nama', harga = '$harga', stok = '$stok', foto = '$foto_name' WHERE id = '$id'";
        
        if (mysqli_query($conn, $query)) {
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Failed to update cake: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kue - Toko Roti</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Toko Roti</a>
            <div class="navbar-nav ms-auto">
                <span class="navbar-text me-3">Welcome, <?php echo $_SESSION['username']; ?></span>
                <a class="nav-link" href="dashboard.php">Dashboard</a>
                <a class="nav-link" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Edit Kue</h2>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Foto Lama</label><br>
                <img src="uploads/<?php echo $kue['foto']; ?>" alt="<?php echo $kue['nama']; ?>" style="max-width: 200px; max-height: 200px;">
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto Baru (Opsional)</label>
                <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Kue</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $kue['nama']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" value="<?php echo $kue['harga']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" class="form-control" id="stok" name="stok" value="<?php echo $kue['stok']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>