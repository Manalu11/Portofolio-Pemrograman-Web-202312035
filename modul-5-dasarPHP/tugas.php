<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Tamu Digital STITEK Bontang</title>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f5f5f5;
        color: #333;
    }

    header {
        background-color: #2c3e50;
        color: white;
        padding: 20px;
        text-align: center;
        border-radius: 5px;
        margin-bottom: 30px;
    }

    h1 {
        margin: 0;
        font-size: 28px;
    }

    .form-container {
        background-color: white;
        padding: 25px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="email"],
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
    }

    textarea {
        height: 120px;
        resize: vertical;
    }

    button {
        background-color: #3498db;
        color: white;
        border: none;
        padding: 12px 20px;
        font-size: 16px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #2980b9;
    }

    .result-container {
        background-color: white;
        padding: 25px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .success-message {
        background-color: #d4edda;
        color: #155724;
        padding: 15px;
        border-radius: 4px;
        margin-bottom: 20px;
    }

    .error-message {
        background-color: #f8d7da;
        color: #721c24;
        padding: 15px;
        border-radius: 4px;
        margin-bottom: 20px;
    }

    .data-display {
        border: 1px solid #ddd;
        padding: 15px;
        border-radius: 4px;
        background-color: #f9f9f9;
    }

    .data-item {
        margin-bottom: 10px;
    }

    .data-label {
        font-weight: bold;
        display: inline-block;
        width: 120px;
    }
    </style>
</head>

<body>
    <header>
        <h1>Buku Tamu Digital STITEK Bontang</h1>
    </header>

    <div class="form-container">
        <h2>Form Buku Tamu</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="nama">Nama Lengkap:</label>
                <input type="text" id="nama" name="nama" required>
            </div>

            <div class="form-group">
                <label for="email">Alamat Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="pesan">Pesan/Komentar:</label>
                <textarea id="pesan" name="pesan" required></textarea>
            </div>

            <button type="submit" name="submit">Kirim Pesan</button>
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        // Inisialisasi variabel error
        $errors = [];
        
        // Ambil data dari form dan bersihkan
        $nama = trim($_POST['nama'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $pesan = trim($_POST['pesan'] ?? '');
        
        // Validasi
        if (empty($nama)) {
            $errors[] = "Nama lengkap harus diisi.";
        }
        
        if (empty($email)) {
            $errors[] = "Alamat email harus diisi.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Format alamat email tidak valid.";
        }
        
        if (empty($pesan)) {
            $errors[] = "Pesan/komentar harus diisi.";
        }
        
        // Jika ada error, tampilkan
        if (!empty($errors)) {
            echo '<div class="result-container">';
            echo '<div class="error-message">';
            echo '<h3>Terjadi kesalahan:</h3>';
            echo '<ul>';
            foreach ($errors as $error) {
                echo '<li>' . htmlspecialchars($error) . '</li>';
            }
            echo '</ul>';
            echo '</div>';
            echo '</div>';
        } else {
            // Bersihkan data sebelum ditampilkan
            $nama_clean = htmlspecialchars($nama);
            $email_clean = htmlspecialchars($email);
            $pesan_clean = htmlspecialchars($pesan);
            
            // Tampilkan hasil
            echo '<div class="result-container">';
            echo '<div class="success-message">';
            echo '<h3>Terima kasih atas pesan Anda!</h3>';
            echo '<p>Pesan Anda telah berhasil dikirim.</p>';
            echo '</div>';
            
            echo '<div class="data-display">';
            echo '<h3>Data yang Anda kirim:</h3>';
            echo '<div class="data-item"><span class="data-label">Nama Lengkap:</span> ' . $nama_clean . '</div>';
            echo '<div class="data-item"><span class="data-label">Alamat Email:</span> ' . $email_clean . '</div>';
            echo '<div class="data-item"><span class="data-label">Pesan:</span> ' . nl2br($pesan_clean) . '</div>';
            echo '</div>';
            echo '</div>';
        }
    }
    ?>
</body>

</html>