<?php
include '../../koneksi.php';

// Check if the ID parameter is set in the URL
if (isset($_GET['id'])) {
    $id_pelanggan = $_GET['id'];

    // Retrieve customer information based on ID
    $query = "SELECT * FROM pelanggan WHERE id_pelanggan = $id_pelanggan";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Fetch customer details for editing
        $nama_pelanggan = $row['nama_pelanggan'];
        $usia = $row['usia'];
        $alamat = $row['alamat'];
        $no_telp = $row['no_telp'];

        // Check if the form is submitted for updating
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id_pelanggan = $_POST['id_pelanggan'];
            $nama_pelanggan = $_POST['nama_pelanggan'];
            $usia = $_POST['usia'];
            $alamat = $_POST['alamat'];
            $no_telp = $_POST['no_telp'];

            // Ensure $id_pelanggan is not empty before updating
            if (!empty($id_pelanggan)) {
                $update_query = "UPDATE pelanggan SET 
                                  nama_pelanggan = '$nama_pelanggan',
                                  usia = $usia,
                                  alamat = '$alamat',
                                  no_telp = '$no_telp'
                                  WHERE id_pelanggan = $id_pelanggan";

                if ($conn->query($update_query) === TRUE) {
                    // Redirect back to the customer list page after successful update
                    header("Location: customer_list.php");
                    exit();
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            } else {
                echo "Error: ID Pelanggan is empty.";
            }
        }
    } else {
        // Redirect to the customer list page if the customer is not found
        header("Location: customer_list.php");
        exit();
    }
} else {
    // Redirect to the customer list page if the ID parameter is not set
    header("Location: customer_list.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en" class="ie_11_scroll">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="hhhwidth=device-width, initial-scale=1">
    <title>Edit Pelanggan</title>
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
                     Edit Pelanggan
                </h1>
            </header>        
            <form method="post" action="">
            <div class="form-group">
                <label for="nama_pelanggan">Nama:</label>
                <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="<?php echo $nama_pelanggan; ?>" required>
            </div>
            <div class="form-group">
                <label for="usia">Usia:</label>
                <input type="text" class="form-control" id="usia" name="usia" value="<?php echo $usia; ?>" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat; ?>" required>
            </div>
            <div class="form-group">
                <label for="no_telp">Nomor Telepon:</label>
                <input type="text" class="form-control" id="no_telp" name="no_telp" value="<?php echo $no_telp; ?>" required>
            </div>
            <!-- Add a hidden input for id_pelanggan -->
            <input type="hidden" name="id_pelanggan" value="<?php echo $id_pelanggan; ?>">
            <button type="submit" class="btn btn-success">Update</button>
            <a href="customer_list.php" class="btn btn-secondary">Cancel</a>
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
