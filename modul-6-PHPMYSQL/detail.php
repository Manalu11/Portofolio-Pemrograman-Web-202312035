<?php 
include 'koneksi.php';

// Check if product ID is provided
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id_produk = $_GET['id'];

// Fetch product details
$sql = "SELECT * FROM produk WHERE id_produk = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_produk);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    header("Location: index.php?error=Produk+tidak+ditemukan");
    exit;
}

$produk = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - <?php echo htmlspecialchars($produk['nama_produk']); ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    .detail-card {
        max-width: 600px;
        margin: 0 auto;
    }

    .status-badge {
        font-size: 0.9rem;
    }
    </style>
</head>

<body class="bg-light">
    <div class="container py-4">
        <div class="card detail-card shadow-sm">
            <div class="card-header bg-white">
                <h1 class="h4 mb-0">Detail Produk</h1>
            </div>
            <div class="card-body">
                <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo htmlspecialchars($_GET['error']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>

                <dl class="row">
                    <dt class="col-sm-3">ID Produk</dt>
                    <dd class="col-sm-9"><?php echo $produk['id_produk']; ?></dd>

                    <dt class="col-sm-3">Nama Produk</dt>
                    <dd class="col-sm-9"><?php echo htmlspecialchars($produk['nama_produk']); ?></dd>

                    <dt class="col-sm-3">Harga</dt>
                    <dd class="col-sm-9">Rp <?php echo number_format($produk['harga'], 0, ',', '.'); ?></dd>

                    <dt class="col-sm-3">Stok</dt>
                    <dd class="col-sm-9"><?php echo $produk['stok']; ?></dd>

                    <dt class="col-sm-3">Status</dt>
                    <dd class="col-sm-9">
                        <?php 
                        $status = $produk['stok'] > 0 ? 'success' : 'danger';
                        $statusText = $produk['stok'] > 0 ? 'Tersedia' : 'Habis';
                        ?>
                        <span class="badge bg-<?php echo $status; ?> status-badge"><?php echo $statusText; ?></span>
                    </dd>
                </dl>

                <div class="d-flex justify-content-between mt-4">
                    <a href="index.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                    <div>
                        <a href="edit.php?id=<?php echo $produk['id_produk']; ?>" class="btn btn-warning">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>
                        <a href="hapus.php?id=<?php echo $produk['id_produk']; ?>" class="btn btn-danger"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                            <i class="fas fa-trash-alt me-1"></i> Hapus
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>