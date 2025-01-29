<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    
    // Tentukan path absolut untuk folder upload (misalnya, folder uploads di root proyek)
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/website_rri/upload/";

    // Bersihkan nama file untuk menghindari karakter yang tidak valid
    $filename = basename($_FILES["image"]["name"]);
    $safe_filename = preg_replace('/[^a-zA-Z0-9-_\.]/', '_', $filename);
    $target_file = $target_dir . $safe_filename;

    // Buat folder jika belum ada
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Simpan file gambar
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Simpan ke database
        $conn = new mysqli("localhost", "root", "", "rri"); // Ganti dengan info database Anda
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        $sql = "INSERT INTO program_unggulan (title, image_path, description) VALUES ('$title', '$target_file', '$description')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Program unggulan berhasil diunggah!');</script>";
        } else {
            echo "<script>alert('Error: " . $sql . " \\n" . $conn->error . "');</script>";
        }
        $conn->close();
    } else {
        echo "<script>alert('Terjadi kesalahan saat mengunggah gambar.');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Program Unggulan</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap">
    <style>
        /* Gaya untuk kontainer form */

        .form-container {
            width: 100%; /* Set width to 100% for full page width */
            margin: 0 auto; /* Center the form */
            padding: 20px;
            background-color: #f9f9f9; /* Background color */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Shadow */
        }
        form {
            display: flex;
            flex-direction: column; /* Stack elements vertically */
        }
        label {
            margin-bottom: 5px; /* Space between label and input */
        }
        input[type="text"],
        textarea,
        input[type="file"] {
            width: 100%; /* Set width to 100% for full width input */
            padding: 10px; /* Padding */
            margin-bottom: 15px; /* Space between elements */
            border: 1px solid #ccc; /* Border */
            border-radius: 4px; /* Rounded corners */
        }
        button.btn-primary {
            background-color: #3498db; /* Button background color */
            color: white; /* Text color */
            border: none; /* No border */
            padding: 10px; /* Padding */
            border-radius: 5px; /* Rounded corners */
            cursor: pointer; /* Pointer cursor on hover */
            transition: background-color 0.3s; /* Smooth color transition */
        }
        button.btn-primary:hover {
            background-color: #2980b9; /* Button background color on hover */
        }


/* Gaya untuk input teks dan textarea */

.form-container input[type="text"],
.form-container textarea,
.form-container input[type="file"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 16px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
    font-family: 'Poppins', sans-serif;
    box-sizing: border-box;
}


/* Fokus pada input */

.form-container input:focus,
.form-container textarea:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}


/* Gaya untuk textarea */

.form-container textarea {
    resize: vertical;
    height: 120px;
}


/* Tombol unggah */

.btn-primary {
    display: inline-block;
    padding: 12px 20px;
    font-size: 16px;
    font-weight: 600;
    color: #fff;
    background-color: #007bff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    text-align: center;
}


/* Hover tombol */

.btn-primary:hover {
    background-color: #0056b3;
}


/* Responsive */

@media (max-width: 768px) {
    .form-container {
        padding: 15px;
    }
    .form-container label,
    .form-container input[type="text"],
    .form-container textarea {
        font-size: 13px;
    }
    .btn-primary {
        font-size: 14px;
        padding: 10px 15px;
    }
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
                <a href="logout.php" class="btn-logout">Logout</a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="main-header">
                <h1>Upload Program Unggulan</h1>
                <div class="profile">
                    <img src="https://via.placeholder.com/40" alt="Admin Profile">
                </div>
            </header>
            <section class="content">
                <div class="form-container">
                    <form action="upload_program.php" method="POST" enctype="multipart/form-data">
                        <label for="title">Judul Program:</label>
                        <input type="text" id="title" name="title" placeholder="Masukkan judul program" required><br><br>

                        <label for="description">Deskripsi:</label>
                        <textarea id="description" name="description" placeholder="Masukkan deskripsi program" required></textarea><br><br>

                        <label for="image">Gambar Program:</label>
                        <input type="file" id="image" name="image" accept="image/*" required><br><br>

                        <button type="submit" class="btn-primary">Unggah</button>
                    </form>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
