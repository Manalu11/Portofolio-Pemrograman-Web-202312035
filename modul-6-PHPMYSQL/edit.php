<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    
    $sql = "UPDATE produk SET nama_produk='$nama_produk', harga=$harga, stok=$stok WHERE id_produk=$id";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

$id = $_GET['id'];
$sql = "SELECT * FROM produk WHERE id_produk=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <style>
    form {
        max-width: 400px;
        margin: 0 auto;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="number"] {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }

    button {
        padding: 8px 16px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
    }

    .back-button {
        display: inline-block;
        margin-top: 10px;
        padding: 8px 16px;
        background-color: #f44336;
        color: white;
        text-decoration: none;
    }
    </style>
</head>

<body>
    <h1>Edit Produk</h1>

    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $row['id_produk']; ?>">

        <div class="form-group">
            <label for="nama_produk">Nama Produk:</label>
            <input type="text" id="nama_produk" name="nama_produk" value="<?php echo $row['nama_produk']; ?>" required>
        </div>

        <div class="form-group">
            <label for="harga">Harga:</label>
            <input type="number" id="harga" name="harga" value="<?php echo $row['harga']; ?>" required min="0">
        </div>

        <div class="form-group">
            <label for="stok">Stok:</label>
            <input type="number" id="stok" name="stok" value="<?php echo $row['stok']; ?>" required min="0">
        </div>

        <button type="submit">Update</button>
        <a href="index.php" class="back-button">Kembali</a>
    </form>
</body>

</html>