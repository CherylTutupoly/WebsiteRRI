<?php
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($password === $user['password']) { // Perbandingan langsung
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: ./admin/dashboard.php');
            exit();
        } else {
            $error = 'Password salah.';
        }
    } else {
        $error = 'Username atau email tidak ditemukan.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;900&display=swap">
    <title>Login Page</title>
</head>
<body>
<div class="container">
        <div class="left">
            <div class="logo">
                <img src="images/rri-2023-logo-1.png" alt="RRI Logo">
            </div>
        </div>
    <div class="right">
        <h2>Nice to see you again</h2>
        <form id="loginForm" action="login.php" method="POST">
            <label for="username">Login</label>
            <input type="text" id="username" name="username" placeholder="Username / Email" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <div class="options">
                    <label>
            <input type="checkbox" id="remember"> Ingatkan Saya
          </label>
                    <a href="#" id="forgotPassword">Lupa Kata Sandi?</a>
                </div>
                <button type="submit" class="btn-primary">Masuk</button>  
        </form>
        <?php if (!empty($error)): ?>
            <p style="color: red;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
