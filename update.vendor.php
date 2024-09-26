<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_vendor = $_POST['id_vendor'];

    // Mengambil data vendor saat ini
    $stmt = $conn->prepare("SELECT * FROM vendor WHERE id_vendor = ?");
    $stmt->bind_param("s", $id_vendor);
    $stmt->execute();
    $result = $stmt->get_result();
    $vendor = $result->fetch_assoc();

    if (!$vendor) {
        echo "Vendor tidak ditemukan.";
        exit();
    }

    // Update data vendor
    if (isset($_POST['update'])) {
        $nama = $_POST['nama'];
        $kontak = $_POST['kontak'];
        $nama_barang = $_POST['nama_barang'];

        // Persiapkan pernyataan update
        $stmt = $conn->prepare("UPDATE vendor SET nama = ?, kontak = ?, nama_barang = ? WHERE id_vendor = ?");
        $stmt->bind_param("ssss", $nama, $kontak, $nama_barang, $id_vendor);

        if ($stmt->execute()) {
            header("Location: vendor.php");
            exit();
        } else {
            echo "Error memperbarui data: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Vendor</title>
</head>
<body>
    <h1>Update Vendor</h1>
    <form action="" method="post">
        <input type="hidden" name="id_vendor" value="<?php echo htmlspecialchars($vendor['id_vendor']); ?>">

        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($vendor['nama']); ?>" required><br><br>

        <label for="kontak">Kontak:</label>
        <input type="text" id="kontak" name="kontak" value="<?php echo htmlspecialchars($vendor['kontak']); ?>" required><br><br>

        <label for="nama_barang">Nama Barang:</label>
        <input type="text" id="nama_barang" name="nama_barang" value="<?php echo htmlspecialchars($vendor['nama_barang']); ?>" required><br><br>

        <input type="submit" name="update" value="Update Data">
    </form>
</body>
</html>
