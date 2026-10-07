<?php
// Include the database connection
include '../../koneksi.php';

// Check if ID parameter is set in the URL
if (isset($_GET['id'])) {
    $productID = $_GET['id'];

    // Fetch product details for the given ID
    $sqlProduct = "SELECT produk.id_produk, produk.nama_produk, produk.deskripsi AS product_description, 
                   produk.harga, penjual.id_penjual, penjual.nama_penjual
                   FROM produk
                   INNER JOIN produkpenjual ON produk.id_produk = produkpenjual.id_produk
                   INNER JOIN penjual ON produkpenjual.id_penjual = penjual.id_penjual
                   WHERE produk.id_produk = $productID";

    $resultProduct = $conn->query($sqlProduct);

    if ($resultProduct->num_rows > 0) {
        $rowProduct = $resultProduct->fetch_assoc();
        $productName = $rowProduct['nama_produk'];
        $productDescription = $rowProduct['product_description'];
        $productPrice = $rowProduct['harga'];
        $sellerID = $rowProduct['id_penjual'];
    } else {
        echo "<p class='alert alert-danger'>Product not found.</p>";
        exit();
    }
} else {
    echo "<p class='alert alert-danger'>Product ID is not set.</p>";
    exit();
}

// Fetch existing sellers for dropdown
$sqlSellers = "SELECT id_penjual, nama_penjual FROM penjual";
$resultSellers = $conn->query($sqlSellers);

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Seller Information
    $productName = $_POST['product_name'];
    $productDescription = $_POST['product_description'];
    $productPrice = $_POST['product_price'];
    $sellerID = $_POST['seller_id'];

    // Update product in the 'produk' table
    $updateProductQuery = "UPDATE produk
                           SET nama_produk = '$productName', 
                               deskripsi = '$productDescription', 
                               harga = '$productPrice'
                           WHERE id_produk = $productID";

    $resultUpdateProduct = $conn->query($updateProductQuery);

    // Update relationship in the 'produkpenjual' table
    $updateRelationshipQuery = "UPDATE produkpenjual
                                SET id_penjual = '$sellerID'
                                WHERE id_produk = $productID";

    $resultUpdateRelationship = $conn->query($updateRelationshipQuery);

    if ($resultUpdateProduct && $resultUpdateRelationship) {
        echo "<p class='alert alert-success'>Product and Seller updated successfully.</p>";
        header("Location: products_list.php");
        exit();
    } else {
        echo "<p class='alert alert-danger'>Error updating product or seller.</p>";
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
    <title>Edit Toko</title>
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
                     Edit Produk
                </h1>
            </header>
            <form action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $productID; ?>" method="post">
        <!-- Seller Information Dropdown -->
        <div class="form-group">
            <label for="seller_id">Pilih Toko:</label>
            <select class="form-control" id="seller_id" name="seller_id" required>
                <?php
                // Display existing sellers as options
                while ($rowSeller = $resultSellers->fetch_assoc()) {
                    $selected = ($rowSeller['id_penjual'] == $sellerID) ? 'selected' : '';
                    echo "<option value='{$rowSeller['id_penjual']}' $selected>{$rowSeller['nama_penjual']}</option>";
                }
                ?>
            </select>
        </div>

        <!-- Product Information -->
        <div class="form-group">
            <label for="product_name">Nama Produk:</label>
            <input type="text" class="form-control" name="product_name" value="<?php echo $productName; ?>" required>
        </div>

        <div class="form-group">
            <label for="product_description">Deskripsi Produk:</label>
            <textarea class="form-control" name="product_description" rows="3" required><?php echo $productDescription; ?></textarea>
        </div>

        <div class="form-group">
            <label for="product_price">Harga Produk:</label>
            <input type="text" class="form-control" name="product_price" value="<?php echo $productPrice; ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="products_list.php" class="btn btn-secondary">Cancel</a>
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
