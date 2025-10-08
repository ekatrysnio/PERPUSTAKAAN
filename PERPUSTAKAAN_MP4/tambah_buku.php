<?php
require_once __DIR__ . '/inc/koneksi.php';
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'] ?? '';
    $pengarang = $_POST['pengarang'] ?? '';
    $penerbit = $_POST['penerbit'] ?? '';
    $tahun = (int)($_POST['tahun'] ?? 0);
    $stmt = $conn->prepare("INSERT INTO buku (judul,pengarang,penerbit,tahun) VALUES (?,?,?,?)");
    $stmt->bind_param("sssi", $judul, $pengarang, $penerbit, $tahun);
    $stmt->execute();
    header('Location: buku.php'); exit;
}
?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Tambah Buku</title><link rel="stylesheet" href="assets/css/style.css"></head>
<body>
<div class="form-container">
  <h2>Tambah Buku</h2>
  <form method="post">
    <label>Judul</label><input type="text" name="judul" required>
    <label>Pengarang</label><input type="text" name="pengarang" required>
    <label>Penerbit</label><input type="text" name="penerbit" required>
    <label>Tahun</label><input type="number" name="tahun" min="1900" max="2100" required>
    <button type="submit">Simpan</button>
  </form>
</div>
</body></html>
