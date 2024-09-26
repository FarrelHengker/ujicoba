<?php
$servername = "localhost"; // Nama server, biasanya 'localhost'
$username = "root"; // Username database, biasanya 'root'
$password = ""; // Password database, kosongkan jika tidak ada
$dbname = "db_stok"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);
  
// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
} else {

}
?>
