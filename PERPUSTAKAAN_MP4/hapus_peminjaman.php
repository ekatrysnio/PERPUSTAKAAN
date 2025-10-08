<?php
require_once __DIR__ . '/inc/koneksi.php';
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: index.php'); exit; }
$id = (int)($_GET['id'] ?? 0);
if ($id) { mysqli_query($conn, "DELETE FROM peminjaman WHERE id=$id"); }
header('Location: peminjaman.php'); exit;
?>
