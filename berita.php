<?php
include "koneksi.php";

// Ambil data dari tabel berita
$query = "SELECT id, judul, image_path, deskripsi FROM berita";
$result = $conn->query($query);

$berita = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $berita[] = $row;
    }
}
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
    <link rel="stylesheet" href="./css/berita.css">
    <!-- File Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>

.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.modal-content {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    width: 80%;
    max-width: 600px;
    text-align: center;
    position: relative;
}

.modal-content .close {
    position: absolute;
    top: 10px;
    right: 20px;
    font-size: 24px;
    color: #333;
    cursor: pointer;
}

.modal-image {
    max-width: 100%;
    height: auto;
    margin-top: 20px;
    border-radius: 5px;
}

.modal h1 {
    margin-bottom: 20px;
    font-size: 1.8rem;
    color: #333;
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
            <a href="index.php" class="nav-link">Semua</a>
            <a href="#radio-section" class="nav-link">Radio</a>
            <a href="berita.php" class="nav-link">Berita</a>
            <a href="podcast.html" class="nav-link">Podcast</a>
            <a href="musik.html" class="nav-link">Musik</a>
        </nav>
        <a href="login.php">
            <button class="sign-in">Sign In</button>
        </a>
    </header>

    <!-- Carousel Section -->
    <section class="pro1-section">
        <h2>Berita Terkini</h2>
        <div class="container">
            <div class="carousel">
                <div class="carousel-control left" onclick="prevSlide()">
                    <i class="fas fa-chevron-left"></i>
                </div>
                <?php if (!empty($berita)): ?>
                    <?php foreach ($berita as $index => $item): ?>
                        <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                            <img src="<?php echo htmlspecialchars($item['image_path']); ?>" alt="<?php echo htmlspecialchars($item['judul']); ?>">
                            <p><?php echo htmlspecialchars($item['judul']); ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Tidak ada berita untuk ditampilkan.</p>
                <?php endif; ?>
                <div class="carousel-control right" onclick="nextSlide()">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>
            <div class="carousel-indicators">
                <?php foreach ($berita as $index => $item): ?>
                    <span onclick="setSlide(<?php echo $index; ?>)" class="<?php echo $index === 0 ? 'active' : ''; ?>"></span>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

   <!-- Popular News Section -->
   <section>
        <div class="news-wrapper">
            <h2>Berita Populer</h2>
            <?php foreach ($berita as $item): ?>
                <div class="news-item" 
                     data-title="<?php echo htmlspecialchars($item['judul']); ?>" 
                     data-description="<?php echo htmlspecialchars($item['deskripsi']); ?>" 
                     data-image="<?php echo htmlspecialchars($item['image_path']); ?>" 
                     onclick="showDetail(this)">
                    <img src="<?php echo htmlspecialchars($item['image_path']); ?>" alt="Berita Populer" class="news-image">
                    <div class="news-content">
                        <h3><?php echo htmlspecialchars($item['judul']); ?></h3>
                        <p><span class="news-time">Beberapa saat yang lalu</span></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Modal -->
    <div id="newsModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h1 id="modal-title"></h1>
            <img id="modal-image" src="" alt="Detail Berita" class="modal-image">
            <p id="modal-description"></p>
        </div>
    </div>



    <!-- Footer -->
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
    <script src="./js/berita.js"></script>
    <script>
         function showDetail(element) {
            // Ambil data dari atribut elemen
            const title = element.getAttribute('data-title');
            const description = element.getAttribute('data-description');
            const imagePath = element.getAttribute('data-image');

            // Isi konten modal
            document.getElementById('modal-title').innerText = title;
            document.getElementById('modal-description').innerText = description;
            document.getElementById('modal-image').src = imagePath;

            // Tampilkan modal
            document.getElementById('newsModal').style.display = 'flex';
        }

    </script>
</body>

</html>
