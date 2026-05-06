<?php
require 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = trim($_POST['judul']);
    $pengarang = trim($_POST['pengarang']);
    $penerbit = trim($_POST['penerbit']);
    $tahun = $_POST['tahun_terbit'];
    $stok = (int)$_POST['stok'];

    if(!empty($judul) && !empty($pengarang) && !empty($penerbit) && !empty($tahun)) {
        $stmt = $conn->prepare("INSERT INTO buku (judul, pengarang, penerbit, tahun_terbit, stok) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $judul, $pengarang, $penerbit, $tahun, $stok);
        
        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            $error = "Gagal menyimpan data.";
        }
        $stmt->close();
    } else {
        $error = "Semua field harus diisi!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buat/Tambah/Masukkan Buku di PEROUSDA NTB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Buat/Tambah/Masukkan Data Buku Baru</h2>
    <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="POST" action="">
        <div class="mb-3">
            <label>Judul Buku</label>
            <input type="text" name="judul" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Pengarang</label>
            <input type="text" name="pengarang" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Penerbit</label>
            <input type="text" name="penerbit" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tahun Terbit</label>
            <input type="number" name="tahun_terbit" class="form-control" min="1900" max="2100" required>
        </div>
        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" min="0" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
</body>
</html>