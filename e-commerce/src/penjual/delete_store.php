<?php
// Include the database connection
include '../../koneksi.php';

// Check if the ID parameter is set in the URL
if (isset($_GET['id'])) {
    $id_penjual = $_GET['id'];

    // Perform the delete operation
    $query = "DELETE FROM penjual WHERE id_penjual = $id_penjual";
    $result = $conn->query($query);

    // Redirect to the store list page after deletion
    header("Location: store_list.php");
    exit();
} else {
    // Redirect to the store list page if the ID parameter is not set
    header("Location: store_list.php");
    exit();
}
?>
