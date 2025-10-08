<?php
session_start();
require_once __DIR__ . '/inc/koneksi.php';

$error='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $sql = "SELECT * FROM pengguna WHERE username = '".mysqli_real_escape_string($conn,$username)."' LIMIT 1";
    $res = mysqli_query($conn, $sql);
    if ($res && mysqli_num_rows($res)==1) {
        $user = mysqli_fetch_assoc($res);
        // password stored as SHA2 for demo (match SQL insert)
        if (hash('sha256', $password) === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['level'] = $user['level'];
            header('Location: dashboard.php');
            exit;
        } else {
            $error = 'Username atau password salah.';
        }
    } else {
        $error = 'Username atau password salah.';
    }
}
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Login - Perpustakaan</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container">
  <div class="form-container">
    <div class="center"><img src="assets/img/logo_sdn.png" alt="logo" style="height:84px"></div>
    <h2 class="center">Login Perpustakaan</h2>
    <?php if($error): ?><div style="color:#c62828;font-weight:700;margin-bottom:8px"><?=htmlspecialchars($error)?></div><?php endif; ?>
    <form method="post">
      <label>Username</label>
      <input type="text" name="username" required>
      <label>Password</label>
      <input type="password" name="password" required>
      <button type="submit">Login</button>
    </form>
  </div>
</div>
</body>
</html>
