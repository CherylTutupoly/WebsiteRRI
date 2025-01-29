<?php
// Konfigurasi database
include "../koneksi.php";

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

$conn->close();
?>
