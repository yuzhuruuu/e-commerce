<?php
include '../../koneksi.php';

// Check if the ID parameter is set in the URL
if (isset($_GET['id'])) {
    $id_pelanggan = $_GET['id'];

    // Perform the delete operation
    $query = "DELETE FROM pelanggan WHERE id_pelanggan = $id_pelanggan";
    $result = $conn->query($query);

    // Redirect to the customer list page after deletion
    header("Location: customer_list.php");
    exit();
} else {
    // Redirect to the customer list page if the ID parameter is not set
    header("Location: customer_list.php");
    exit();
}
?>
