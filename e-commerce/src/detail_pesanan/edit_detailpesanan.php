<?php
// Include the database connection
include '../../koneksi.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $id_pesanan = $_POST['id_pesanan'];
    $id_pelanggan = $_POST['id_pelanggan'];
    $tanggal_pesanan = $_POST['tanggal_pesanan'];
    $total_harga = $_POST['total_harga'];
    $metode = $_POST['metode'];
    $produk_ids = isset($_POST['id_produk']) ? $_POST['id_produk'] : [];

    // Update Pesanan data
    $updatePesananSQL = "UPDATE pesanan SET id_pelanggan='$id_pelanggan', tanggal_pesanan='$tanggal_pesanan', total_harga='$total_harga' WHERE id_pesanan='$id_pesanan'";
    $conn->query($updatePesananSQL);

    // Delete existing DetailPesanan records for the pesanan
    $deleteDetailPesananSQL = "DELETE FROM detailpesanan WHERE id_pesanan='$id_pesanan'";
    $conn->query($deleteDetailPesananSQL);

    // Insert updated DetailPesanan data
    foreach ($produk_ids as $produk_id) {
        $insertDetailPesananSQL = "INSERT INTO detailpesanan (id_pesanan, id_produk) VALUES ('$id_pesanan', '$produk_id')";
        $conn->query($insertDetailPesananSQL);
    }

    // Update Pembayaran data
    $updatePembayaranSQL = "UPDATE pembayaran SET total_harga='$total_harga', metode='$metode' WHERE id_pesanan='$id_pesanan'";
    $conn->query($updatePembayaranSQL);

    // Close the database connection
    $conn->close();

    // Redirect to the list_pesanan.php page
    header("Location: list_pesanan.php");
    exit();
}

// Fetch pesanan data for editing
$id_pesanan = $_GET['id'];
$sqlPesanan = "SELECT * FROM pesanan WHERE id_pesanan='$id_pesanan'";
$resultPesanan = $conn->query($sqlPesanan);
$rowPesanan = $resultPesanan->fetch_assoc();

// Fetch detailpesanan data for editing
$sqlDetailPesanan = "SELECT id_produk FROM detailpesanan WHERE id_pesanan='$id_pesanan'";
$resultDetailPesanan = $conn->query($sqlDetailPesanan);
$produk_ids = [];
while ($rowDetailPesanan = $resultDetailPesanan->fetch_assoc()) {
    $produk_ids[] = $rowDetailPesanan['id_produk'];
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
    <title>Edit Detail Pesanan</title>
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
                     Edit Detail Pesanan
                </h1>
            </header>        
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="id_pesanan" value="<?php echo $rowPesanan['id_pesanan']; ?>">

        <div class="form-group">
            <label for="id_pelanggan">Nama Pelanggan:</label>
            <select class="form-control" id="id_pelanggan" name="id_pelanggan" required>
                <?php
                // Display options
                while ($rowPelanggan = $resultPelanggan->fetch_assoc()) {
                    $selected = ($rowPelanggan['id_pelanggan'] == $rowPesanan['id_pelanggan']) ? 'selected' : '';
                    echo "<option value='{$rowPelanggan['id_pelanggan']}' $selected>{$rowPelanggan['nama_pelanggan']}</option>";
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
                    $selected = (in_array($rowProduk['id_produk'], $produk_ids)) ? 'selected' : '';
                    echo "<option value='{$rowProduk['id_produk']}' data-harga='{$rowProduk['harga']}' $selected>{$rowProduk['nama_produk']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="total_harga">Total Harga:</label>
            <input type="text" class="form-control" id="total_harga" name="total_harga" value="<?php echo $rowPesanan['total_harga']; ?>" readonly>
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
                    $selected = ($choice == $rowPesanan['metode']) ? 'selected' : '';
                    echo "<option value='{$choice}' $selected>{$choice}</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Edit Pesanan</button>
        <a href="list_pesanan.php" class="btn btn-secondary">Cancel</a>
    </form>
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
