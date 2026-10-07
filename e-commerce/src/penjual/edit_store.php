<?php
// Include the database connection
include '../../koneksi.php';

// Check if the ID parameter is set in the URL
if (isset($_GET['id'])) {
    $id_penjual = $_GET['id'];

    // Check if the form is submitted for updating
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $nama_penjual = $_POST['nama_penjual'];
        $deskripsi = $_POST['deskripsi'];

        // Perform the update query
        $query = "UPDATE penjual SET 
                    nama_penjual = '$nama_penjual', 
                    deskripsi = '$deskripsi' 
                    WHERE id_penjual = $id_penjual";

        if ($conn->query($query) === TRUE) {
            // If update is successful, redirect to the store list page
            header("Location: store_list.php");
            exit();
        } else {
            // If there's an error, display the error message
            echo "Error updating record: " . $conn->error;
        }
    }

    // Fetch store data based on ID
    $query = "SELECT * FROM penjual WHERE id_penjual = $id_penjual";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $nama_penjual = $row['nama_penjual'];
        $deskripsi = $row['deskripsi'];
    } else {
        // Redirect to the store list page if the store is not found
        header("Location: store_list.php");
        exit();
    }
} else {
    // Redirect to the store list page if the ID parameter is not set
    header("Location: store_list.php");
    exit();
}
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
                     Edit Toko
                </h1>
            </header>
            <form method="post" action="">
        <input type="hidden" name="id_penjual" value="<?php echo $id_penjual; ?>">
        <div class="form-group">
            <label for="nama_penjual">Nama Toko:</label>
            <input type="text" class="form-control" id="nama_penjual" name="nama_penjual" value="<?php echo $nama_penjual; ?>" required>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi:</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" required><?php echo $deskripsi; ?></textarea>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="store_list.php" class="btn btn-secondary">Cancel</a>
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
