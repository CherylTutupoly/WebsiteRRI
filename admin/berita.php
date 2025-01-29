<?php
include "../koneksi.php"; // Pastikan koneksi ke database sudah benar

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];

    // Mengupload gambar
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $gambar = $_FILES['gambar'];
        $imagePath = '/website_rri/upload/' . basename($gambar['name']);
        
        if (move_uploaded_file($gambar['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $imagePath)) {
            // Menyimpan data ke database
            $sql = "INSERT INTO berita (judul, deskripsi, image_path) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $judul, $deskripsi, $imagePath);

            if ($stmt->execute()) {
                echo "<div class='alert success'>Berita berhasil diupload!</div>";
            } else {
                echo "<div class='alert error'>Terjadi kesalahan saat menyimpan berita.</div>";
            }
        } else {
            echo "<div class='alert error'>Gagal mengupload gambar.</div>";
        }
    } else {
        echo "<div class='alert warning'>Pilih gambar untuk diupload.</div>";
    }
}

// Ambil data berita yang sudah ada di database
$sql = "SELECT * FROM berita ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Berita RRI</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/berita_admin.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap">
</head>

<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Admin Panel</h2>
            </div>
            <ul class="sidebar-menu">
                <li><a href="#" class="active">Dashboard</a></li>
                <li><a href="upload_program.php">Program Unggulan</a></li>
                <li><a href="berita.php">Berita RRI</a></li>
                <li><a href="podcast.php">Podcast RRI</a></li>
                <li><a href="reports.php">Daftar Program Unggulan</a></li>
                <li><a href="daftar_berita.php">Daftar Berita</a></li>
                <li><a href="daftar_podcast.php">Daftar Podcast</a></li>
                <li><a href="#">Settings</a></li>
            </ul>
            <div class="logout">
                <a href="logout.php" class="btn-logout">Logout</a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="main-header">
                <h1>Upload Berita RRI</h1>
                <div class="profile">
                    <img src="https://via.placeholder.com/40" alt="profile">
                </div>
            </header>

            <div class="content">
                <!-- Form Upload Berita -->
                <form action="berita.php" method="POST" enctype="multipart/form-data" class="upload-form">
                    <label for="judul">Judul Berita</label>
                    <input type="text" name="judul" id="judul" required>

                    <label for="deskripsi">Deskripsi Berita</label>
                    <textarea name="deskripsi" id="deskripsi" rows="5" required></textarea>

                    <label for="gambar">Upload Gambar</label>
                    <input type="file" name="gambar" id="gambar" accept="image/*" required>

                    <button type="submit">Upload Berita</button>
                </form>
            </div>
        </main>
    </div>
</body>

</html>

<?php
$conn->close(); 
?>
