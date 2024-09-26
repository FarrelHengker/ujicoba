<?php
include 'koneksi.php';

if ($conn) {
    $sql = "SELECT * FROM storage";
    $storage = $conn->query($sql);
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
    <title>Storage</title>
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
        <h2>Storage</h2>
        <ul>
            <li><a href="inventory.php"><i class="fas fa-building"></i> Inventory</a></li>
            <li><a href="storage.php"><i class="fas fa-user-graduate"></i> Storage</a></li>
            <li><a href="vendor.php"><i class="fas fa-book"></i> Vendor</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>
    <div class="main-content">
    <header>
        <h1>Storage</h1>
    </header>

    <!-- Formulir Insert -->
    
    <section>
    <h2>Tambah Data Storage</h2>
    <form action="insert.storage.php" method="post">
        <label for="id_storage">Id Storage:</label>
        <input type="text" id="id_storage" name="id_storage" required><br><br>
        
        <label for="nama_gudang">Nama Gudang:</label>
        <input type="text" id="nama_gudang" name="nama_gudang" required><br><br>

        <label for="lokasi">Lokasi:</label>
        <input type="text" id="lokasi" name="lokasi" required><br><br>

        <input type="submit" name="submit" value="Tambah Data">
    </form>
</section>


    <!-- Tabel Data Storage -->
    <table>
        <thead>
            <tr>
                <th>Id Storage</th>
                <th>Nama Gudang</th>
                <th>Lokasi</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Memeriksa apakah ada data yang dikembalikan
            if ($storage && $storage->num_rows > 0) {
                // Menampilkan data dalam bentuk tabel
                while($row = $storage->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["id_storage"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["nama_gudang"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["lokasi"]) . "</td>";
                    echo "<td>
                            <form action='delete.storage.php' method='post' style='display:inline;'>
                                <input type='hidden' name='id_storage' value='" . htmlspecialchars($row["id_storage"]) . "'>
                                <input type='submit' value='Delete' onclick='return confirm(\"Apakah Anda yakin ingin menghapus item ini?\");'>
                            </form>
                            <form action='update.storage.php' method='post' style='display:inline;'>
                                <input type='hidden' name='id_storage' value='" . htmlspecialchars($row["id_storage"]) . "'>
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
