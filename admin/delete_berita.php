<?php
include "../koneksi.php"; // Pastikan koneksi database sudah ada

// Cek apakah ada permintaan POST untuk menghapus berita
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = (int)$_POST['delete_id'];

    // Ambil informasi file gambar untuk dihapus dari folder upload
    $query = "SELECT image_path FROM berita WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $image_path = $row['image_path'];

        // Hapus file gambar jika ada
        if (file_exists("../upload/" . basename($image_path))) {
            unlink("../upload/" . basename($image_path));
        }

        // Hapus data dari database
        $delete_query = "DELETE FROM berita WHERE id = ?";
        $delete_stmt = $conn->prepare($delete_query);
        $delete_stmt->bind_param("i", $delete_id);
        if ($delete_stmt->execute()) {
            // Redirect setelah berhasil menghapus
            header("Location: daftar_berita.php?message=Berita berhasil dihapus.");
            exit;
        } else {
            echo "<script>alert('Error: " . $delete_stmt->error . "');</script>";
        }
    } else {
        echo "<script>alert('Berita tidak ditemukan.');</script>";
    }
} else {
    echo "<script>alert('ID berita tidak valid.');</script>";
}

// Menutup koneksi database
$conn->close();
?>