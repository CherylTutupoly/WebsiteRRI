<?php
// Koneksi ke database
include "koneksi.php";

// Ambil data podcast dari database
$result = $conn->query("SELECT id, title, file_path, created_at FROM podcast ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/podcast.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;900&display=swap">
    <title>RRI Sorong</title>
</head>

<body>
    <header>
        <div class="logo">
            <img class="rri-2023-logo-2-icon" src="public/images/rri-2023-logo-2.png" alt="Logo RRI">
        </div>
        <nav>
            <a href="index.php" class="nav-link">Semua</a>
            <a href="#radio-section" class="nav-link">Radio</a>
            <a href="berita.php" class="nav-link">Berita</a>
            <a href="podcast.php" class="nav-link">Podcast</a>
            <a href="musik.php" class="nav-link">Musik</a>
        </nav>
        <a href="login.php">
            <button class="sign-in">Sign In</button>
        </a>
    </header>

    <div class="podcast-wrapper">
        <h2>Podcast Rekomendasi</h2>

        <?php
        if ($result->num_rows > 0) {
            // Menampilkan setiap podcast
            while ($row = $result->fetch_assoc()) {
                // Menyusun path file audio yang benar
                $audio_path = 'http://localhost/website_rri/admin/uploads/' . urlencode($row['file_path']);
                
                echo '<div class="podcast-item">';
                echo '<div class="podcast-image">';
                // Gambar podcast jika ada
                echo '</div>';
                echo '<div class="podcast-content">';
                echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
                
                // Memastikan file audio diputar
                echo '<audio controls>';
                echo '<source src="' . $audio_path . '" type="audio/mpeg">';
                echo '<source src="' . $audio_path . '" type="audio/ogg">';
                echo 'Browser Anda tidak mendukung pemutar audio.';
                echo '</audio>';
                
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>Tidak ada podcast yang tersedia.</p>';
        }

        $conn->close();
        ?>
    </div>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-info">
                <h3>Alamat</h3>
                <p>JL. Jenderal Ahmad Yani, No. 44, KLA Demak II, Kp. Baru, Distrik Sorong, Kota Sorong, Papua Bar. 98414</p>

                <h3>Kontak Kami</h3>
                <p>095 1328251</p>

                <h3>Sosial Media</h3>
                <div class="social-media-icons">
                    <a href="#"><img src="public/images/insta.png" alt="Instagram"></a>
                    <a href="#"><img src="public/images/facebook.png" alt="Facebook"></a>
                    <a href="#"><img src="public/images/youtube.png" alt="YouTube"></a>
                    <a href="#"><img src="public/images/x.png" alt="Twitter"></a>
                </div>
            </div>
            <div class="footer-logo">
                <img src="public/images/rri-2023-logo-2.png" alt="RRI Logo">
            </div>
        </div>
    </footer>
</body>

</html>
