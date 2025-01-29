<?php
include "koneksi.php";

?>



<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/semua.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;900&display=swap">
    <title>RRI Sorong</title>
</head>

<body>
    <header>
        <div class="logo">
            <img class="rri-2023-logo-2-icon" src="public/images/rri-2023-logo-2.png" alt="Logo RRI">
        </div>
        <nav>
            <a href="#semua-section" class="nav-link">Semua</a>
            <a href="#radio-section" class="nav-link">Radio</a>
            <a href="#berita-section" class="nav-link">Berita</a>
            <a href="#podcast-section" class="nav-link">podcast</a>
            <a href="#musik-section" class="nav-link">Musik</a>
        </nav>
        <a href="login.php">
            <button class="sign-in">Sign In</button>
        </a>
    </header>

    <div class="hero">
        <div class="hero-content">
            <div class="hero-text">
                <h1>Hai, Selamat Datang di Laman LPP RRI Sorong</h1>
                <p>Apa yang ingin Anda dengar hari ini?</p>
            </div>
            <div class="hero-image">
                <img src="public/images/podcast-equipment-for-recording-studio.png" alt="Podcast Equipment">
            </div>
        </div>
    </div>
    <br>
    <br>

    <section>
        <div>
            <img class="rectangle-icon" src="public/images/rectangle-3.png" alt="">
            <div id="radio-section" class="radio-rri-sorong">Radio RRI Sorong</div>
            <img class="wireframe-1-child2" src="Rectangle 9.svg" alt="">
        </div>

        <section class="program-container">
            <div class="program-wrapper">
                <div class="program-box">
                    <a href="pro_1.php"><img src="public/images/pro 1.jpg" alt="Program Pro 1" class="program-image"></a>
                </div>
                <div class="program-box">
                    <a href="pro_2.php"><img src="public/images/pro2.jpg" alt="Program Pro 2" class="program-image"></a>
                </div>
            </div>
            <div class="additional-image-container">
                <img class="dia-internacional-do-rdio-com" alt="Dia Internacional do Rádio" src="public/images/dia-internacional-do-rdio-com-casal-de-anunciantes-vetor-premium-1.png">
            </div>
        </section>
    </section>

    <section id="berita-section">
        <img class="rectangle-8" src="public/images/rectangle-8.png" alt="">
        <div class="berita-terkini">Berita Terkini</div>
    </section>

<?php
$sql = "SELECT judul, deskripsi, image_path, created_at FROM berita ORDER BY created_at DESC LIMIT 5";
$result = $conn->query($sql);
?>
<section class="news-container">
    <div class="news-wrapper">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="news-item">
                    <div class="news-content">
                        <h3><?php echo htmlspecialchars($row['judul']); ?></h3>
                        <p><span class="news-time">
                            <?php
                            $created_at = strtotime($row['created_at']);
                            $selisih = time() - $created_at;
                            if ($selisih < 3600) {
                                echo floor($selisih / 60) . " menit yang lalu";
                            } elseif ($selisih < 86400) {
                                echo floor($selisih / 3600) . " jam yang lalu";
                            } else {
                                echo floor($selisih / 86400) . " hari yang lalu";
                            }
                            ?>
                        </span></p>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Tidak ada berita tersedia.</p>
        <?php endif; ?>
    </div>
    <a href="berita.php" class="see-more-link">Selengkapnya</a>
    <br>
<br>
</section>



    <section id="podcast-section">
        <img class="rectangle-10" src="public/images/rectangle-10.png" alt="">
        <div class="podcast-title">Podcast Rekomendasi</div>
    </section>

    <div class="podcast-container">
        <div class="podcast-wrapper">
            <!-- Podcast 1 -->
            <div class="podcast-item">
                <div class="podcast-image">
                    <img src="public/images/image1.jpg" alt="Podcast 1">
                </div>
                <div class="podcast-content">
                    <h3>Sorong Bercerita: Kisah Inspiratif dari Timur Indonesia</h3>
                    <p>Mengupas kisah-kisah inspiratif dan budaya khas Papua Barat.</p>
                </div>
            </div>
            <!-- Podcast 2 -->
            <div class="podcast-item">
                <div class="podcast-image">
                    <img src="public/images/image2.jpg" alt="Podcast 2">
                </div>
                <div class="podcast-content">
                    <h3>Sorotan Sorong: Isu Terkini dan Solusi</h3>
                    <p>Membahas berita lokal, isu terkini, dan solusi yang relevan.</p>
                </div>
            </div>
            <!-- Podcast 3 -->
            <div class="podcast-item">
                <div class="podcast-image">
                    <img src="public/images/image3.jpg" alt="Podcast 3">
                </div>
                <div class="podcast-content">
                    <h3>Suara Anak Negeri: Perspektif Generasi Muda Sorong</h3>
                    <p>Membahas berita lokal, isu terkini, dan solusi yang relevan.</p>
                </div>
            </div>
            <!-- Podcast 4 -->
            <div class="podcast-item">
                <div class="podcast-image">
                    <img src="public/images/image4.png" alt="Podcast 4">
                </div>
                <div class="podcast-content">
                    <h3>Melodi Nusantara: Musik Tradisional dan Modern Papua</h3>
                    <p>Hiburan musik yang memadukan tradisional dan modern.</p>
                </div>
            </div>
        </div>
        <!-- Link Selengkapnya -->
        <a href="podcast.php" class="podcast-more-link">Selengkapnya</a>
    </div>

<br>
<br>
<br>
<br>

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