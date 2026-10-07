<?php
// Include the database connection
include '../../koneksi.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $id_pelanggan = $_POST['id_pelanggan'];
    $tanggal_pesanan = $_POST['tanggal_pesanan'];
    $metode = $_POST['metode'];
    $produk_ids = isset($_POST['id_produk']) ? $_POST['id_produk'] : [];

    // Calculate Total Harga based on selected products
    $total_harga = 0;
    foreach ($produk_ids as $produk_id) {
        // Assuming you have the harga stored in the database for each product
        $harga_query = $conn->query("SELECT harga FROM produk WHERE id_produk = '$produk_id'");
        $harga_row = $harga_query->fetch_assoc();
        $total_harga += $harga_row['harga'];
    }

    // Insert Pesanan data with the calculated total harga
    $insertPesananSQL = "INSERT INTO pesanan (id_pelanggan, tanggal_pesanan, total_harga) 
                         VALUES ('$id_pelanggan', '$tanggal_pesanan', '$total_harga')";
    $conn->query($insertPesananSQL);

    // Retrieve the last inserted Pesanan ID
    $lastPesananID = $conn->insert_id;

    // Insert DetailPesanan data
    foreach ($produk_ids as $produk_id) {
        $insertDetailPesananSQL = "INSERT INTO detailpesanan (id_pesanan, id_produk) 
                                   VALUES ('$lastPesananID', '$produk_id')";
        $conn->query($insertDetailPesananSQL);
    }

    // Insert Pembayaran data
    $insertPembayaranSQL = "INSERT INTO pembayaran (id_pesanan, total_harga, metode) 
                            VALUES ('$lastPesananID', '$total_harga', '$metode')";
    $conn->query($insertPembayaranSQL);

    // Close the database connection
    $conn->close();

    // Redirect to the list_pesanan.php page
    header("Location: list_pesanan.php");
    exit();
}

// Fetch pelanggan data for dropdown
$sqlPelanggan = "SELECT id_pelanggan, nama_pelanggan FROM pelanggan";
$resultPelanggan = $conn->query($sqlPelanggan);

// Fetch produk data for dropdown
$sqlProduk = "SELECT id_produk, nama_produk, harga FROM produk";
$resultProduk = $conn->query($sqlProduk);

// Available choices for Metode Pembayaran
$metodeChoices = ['Credit Card', 'PayPal', 'Bank Transfer', 'ShopeePay', 'GoPay', 'OVO', 'Dana'];
?>

<!DOCTYPE html>
<html lang="en" class="ie_11_scroll">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="hhhwidth=device-width, initial-scale=1">
    <title>Tambah Detail Pesanan</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/templatemo_style.css">
    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="../../favicon.png" />
    <style>
    /* Additional custom styles if needed */
    body {
        background-color: #f5f5f5; /* Set a light background color for the body */
    }
    .mb-3 {
        margin-bottom: 15px; /* Adjust the margin-bottom as needed */
    }

    /* Form styles */
    form {
        background-color: #fff; /* Set background color of the form to white */
        padding: 20px; /* Add padding inside the form */
        border-radius: 8px; /* Add border-radius for rounded corners */
    }

    /* Label styles */
    form label {
        color: #000; /* Set text color to white for labels */
    }

    #id_produk {
            height: 150px; /* Set the desired height */
    }
</style>

</head>
<body>
    <!-- Top menu -->
    <div class="show-menu">
        <a href="#" class="shadow-top-down">+</a>
    </div>
    <nav class="main-menu shadow-top-down">
        <ul class="nav nav-pills nav-stacked">
            <li><a href="../../index.php" class="scroll_effect">Home</a></li>
            <li><a href="../pelanggan/customer_list.php" class="scroll_effect">Pelanggan</a></li>
            <li><a href="../penjual/store_list.php" class="scroll_effect">Toko</a></li>
            <li><a href="../produk/products_list.php" class="scroll_effect">Produk</a></li>
            <li><a href="../detail_pesanan/list_pesanan.php">Pesanan</a></li>
        </ul>
    </nav>
    <!-- Features -->
    <section id="templatemo_features">
        <div class="container-fluid overflow-hidden">
            <header class="template_header">
                <h1 class="text-center">
                     Tambah Detail Pesanan
                </h1>
            </header>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <label for="id_pelanggan">Nama Pelanggan:</label>
            <select class="form-control" id="id_pelanggan" name="id_pelanggan" required>
                <?php
                // Display options
                while ($rowPelanggan = $resultPelanggan->fetch_assoc()) {
                    echo "<option value='{$rowPelanggan['id_pelanggan']}'>{$rowPelanggan['nama_pelanggan']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="id_produk">Produk Dibeli:</label>
            <select class="form-control" id="id_produk" name="id_produk[]" multiple required>
                <?php
                // Display options
                while ($rowProduk = $resultProduk->fetch_assoc()) {
                    echo "<option value='{$rowProduk['id_produk']}' data-harga='{$rowProduk['harga']}'>{$rowProduk['nama_produk']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="total_harga">Total Harga:</label>
            <input type="text" class="form-control" id="total_harga" name="total_harga" readonly>
        </div>

        <script>
            // JavaScript to calculate total harga based on selected products
            document.getElementById('id_produk').addEventListener('change', function() {
                var selectedOptions = this.selectedOptions;
                var totalHarga = 0;
                for (var i = 0; i < selectedOptions.length; i++) {
                    totalHarga += parseFloat(selectedOptions[i].getAttribute('data-harga'));
                }
                document.getElementById('total_harga').value = totalHarga.toFixed(2);
            });
        </script>

        <div class="form-group">
            <label for="tanggal_pesanan">Tanggal Pesanan:</label>
            <input type="datetime-local" class="form-control" id="tanggal_pesanan" name="tanggal_pesanan" value="<?php echo date('Y-m-d\TH:i', strtotime($rowPesanan['tanggal_pesanan'])); ?>" required>
        </div>

        <div class="form-group">
            <label for="metode">Metode Pembayaran:</label>
            <select class="form-control" id="metode" name="metode" required>
                <?php
                // Display options
                foreach ($metodeChoices as $choice) {
                    echo "<option value='{$choice}'>{$choice}</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Tambah</button>
        <a href="list_pesanan.php" class="btn btn-secondary">Cancel</a>
    </form>
        </div>
    </section>

    <!-- require plugins -->
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/jquery-ui.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/jquery.parallax.js"></script>
    <!-- template mo config script -->
    <script src="../../js/templatemo_scripts.js"></script>
</body>
</html>
