<?php 
include "service/database.php"; // Pastikan koneksi database sudah benar

session_start(); 

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mendapatkan data pengguna
    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            echo "Login berhasil! Selamat datang, " . $_SESSION['username'];
        } else {
            echo "Password salah!";
        }
    } else {
        echo "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JoChan Schedule</title>
    <link rel="stylesheet" href="style/login.css">
    
</head>
<body>
    <?php "layout/header.html" ?>
    <div class="login-box">
        <form action="index.php" method="POST">
            <h2>Login</h2>
            <h3>Nama</h3>
                <div class="userN-input">
                    <input type="text" placeholder="username" name="username"/>
                </div>
                <div class="userN-input">
                    <h3>Password</h3>
                    <input type="password" placeholder="password" name="password"/>
                </div>
                <br>
                <div class="keep-loggedin">
                    <input type="checkbox">Remember me 
                </div>
                <button type="submit" name="login">Login</button>
                <br>
                <div class="help">
                    Don't Have Any Account?
                    <a href="register.php">Register</a>
                </div>
        </form>
    </div>
</body>
</html>