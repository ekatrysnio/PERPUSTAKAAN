<?php
require_once __DIR__ . '/inc/koneksi.php';
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }
$id = (int)($_GET['id'] ?? 0);
if (!$id) { header('Location: buku.php'); exit; }
$res = mysqli_query($conn, "SELECT * FROM buku WHERE id=$id LIMIT 1");
if (!$res || mysqli_num_rows($res)==0){ die('Data tidak ditemukan'); }
$data = mysqli_fetch_assoc($res);
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $judul = $_POST['judul'] ?? '';
    $pengarang = $_POST['pengarang'] ?? '';
    $penerbit = $_POST['penerbit'] ?? '';
    $tahun = (int)($_POST['tahun'] ?? 0);
    $stmt = $conn->prepare("UPDATE buku SET judul=?, pengarang=?, penerbit=?, tahun=? WHERE id=?");
    $stmt->bind_param("sssii", $judul, $pengarang, $penerbit, $tahun, $id);
    $stmt->execute();
    header('Location: buku.php'); exit;
}
?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Edit Buku</title><link rel="stylesheet" href="assets/css/style.css"></head>
<body>
<div class="form-container">
  <h2>Edit Buku</h2>
  <form method="post">
    <label>Judul</label><input type="text" name="judul" value="<?= htmlspecialchars($data['judul']) ?>" required>
    <label>Pengarang</label><input type="text" name="pengarang" value="<?= htmlspecialchars($data['pengarang']) ?>" required>
    <label>Penerbit</label><input type="text" name="penerbit" value="<?= htmlspecialchars($data['penerbit']) ?>" required>
    <label>Tahun</label><input type="number" name="tahun" value="<?= htmlspecialchars($data['tahun']) ?>" required>
    <button type="submit">Simpan Perubahan</button>
  </form>
</div>
</body></html>
