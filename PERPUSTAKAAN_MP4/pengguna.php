<?php
require_once __DIR__ . '/inc/koneksi.php';
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }
if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['add_user'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];
    // store password as SHA256 for demo; in production use password_hash
    $hash = hash('sha256',$password);
    $stmt = $conn->prepare("INSERT INTO pengguna (username,password,level) VALUES (?,?,?)");
    $stmt->bind_param("sss", $username, $hash, $level);
    $stmt->execute();
    header('Location: pengguna.php'); exit;
}
$res = mysqli_query($conn, "SELECT id,username,level FROM pengguna ORDER BY id DESC");
?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Manajemen Pengguna</title><link rel="stylesheet" href="assets/css/style.css"></head>
<body>
<div class="container"><div class="card">
  <h2>Manajemen Pengguna</h2>
  <form method="post">
    <label>Username</label><input type="text" name="username" required>
    <label>Password</label><input type="password" name="password" required>
    <label>Level</label>
    <select name="level"><option value="admin">admin</option><option value="petugas">petugas</option></select>
    <button name="add_user" type="submit">Tambah Pengguna</button>
  </form>
  <table>
    <tr><th>No</th><th>Username</th><th>Level</th><th>Aksi</th></tr>
<?php $no=1; while($row=mysqli_fetch_assoc($res)){ ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= htmlspecialchars($row['username']) ?></td>
      <td><?= htmlspecialchars($row['level']) ?></td>
      <td><a class="btn small delete" href="hapus_pengguna.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin?')">Hapus</a></td>
    </tr>
<?php } ?>
  </table>
</div></div>
</body></html>
