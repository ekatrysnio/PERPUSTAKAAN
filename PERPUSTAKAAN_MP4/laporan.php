<?php
require_once __DIR__ . '/inc/koneksi.php';
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }

$month = $_GET['month'] ?? '';
$where = '';
if ($month) {
    // expect format YYYY-MM
    $where = "WHERE DATE_FORMAT(tanggal_pinjam, '%Y-%m')='".mysqli_real_escape_string($conn,$month)."'";
}
$res = mysqli_query($conn, "SELECT * FROM peminjaman $where ORDER BY tanggal_pinjam DESC");
?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Laporan</title><link rel="stylesheet" href="assets/css/style.css"></head>
<body>
<div class="container"><div class="card">
  <h2>Laporan Peminjaman</h2>
  <form method="get" class="center">
    <label>Pilih Bulan</label>
    <input type="month" name="month" value="<?= htmlspecialchars($month) ?>">
    <button type="submit">Tampilkan</button>
    <button type="button" onclick="window.print()">Cetak</button>
  </form>
  <table>
    <tr><th>No</th><th>Nama</th><th>Kelas</th><th>Judul Buku</th><th>Pinjam</th><th>Kembali</th></tr>
<?php $no=1; while($row=mysqli_fetch_assoc($res)){ ?>
  <tr>
    <td><?= $no++ ?></td>
    <td><?= htmlspecialchars($row['nama']) ?></td>
    <td><?= htmlspecialchars($row['kelas']) ?></td>
    <td><?= htmlspecialchars($row['judul_buku']) ?></td>
    <td><?= htmlspecialchars($row['tanggal_pinjam']) ?></td>
    <td><?= htmlspecialchars($row['tanggal_kembali']) ?></td>
  </tr>
<?php } ?>
  </table>
</div></div>
</body></html>
