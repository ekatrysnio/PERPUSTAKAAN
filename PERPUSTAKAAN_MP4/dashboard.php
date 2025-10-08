<?php
session_start();
require_once __DIR__ . '/inc/koneksi.php';
if (!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }
$username = $_SESSION['username'];
?>
<!doctype html>
<html lang="id">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Dashboard</title><link rel="stylesheet" href="assets/css/style.css"></head>
<body>
  <div class="topbar">
    <img class="logo" src="assets/img/logo_sdn.png" alt="logo">
    <div class="title">Selamat Datang di Perpustakaan SDN Menur Pumpungan IV/236</div>
    <div style="margin-left:auto;color:#fff">Hai, <?=htmlspecialchars($username)?></div>
  </div>
  <div class="container">
    <div class="card" style="margin-top:18px">
      <h2>Dashboard</h2>
      <div class="grid">
        <a class="card-link" href="buku.php">📚 Data Buku</a>
        <a class="card-link" href="peminjaman.php">📥 Peminjaman</a>
        <a class="card-link" href="laporan.php">🧾 Laporan</a>
        <a class="card-link" href="pengguna.php">👥 Pengguna</a>
      </div>
    </div>
  </div>
</body>
</html>
