<?php
require_once __DIR__ . '/inc/koneksi.php';
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }
$id = (int)($_GET['id'] ?? 0);
$res = mysqli_query($conn, "SELECT * FROM peminjaman WHERE id=$id LIMIT 1");
if (!$res || mysqli_num_rows($res)==0) { header('Location: peminjaman.php'); exit; }
$data = mysqli_fetch_assoc($res);
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $nama = $_POST['nama'] ?? '';
    $kelas = $_POST['kelas'] ?? '';
    $judul_buku = $_POST['judul_buku'] ?? '';
    $tp = $_POST['tanggal_pinjam'] ?? '';
    $tk = $_POST['tanggal_kembali'] ?? '';
    $stmt = $conn->prepare("UPDATE peminjaman SET nama=?,kelas=?,judul_buku=?,tanggal_pinjam=?,tanggal_kembali=? WHERE id=?");
    $stmt->bind_param("sssssi", $nama,$kelas,$judul_buku,$tp,$tk,$id);
    $stmt->execute();
    header('Location: peminjaman.php'); exit;
}
?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Edit Peminjaman</title><link rel="stylesheet" href="assets/css/style.css"></head>
<body>
<div class="form-container">
  <h2>Edit Peminjaman</h2>
  <form method="post">
    <label>Nama</label><input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>
    <label>Kelas</label><input type="text" name="kelas" value="<?= htmlspecialchars($data['kelas']) ?>" required>
    <label>Judul Buku</label><input type="text" name="judul_buku" value="<?= htmlspecialchars($data['judul_buku']) ?>" required>
    <label>Tanggal Pinjam</label><input type="date" name="tanggal_pinjam" value="<?= htmlspecialchars($data['tanggal_pinjam']) ?>" required>
    <label>Tanggal Kembali</label><input type="date" name="tanggal_kembali" value="<?= htmlspecialchars($data['tanggal_kembali']) ?>" required>
    <button type="submit">Update</button>
  </form>
</div>
</body></html>
