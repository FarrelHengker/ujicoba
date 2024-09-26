<?php
include 'koneksi.php';

if ($conn) {
    $sql = "SELECT * FROM vendor";
    $vendor = $conn->query($sql);
} else {
    echo "Koneksi ke database gagal.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor</title>
    <link rel="stylesheet" href="dash.css">
    <style>
        table { 
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>vendor</h2>
        <ul>
            <li><a href="inventory.php"><i class="fas fa-building"></i> Inventory</a></li>
            <li><a href="storage.php"><i class="fas fa-user-graduate"></i> Storage</a></li>
            <li><a href="vendor.php"><i class="fas fa-book"></i> Vendor</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>
    <div class="main-content">
    <header>
        <h1>vendor</h1>
    </header>

    <!-- Formulir Insert -->
    
    <section>
    <h2>Tambah Data Storage</h2>
    <form action="insert.vendor.php" method="post">
        <label for="id_vendor">Id Vendor:</label>
        <input type="text" id="id_vendor" name="id_vendor" required><br><br>
        
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required><br><br>

        <label for="kontak">Kontak:</label>
        <input type="text" id="kontak" name="kontak" required><br><br>

        <label for="nama_barang">Nama Barang:</label>
        <input type="text" id="nama_barang" name="nama_barang" required><br><br>

        <input type="submit" name="submit" value="Tambah Data">
    </form>
</section>


    <!-- Tabel Data Vendor -->
    <table>
        <thead>
            <tr>
                <th>Id Vendor</th>
                <th>Nama</th>
                <th>Kontak</th>
                <th>Nama Barang
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Memeriksa apakah ada data yang dikembalikan
            if ($vendor && $vendor->num_rows > 0) {
                // Menampilkan data dalam bentuk tabel
                while($row = $vendor->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["id_vendor"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["nama"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["kontak"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["nama_barang"]) . "</td>";
                    echo "<td>
                            <form action='delete.storage.php' method='post' style='display:inline;'>
                                <input type='hidden' name='id_storage' value='" . htmlspecialchars($row["id_vendor"]) . "'>
                                <input type='submit' value='Delete' onclick='return confirm(\"Apakah Anda yakin ingin menghapus item ini?\");'>
                            </form>
                            <form action='update.storage.php' method='post' style='display:inline;'>
                                <input type='hidden' name='id_storage' value='" . htmlspecialchars($row["id_vendor"]) . "'>
                                <input type='submit' value='Update'>
                            </form>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Tidak ada data storage ditemukan</td></tr>";
            }

            // Menutup koneksi database
            if (isset($conn)) {
                $conn->close();
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
