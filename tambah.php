<?php include('service/db.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kegiatan</title>
</head>
<body>
    <h1>Tambah Kegiatan</h1>
    <form method="POST" action="">
        <label>Nama Kegiatan:</label><br>
        <input type="text" name="nama" required><br><br>
        <label>Tanggal (YYYY-MM-DD):</label><br>
        <input type="date" name="tanggal" required><br><br>
        <label>Deskripsi:</label><br>
        <textarea name="deskripsi" required></textarea><br><br>
        <button type="submit" name="submit">Tambah</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $tanggal = $_POST['tanggal'];
        $deskripsi = $_POST['deskripsi'];

        $sql = "INSERT INTO kegiatan (nama, tanggal, deskripsi) VALUES ('$nama', '$tanggal', '$deskripsi')";

        if ($conn->query($sql) === TRUE) {
            echo "Kegiatan berhasil ditambahkan!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>
</body>
</html>
