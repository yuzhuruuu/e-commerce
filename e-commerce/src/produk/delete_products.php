<?php
// include database connection file
include_once("../../koneksi.php");

// Check if id_produk is set in the URL
if (isset($_GET['id'])) {
    $id_produk = $_GET['id'];

    // Start a transaction
    mysqli_begin_transaction($conn);

    // Attempt to delete from produkpenjual
    $deleteProdukPenjual = mysqli_query($conn, "DELETE FROM produkpenjual WHERE id_produk = '$id_produk'");

    // Attempt to delete from produk
    $deleteProduk = mysqli_query($conn, "DELETE FROM produk WHERE id_produk = '$id_produk'");

    // Check if both deletes were successful
    if ($deleteProdukPenjual && $deleteProduk) {
        // Commit the transaction
        mysqli_commit($conn);

        // After delete, redirect to the products_list.php page
        header("Location: products_list.php");
    } else {
        // Rollback the transaction if any delete fails
        mysqli_rollback($conn);

        echo "Error deleting records.";
    }
} else {
    echo "ID Produk is not set in the URL.";
} 
?>
