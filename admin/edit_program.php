<?php
include "../koneksi.php"; // Pastikan koneksi database sudah ada

// Cek apakah ID berita ada di URL
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Ambil data berita dari database
    $sql = "SELECT id, judul, deskripsi, image_path FROM berita WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Cek apakah berita ditemukan
    if ($result->num_rows === 0) {
        die("Berita tidak ditemukan.");
    }

    $row = $result->fetch_assoc();
} else {
    die("ID berita tidak valid.");
}

// Proses form jika ada permintaan POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];

    // Jika ada file gambar yang diunggah
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Tentukan path absolut untuk folder upload
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/website_rri/upload/";
        $filename = basename($_FILES["image"]["name"]);
        $safe_filename = preg_replace('/[^a-zA-Z0-9-_\.]/', '_', $filename);
        $target_file = $target_dir . $safe_filename;

        // Simpan file gambar
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Update data berita dengan gambar baru
            $sql_update = "UPDATE berita SET judul = ?, deskripsi = ?, image_path = ? WHERE id = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("sssi", $judul, $deskripsi, $target_file, $id);
            $stmt_update->execute();
        } else {
            echo "<script>alert('Terjadi kesalahan saat mengunggah gambar.');</script>";
        }
    } else {
        // Jika tidak ada gambar baru, hanya update judul dan deskripsi
        $sql_update = "UPDATE berita SET judul = ?, deskripsi = ? WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ssi", $judul, $deskripsi, $id);
        $stmt_update->execute();
    }

    // Redirect setelah update
    header("Location: daftar_berita.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap">
    <style>
        .main-content {
            flex: 1;
            padding: 20px;
        }

        .form-container {
            max-width: 800px; /* Atur lebar maksimum form */
            margin: 0 auto; /* Pusatkan form */
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        textarea {
            width: 100%; /* Lebar input dan textarea 100% */
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #2980b9;
        }
    </style>
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
                <h1>Edit Berita</h1>
            </header>
            <section class="content">
                <div class="form-container">
                    <form action="edit_berita.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
                        <label for="judul">Judul:</label>
                        <input type="text" id="judul" name="judul" value="<?php echo htmlspecialchars($row['judul']); ?>" required>

                        <label for="deskripsi">Deskripsi:</label>
                        <textarea id="deskripsi" name="deskripsi" required><?php echo htmlspecialchars($row['deskripsi']); ?></textarea>

                        <label for="image">Gambar Baru (opsional):</label>
                        <input type="file" id="image" name="image" accept="image/*">

                        <button type="submit">Simpan Perubahan</button>
                    </form>
                </div>
            </section>
        </main>
    </div>
</body>
</html>

<?php
// Menutup koneksi database
$conn->close();
?>