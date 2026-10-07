<?php
// Include the database connection
include '../../koneksi.php';

// Fetch existing sellers for dropdown
$sqlSellers = "SELECT id_penjual, nama_penjual FROM penjual";
$resultSellers = $conn->query($sqlSellers);

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Product Information
    $productName = $_POST['product_name'];
    $productDescription = $_POST['product_description'];
    $productPrice = $_POST['product_price'];

    // Seller Information
    $sellerID = $_POST['seller_id'];

    // Insert product into the 'produk' table
    $insertProductQuery = "INSERT INTO produk (nama_produk, deskripsi, harga, id_penjual) 
                           VALUES ('$productName', '$productDescription', '$productPrice', '$sellerID')";
    $resultProduct = $conn->query($insertProductQuery);

    // Get the ID of the newly inserted product
    $newProductID = $conn->insert_id;

    // Insert the relationship into the 'produkpenjual' table
    $insertRelationshipQuery = "INSERT INTO produkpenjual (id_produk, id_penjual) 
                                VALUES ('$newProductID', '$sellerID')";
    $resultRelationship = $conn->query($insertRelationshipQuery);

    if ($resultProduct && $resultRelationship) {
        echo "<p class='alert alert-success'>Product added successfully.</p>";
        header("Location: products_list.php");
        exit();
    } else {
        echo "<p class='alert alert-danger'>Error adding Product.</p>";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en" class="ie_11_scroll">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="hhhwidth=device-width, initial-scale=1">
    <title>Tambah Produk</title>
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
                     Tambah Produk
                </h1>
            </header>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <!-- Seller Information Dropdown -->
        <div class="form-group">
            <label for="seller_id">Pilih Toko:</label>
            <select class="form-control" id="seller_id" name="seller_id" required>
                <?php
                // Display existing sellers as options
                while ($rowSeller = $resultSellers->fetch_assoc()) {
                    echo "<option value='{$rowSeller['id_penjual']}'>{$rowSeller['nama_penjual']}</option>";
                }
                ?>
                <option value="add_new">Tambah Toko Baru</option>
            </select>
        </div>

        <!-- Product Information -->
        <div class="form-group">
            <label for="product_name">Nama Produk:</label>
            <input type="text" class="form-control" name="product_name" required>
        </div>

        <div class="form-group">
            <label for="product_description">Deskripsi Produk:</label>
            <textarea class="form-control" name="product_description" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label for="product_price">Harga Produk:</label>
            <input type="text" class="form-control" name="product_price" required>
        </div>

        <button type="submit" class="btn btn-primary">Tambah</button>
        <a href="products_list.php" class="btn btn-secondary">Cancel</a>
    </form>
        </div>
<script>
    // JavaScript to redirect to add_store.php when "Tambah Toko Baru" is selected
    document.getElementById('seller_id').addEventListener('change', function () {
        if (this.value === 'add_new') {
            window.location.href = 'add_store.php';
        }
    });
</script>
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
