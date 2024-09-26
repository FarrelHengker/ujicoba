<?php
include 'koneksi.php';

$sql = "SELECT * FROM inventory";
$inventory = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="stylesheet" href="dash.css"> <!-- Ensure this CSS file is available -->
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
        <h2>Inventory</h2>
        <ul>
            <li><a href="inventory.php"><i class="fas fa-building"></i> Inventory</a></li>
            <li><a href="storage.php"><i class="fas fa-user-graduate"></i> Storage</a></li>
            <li><a href="vendor.php"><i class="fas fa-book"></i> Vendor</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>
    <div class="main-content">
        <header>
            <h1>Inventory</h1>
        </header>

        <!-- Form to Insert Inventory Data -->
        <section>
            <h2>Add Inventory Data</h2>
            <form action="insert.inventory.php" method="post">
                <label for="id_inventory">Id Inventory:</label>
                <input type="text" id="id_inventory" name="id_inventory" required><br><br>
                
                <label for="nama_barang">Nama Barang:</label>
                <input type="text" id="nama_barang" name="nama_barang" required><br><br>

                <label for="jenis_barang">Jenis Barang:</label>
                <input type="text" id="jenis_barang" name="jenis_barang" required><br><br>

                <label for="harga_barang">Harga Barang:</label>
                <input type="number" id="harga_barang" name="harga_barang" required><br><br>

                <label for="kuantitas_stok">Kuantitas Barang:</label>
                <input type="number" id="kuantitas_stok" name="kuantitas_stok" required><br><br>

                <label for="lokasi">Lokasi:</label>
                <input type="text" id="lokasi" name="lokasi" required><br><br>

                <label for="serial_number">Serial Number:</label>
                <input type="text" id="serial_number" name="serial_number" required><br><br>

                <input type="submit" name="submit" value="Add Data">
            </form>
        </section>

        <!-- Inventory Data Table -->
        <table>
            <thead>
                <tr>
                    <th>Id Inventory</th>
                    <th>Nama Barang</th>
                    <th>Jenis Barang</th>
                    <th>Harga Barang</th>
                    <th>Kuantitas Stok</th>
                    <th>Lokasi</th>
                    <th>Serial Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($inventory->num_rows > 0) {
                    while($row = $inventory->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["id_inventory"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["nama_barang"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["jenis_barang"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["harga_barang"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["kuantitas_stok"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["lokasi"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["serial_number"]) . "</td>";
                        echo "<td>
                                <form action='delete.inventory.php' method='post' style='display:inline;'>
                                    <input type='hidden' name='id_inventory' value='" . htmlspecialchars($row["id_inventory"]) . "'>
                                    <input type='submit' value='Delete' onclick='return confirm(\"Are you sure you want to delete this item?\");'>
                                </form>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Tidak ada data inventory ditemukan</td></tr>";
                }

                // Close the database connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
