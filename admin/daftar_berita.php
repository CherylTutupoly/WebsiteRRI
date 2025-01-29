<?php
include "../koneksi.php"; // Pastikan koneksi database sudah ada

// Ambil data berita dari database
$sql_berita = "SELECT id, judul, deskripsi, image_path, created_at FROM berita ORDER BY created_at DESC";
$result_berita = $conn->query($sql_berita);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Berita</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap">
    <style>
        .main-content {
            flex: 1;
            padding: 20px;
        }

        .program-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .program-item {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .program-title {
            font-size: 1.2em;
            margin: 10px 0;
            text-align: center;
        }

        .program-description {
            font-size: 0.9em;
            color: #7f8c8d;
            text-align: center;
            overflow: hidden; /* Menghindari overflow */
            text-overflow: ellipsis; /* Menambahkan elipsis */
            display: -webkit-box;
            -webkit-line-clamp: 3; /* Batasi hingga 3 baris */
            -webkit-box-orient: vertical;
        }

        .btn-edit, .btn-delete {
            margin-top: 10px;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9em;
            transition: background-color 0.3s;
        }

        .btn-edit {
            background-color: #3498db;
            color: white;
        }

        .btn-edit:hover {
            background-color: #2980b9;
        }

        .btn-delete {
            background-color: #e74c3c;
            color: white;
        }

        .btn-delete:hover {
            background-color: #c0392b;
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
            <li><a href="#">Dashboard</a></li>
                <li><a href="upload_program.php">Program Unggulan</a></li>
                <li><a href="berita.php">Berita RRI</a></li>
                <li><a href="podcast.php">Podcast RRI</a></li>
                <li><a href="reports.php">Daftar Program Unggulan</a></li>
                <li><a href="daftar_berita.php" class="active">Daftar Berita</a></li>
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
                <h1>Daftar Berita</h1>
            </header>
            <section class="content">
                <div class="program-list">
                    <?php if ($result_berita->num_rows > 0) : ?>
                        <?php while ($row_berita = $result_berita->fetch_assoc()) : ?>
                            <div class="program-item">
                                <img src="/website_rri/upload/<?php echo basename($row_berita['image_path']); ?>" alt="Berita Image" class="program-image" width="200px" height="200px">
                                <div class="program-details">
                                    <h3 class="program-title"><?php echo htmlspecialchars($row_berita['judul']); ?></h3>
                                    <p class="program-description"><?php echo htmlspecialchars($row_berita['deskripsi']); ?></p>
                                    <p class="program-description" style="font-size: 0.8em; color: #95a5a6;"><?php echo date('d M Y', strtotime($row_berita['created_at'])); ?></p>
                                    <div>
                                        <a href="edit_berita.php?id=<?php echo $row_berita['id']; ?>" class="btn-edit">Edit</a>
                                        <form action="delete_berita.php" method="POST" style="display:inline;">
                                            <input type="hidden" name="delete_id" value="<?php echo $row_berita['id']; ?>">
                                            <button type="submit" class="btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <p style="text-align: center;">Tidak ada berita yang ditemukan.</p>
                    <?php endif; ?>
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