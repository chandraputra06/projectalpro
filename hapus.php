<?php
include('service/db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM kegiatan WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Kegiatan berhasil dihapus!";
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "ID tidak ditemukan!";
}
?>
