<?php include('service/db.php'); ?>
<?php include('service/database.php');?>

<?php

$sql = "SELECT * FROM kegiatan";

if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $sql .= " WHERE nama LIKE '%$keyword%' OR deskripsi LIKE '%$keyword%' OR tanggal LIKE '%$keyword%'";
}

$sql .= " ORDER BY tanggal ASC"; 
$result = $conn->query($sql);

if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
  $keyword = $conn->real_escape_string($_GET['keyword']); 
  $sql .= " WHERE nama LIKE '%$keyword%' OR deskripsi LIKE '%$keyword%' OR tanggal LIKE '%$keyword%'";
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>JoChan Schedule</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
  <?php include "layout/header.html" ?>
    <h1>Daftar Kegiatan</h1>
    <a href="tambah.php">Tambah Kegiatan</a>
    <form method="GET" action="">
    <label>Cari Kegiatan:</label>
    <input type="text" name="keyword" placeholder="Masukkan kata kunci">
    <button type="submit">

    <div class="container">
    <h2>Daftar Kegiatan</h2>
    <a href="tambah.php"><button>Tambah Kegiatan</button></a><br><br>

    <form method="GET" action="">
      <input type="text" name="keyword" placeholder="Cari kegiatan berdasarkan nama, tanggal, atau deskripsi" value="<?php echo isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''; ?>">
      <button type="submit">Cari</button>
    </form>


    <!-- Dropdown Filter Tanggal -->
    <?php
        // Cek apakah filter bulan atau tahun dipilih
        $whereClauses = []; // Array untuk menyimpan klausa WHERE

        if (!empty($_GET['bulan'])) {
            $bulan = $conn->real_escape_string($_GET['bulan']);
            $whereClauses[] = "MONTH(tanggal) = '$bulan'";
        }

        if (!empty($_GET['tahun'])) {
            $tahun = $conn->real_escape_string($_GET['tahun']);
            $whereClauses[] = "YEAR(tanggal) = '$tahun'";
        }

        // Gabungkan klausa WHERE (jika ada)
        $whereSql = "";
        if (!empty($whereClauses)) {
            $whereSql = "WHERE " . implode(" AND ", $whereClauses);
        }

        // Query SQL dengan filter
        $sql = "SELECT * FROM kegiatan $whereSql ORDER BY tanggal ASC";
        $result = $conn->query($sql);
    ?>

    <form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
        <label for="bulan">Filter berdasarkan Bulan:</label>
        <select name="bulan">
            <option value="">Semua Bulan</option>
            <?php
            for ($i = 1; $i <= 12; $i++) {
                $bulan = str_pad($i, 2, "0", STR_PAD_LEFT);
                echo "<option value='$bulan'>$bulan</option>";

                if (!empty($_GET['bulan'])) {
                    $bulan = $conn->real_escape_string($_GET['bulan']); // Sanitize input
                    $whereClauses[] = "MONTH(tanggal) = '$bulan'";
                }
            }
            ?>
        </select>
        <label for="tahun">Tahun:</label>
        <select name="tahun">
            <option value="">Semua Tahun</option>
            <?php
            $currentYear = date("Y");
            for ($i = $currentYear; $i >= $currentYear - 5; $i--) {
                echo "<option value='$i'>$i</option>";

                if (!empty($_GET['tahun'])) {
                    $tahun = $conn->real_escape_string($_GET['tahun']); // Sanitize input
                    $whereClauses[] = "YEAR(tanggal) = '$tahun'";
                }
            }
            ?>
            <?php 
            $sql = "SELECT * FROM kegiatan "; 
            if (!empty($whereClauses)) {
                $sql .= "WHERE " . implode(" AND ", $whereClauses);
            }
            $sql .= " ORDER BY tanggal ASC";
            
            $result = $conn->query($sql);
            ?>
        </select>
        <button type="submit">Filter</button>
    </form>


    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Tanggal</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
        <?php
        $sql = "SELECT * FROM kegiatan ORDER BY tanggal ASC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nama']}</td>
                        <td>{$row['tanggal']}</td>
                        <td>{$row['deskripsi']}</td>
                        <td>
                            <a href='hapus.php?id={$row['id']}'>Hapus</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Tidak ada kegiatan</td></tr>";
        }
        ?>
    </table>
</body>
</html>
