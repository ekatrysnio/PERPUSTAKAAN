<?php
require_once __DIR__ . '/inc/koneksi.php';
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $nama = $_POST['nama'] ?? '';
    $kelas = $_POST['kelas'] ?? '';
    $judul_buku = $_POST['judul_buku'] ?? '';
    $tanggal_pinjam = $_POST['tanggal_pinjam'] ?? '';
    $tanggal_kembali = $_POST['tanggal_kembali'] ?? '';
    $stmt = $conn->prepare("INSERT INTO peminjaman (nama,kelas,judul_buku,tanggal_pinjam,tanggal_kembali) VALUES (?,?,?,?,?)");
    $stmt->bind_param("sssss", $nama,$kelas,$judul_buku,$tanggal_pinjam,$tanggal_kembali);
    $stmt->execute();
    header('Location: peminjaman.php'); exit;
}
?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Tambah Peminjaman</title><link rel="stylesheet" href="assets/css/style.css"></head>
<body>
<div class="form-container">
  <h2>Tambah Peminjaman</h2>
  <form method="post">
    <label>Nama</label><input type="text" name="nama" required>
    <label>Kelas</label><input type="text" name="kelas" required>
    <label>Judul Buku</label><input type="text" name="judul_buku" required>
    <label>Tanggal Pinjam</label><input type="date" name="tanggal_pinjam" required>
    <label>Tanggal Kembali</label><input type="date" name="tanggal_kembali" required>
    <button type="submit">Simpan</button>
  </form>
</div>
</body></html>
