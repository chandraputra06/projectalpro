<?php 
    include "service/database.php";

    $register_message = ""; 

    if (isset($_POST['register'])) {
        
        $username = $_POST['username'];
        $password = $_POST['password'];

        
        if (!empty($username) && !empty($password)) {
                
            $stmt = $db->prepare("INSERT INTO user (nama, password) VALUES (?, ?)");
            
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            if ($stmt->execute([$username, $hashed_password])) {
                $register_message = "Data berhasil disimpan.";
            } else {
                $register_message = "Data gagal disimpan. Silakan coba lagi.";
            }
        } else {
            $register_message = "Semua field wajib diisi.";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style/register.css">
</head>
<body>

    <div class="register-box">
        <form action="register.php" method="POST">
            <h2>Register Hire</h2>
            <h3>Nama</h3>
                <div class="userN-input">
                    <input type="text" placeholder="username" name="username"/>
                </div>
                <div class="userN-input">
                    <h3>Password</h3>
                    <input type="password" placeholder="password" name="password"/>
                </div>
                <br>              
                <button type="submit" name="register">Register</button>            
        </form>
    </div>

</body>
</html>