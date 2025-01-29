<?php
// Koneksi ke database
include "../koneksi.php";

// Proses upload podcast
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['podcast_title'];
    $audio = $_FILES['podcast_audio'];

    // Direktori upload
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Nama file dan path
    $fileName = basename($audio['name']);
    $targetPath = $uploadDir . $fileName;

    // Validasi file audio
    $allowedTypes = ['audio/mpeg', 'audio/mp3', 'audio/wav'];
    if (in_array($audio['type'], $allowedTypes)) {
        if (move_uploaded_file($audio['tmp_name'], $targetPath)) {
            // Simpan ke database
            $stmt = $conn->prepare("INSERT INTO podcast (title, file_path) VALUES (?, ?)");
            $stmt->bind_param("ss", $title, $targetPath);

            if ($stmt->execute()) {
                echo "Podcast berhasil diunggah!";
            } else {
                echo "Gagal menyimpan ke database: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Gagal mengunggah file.";
        }
    } else {
        echo "Format file tidak didukung. Harap unggah file audio.";
    }
}

// Ambil data podcast dari database
$result = $conn->query("SELECT id, title, file_path FROM podcast ORDER BY created_at DESC");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Podcast</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="dashboard">
        <main class="main-content">
            <header class="main-header">
                <h1>Admin Podcast</h1>
            </header>

            <!-- Form Upload Podcast -->
            <section class="upload-podcast">
                <h2>Tambah Podcast Baru</h2>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="podcast-title">Judul Podcast</label>
                        <input type="text" id="podcast-title" name="podcast_title" required>
                    </div>
                    <div class="form-group">
                        <label for="podcast-audio">File Audio</label>
                        <input type="file" id="podcast-audio" name="podcast_audio" accept="audio/*" required>
                    </div>
                    <button type="submit" class="btn-upload">Upload Podcast</button>
                </form>
            </section>

            <!-- Podcast Playback Section -->
            <section class="podcast-playback">
                <h2>Daftar Podcast</h2>
                <div class="podcast-list">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="podcast-item">';
                            echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
                            echo '<audio controls>';
                            echo '<source src="' . htmlspecialchars($row['file_path']) . '" type="audio/mpeg">';
                            echo 'Browser Anda tidak mendukung pemutar audio.';
                            echo '</audio>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>Tidak ada podcast yang tersedia.</p>';
                    }
                    ?>
                </div>
            </section>
        </main>
    </div>
</body>
</html>

<?php
$conn->close();
?>
