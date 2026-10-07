<?php
include '../../koneksi.php';

$query = "SELECT * FROM penjual";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en" class="ie_11_scroll">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="hhhwidth=device-width, initial-scale=1">
        <title>Tabel Toko</title>
<!--
App Landing Template
http://www.templatemo.com/tm-474-app-landing
-->
        <!-- CSS -->
        <link rel="stylesheet" href="../../css/bootstrap.min.css">
        <link rel="stylesheet" href="../../css/font-awesome.min.css">
        <link rel="stylesheet" href="../../css/templatemo_style.css">
        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="../../favicon.png" />
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
        /* Additional custom styles if needed */
        body {
            background-color: #f5f5f5; /* Set a light background color for the body */
        }
        table {
            background-color: #fff; /* Set the background color of the table to white */
            border-collapse: collapse; /* Collapse table borders */
            width: 100%;
        }
        th, td {
            border: 2px solid #000; /* Set border thickness and color */
            padding: 8px; /* Add padding inside cells */
            text-align: left; /* Align text to the left */
        }
        th {
            font-weight: bold; /* Make column headers bold */
        }
        .mb-3 {
        margin-bottom: 15px; /* Adjust the margin-bottom as needed */
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
                         Tabel Toko
                    </h1>
                </header>   
                <a href="add_store.php" class="btn btn-success mb-3">Tambah Toko</a>
                <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID Toko</th>
                <th>Nama Toko</th>
                <th>Deskripsi</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id_penjual']}</td>
                        <td>{$row['nama_penjual']}</td>
                        <td>{$row['deskripsi']}</td>
                        <td>
                            <a href='edit_store.php?id={$row['id_penjual']}' class='btn btn-primary btn-sm'>Edit</a>
                            <a href='delete_store.php?id={$row['id_penjual']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\");'>Delete</a>
                        </td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
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