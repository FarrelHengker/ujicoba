<?php
include 'koneksi.php';

// Tangani data formulir jika di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Ambil data dari formulir
    $id_storage = $_POST['id_storage'];
    $nama_gudang = $_POST['nama_gudang'];
    $lokasi = $_POST['lokasi'];

    // Siapkan dan eksekusi pernyataan SQL untuk menyimpan data
    $sql_insert = "INSERT INTO storage (id_storage, nama_gudang, lokasi) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql_insert);

    if ($stmt) {
        $stmt->bind_param("sss", $id_storage, $nama_gudang, $lokasi);

        if ($stmt->execute()) {
            echo "<p>Data berhasil ditambahkan!</p>";
        } else {
            echo "<p>Terjadi kesalahan: " . $stmt->error . "</p>";
        }

        $stmt->close();
    } else {
        echo "<p>Terjadi kesalahan dalam persiapan pernyataan: " . $conn->error . "</p>";
    }
}

// Ambil data dari tabel storage
$sql = "SELECT * FROM storage";
$storage = $conn->query($sql);
?>