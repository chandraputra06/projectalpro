<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender Interaktif dengan PHP</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        #datepicker {
            width: 200px;
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>
<body>

<h2>Pilih Tanggal</h2>

<form method="post">
    <label for="datepicker">Tanggal:</label>
    <input type="text" id="datepicker" name="selected_date" placeholder="Pilih Tanggal" readonly>
    <input type="submit" value="Kirim">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selected_date = $_POST['selected_date'];
    echo "<h3>Tanggal yang dipilih: $selected_date</h3>";
}
?>

<script>
    $(function() {
        $("#datepicker").datepicker({
            dateFormat: "yy-mm-dd" // Format tanggal yang diinginkan
        });
    });
</script>

</body>
</html>