<?php
include "../koneksi.php";

// Ambil data program unggulan dari database
$sql = "SELECT id, title, description, image_path FROM program_unggulan ORDER BY id DESC";
$result = $conn->query($sql);

// Hapus program unggulan jika ada permintaan
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = (int)$_POST['delete_id'];

    // Ambil informasi file untuk dihapus dari folder upload
    $query = "SELECT image_path FROM program_unggulan WHERE id = ?";
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
        $delete_query = "DELETE FROM program_unggulan WHERE id = ?";
        $delete_stmt = $conn->prepare($delete_query);
        $delete_stmt->bind_param("i", $delete_id);
        $delete_stmt->execute();
    }

    header("Location: reports.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/reports.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap">
    <style>
        .btn-logout {
            background-color: #e74c3c;
            color: #ecf0f1;
            border: none;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-logout:hover {
            background-color: #c0392b;
        }

        .main-content {
            flex: 1;
            padding: 20px;
        }

        .main-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
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

        .program-image {
            border-radius: 10px;
            margin-bottom: 10px;
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
        }

        .btn-edit, .btn-delete {
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9em;
            transition: background-color 0.3s;
        }

        .btn-edit {
            background-color: #3498db;
            color: #fff;
            margin-right: 10px;
        }

        .btn-edit:hover {
            background-color: #2980b9;
        }

        .btn-delete {
            background-color: #e74c3c;
            color: #fff;
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
            <li><a href="#" class="active">Dashboard</a></li>
                <li><a href="upload_program.php">Program Unggulan</a></li>
                <li><a href="berita.php">Berita RRI</a></li>
                <li><a href="podcast.php">Podcast RRI</a></li>
                <li><a href="reports.php">Daftar Program Unggulan</a></li>
                <li><a href="daftar_berita.php">Daftar Berita</a></li>
                <li><a href="daftar_berita.php">Daftar Podcast</a></li>
                <li><a href="#">Settings</a></li>
            </ul>
            <div class="logout">
                <button class="btn-logout">Logout</button>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="main-header">
                <h1>Daftar Program Unggulan</h1>
                <div class="profile">
                    <img src="https://via.placeholder.com/40" alt="Admin Profile">
                </div>
            </header>
            <section class="content">
                <div class="program-list">
                    <?php if ($result->num_rows > 0) : ?>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <div class="program-item">
                                <img src="/website_rri/upload/<?php echo basename($row['image_path']); ?>" alt="Program Image" class="program-image" width="200px" height="200px">
                                <div class="program-details">
                                    <h3 class="program-title"><?php echo htmlspecialchars($row['title']); ?></h3>
                                    <p class="program-description"><?php echo htmlspecialchars($row['description']); ?></p>
                                    <div>
                                        <a href="edit_program.php?id=<?php echo $row['id']; ?>" class="btn-edit">Edit</a>
                                        <form action="" method="POST" class="delete-form" style="display: inline;">
                                            <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" class="btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus program ini?');">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <p style="text-align: center;">Tidak ada program unggulan yang ditemukan.</p>
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
