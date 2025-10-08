<?php
require_once __DIR__ . '/inc/koneksi.php';
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }
$sql = "SELECT * FROM buku ORDER BY id DESC";
$res = mysqli_query($conn, $sql);
?>
<!doctype html>
<html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Data Buku</title><link rel="stylesheet" href="assets/css/style.css"></head>
<body>
<div class="container">
  <div class="card">
    <h2>Data Buku</h2>
    <a class="btn" href="tambah_buku.php">+ Tambah Buku</a>
    <table>
      <tr><th>No</th><th>Judul</th><th>Pengarang</th><th>Penerbit</th><th>Tahun</th><th>Aksi</th></tr>
<?php $no=1; while($row=mysqli_fetch_assoc($res)){ ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= htmlspecialchars($row['judul']) ?></td>
        <td><?= htmlspecialchars($row['pengarang']) ?></td>
        <td><?= htmlspecialchars($row['penerbit']) ?></td>
        <td><?= htmlspecialchars($row['tahun']) ?></td>
        <td>
          <a class="btn small edit" href="edit_buku.php?id=<?= $row['id'] ?>">Edit</a>
          <a class="btn small delete" href="hapus_buku.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
        </td>
      </tr>
<?php } ?>
    </table>
  </div>
</div>
</body></html>
