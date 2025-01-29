<?php
include "koneksi.php";

// Ambil data program unggulan dari database
$sql = "SELECT image_path, title FROM program_unggulan ORDER BY id DESC LIMIT 3"; // Menarik 3 program unggulan terbaru
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RRI - Radio Republik Indonesia</title>
    <!-- Impor font Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;900&display=swap">
    <!-- File CSS -->
    <link rel="stylesheet" href="./css/pro 1.css">
    <!-- File Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        /* Menambahkan CSS untuk mengatur ukuran gambar */
        .carousel-item img {
            width: 100%;  /* Mengatur lebar gambar sesuai dengan ukuran container */
            max-width: 285px;  /* Membatasi lebar gambar menjadi 300px */
            height: auto;  /* Mempertahankan rasio gambar */
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <header>
        <div class="logo">
            <img class="rri-2023-logo-2-icon" src="public/images/rri-2023-logo-2.png" alt="Logo RRI">
        </div>
        <nav>
            <a href="index.html" class="nav-link">Semua</a>
            <a href="#radio-section" class="nav-link">Radio</a>
            <a href="#berita-section" class="nav-link">Berita</a>
            <a href="#podcast-section" class="nav-link">Podcast</a>
            <a href="#musik-section" class="nav-link">Musik</a>
        </nav>
        <a href="login.php">
            <button class="sign-in">Sign In</button>
        </a>
    </header>

    <!-- Penyiar Section -->
    <section class="penyiar-section">
        <h2>Penyiar Pro 1</h2>
        <div class="penyiar-container">
            <img class="image-2-icon" src="public/images/bg.png" alt="Background Image">
            <div class="penyiar-item">
                <img src="public/images/LUSI.png" alt="Lusia Kristina Arebo">
                <p>Lusia Kristina Arebo</p>
            </div>
            <div class="penyiar-item">
                <img src="public/images/DANU.png" alt="Danoe Syah">
                <p>Danoe Syah</p>
            </div>
            <div class="penyiar-item">
                <img src="public/images/EVAN.png" alt="Revanno Rehatta">
                <p>Revanno Rehatta</p>
            </div>
            <div class="penyiar-item">
                <img src="public/images/TYAS.png" alt="Prameswara Tyas">
                <p>Prameswara Tyas</p>
            </div>
            <div class="penyiar-item">
                <img src="public/images/noni.png" alt="Nonnie Dency">
                <p>Nonnie Dency</p>
            </div>
        </div>
    </section>

    <!-- Carousel Section -->
    <section class="pro1-section">
        <h2>Program Unggulan</h2>
        <div class="container">
            <div class="carousel">
                <div class="carousel-control left" onclick="prevSlide()">
                    <i class="fas fa-chevron-left"></i>
                </div>
                <?php if ($result->num_rows > 0) : ?>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <?php 
                        // Pastikan gambar ada di direktori yang benar
                        $imagePath = "upload/" . basename($row['image_path']);
                        ?>
                        <div class="carousel-item">
                            <img src="<?php echo $imagePath; ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                        </div>
                    <?php endwhile; ?>
                <?php else : ?>
                    <p>Tidak ada program unggulan yang ditemukan.</p>
                <?php endif; ?>
                <div class="carousel-control right" onclick="nextSlide()">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>
            <div class="carousel-indicators">
                <span onclick="setSlide(0)"></span>
                <span onclick="setSlide(1)"></span>
                <span onclick="setSlide(2)"></span>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <section>
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
    </section>

    <script src="./js/pro 1.js"></script>
</body>

</html>

<?php
// Menutup koneksi database
$conn->close();
?>
