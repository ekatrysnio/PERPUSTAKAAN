<?php
require_once __DIR__ . '/inc/koneksi.php';
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }
$res = mysqli_query($conn, "SELECT * FROM peminjaman ORDER BY id DESC");
?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Peminjaman</title><link rel="stylesheet" href="assets/css/style.css"></head>
<body>
<div class="container">
  <div class="card">
    <h2>Data Peminjaman</h2>
    <a class="btn" href="tambah_peminjaman.php">+ Tambah Peminjaman</a>
    <table>
      <tr><th>No</th><th>Nama</th><th>Kelas</th><th>Judul Buku</th><th>Pinjam</th><th>Kembali</th><th>Aksi</th></tr>
<?php $no=1; while($row=mysqli_fetch_assoc($res)){ ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= htmlspecialchars($row['nama']) ?></td>
        <td><?= htmlspecialchars($row['kelas']) ?></td>
        <td><?= htmlspecialchars($row['judul_buku']) ?></td>
        <td><?= htmlspecialchars($row['tanggal_pinjam']) ?></td>
        <td><?= htmlspecialchars($row['tanggal_kembali']) ?></td>
        <td>
          <a class="btn small edit" href="edit_peminjaman.php?id=<?= $row['id'] ?>">Edit</a>
          <a class="btn small delete" href="hapus_peminjaman.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
        </td>
      </tr>
<?php } ?>
    </table>
  </div>
</div>
</body></html>
