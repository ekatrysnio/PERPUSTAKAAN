
-- Database and tables for Perpustakaan
CREATE DATABASE IF NOT EXISTS perpustakaan_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE perpustakaan_db;

CREATE TABLE IF NOT EXISTS pengguna (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  level VARCHAR(50) NOT NULL DEFAULT 'petugas'
);

-- default admin account (password: 12345 hashed with SHA2 for demo)
INSERT INTO pengguna (username,password,level) VALUES ('admin', SHA2('12345',256), 'admin')
ON DUPLICATE KEY UPDATE username=username;

CREATE TABLE IF NOT EXISTS buku (
  id INT AUTO_INCREMENT PRIMARY KEY,
  judul VARCHAR(255) NOT NULL,
  pengarang VARCHAR(255),
  penerbit VARCHAR(255),
  tahun YEAR
);

CREATE TABLE IF NOT EXISTS peminjaman (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(150),
  kelas VARCHAR(50),
  judul_buku VARCHAR(255),
  tanggal_pinjam DATE,
  tanggal_kembali DATE
);
