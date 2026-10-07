<?php
// Include the database connection
include '../../koneksi.php';

// Check if the ID parameter is provided in the URL
if (isset($_GET['id'])) {
    $id_pesanan = $_GET['id'];

    // Delete DetailPesanan records for the pesanan
    $deleteDetailPesananSQL = "DELETE FROM detailpesanan WHERE id_pesanan='$id_pesanan'";
    $conn->query($deleteDetailPesananSQL);

    // Delete Pembayaran record for the pesanan
    $deletePembayaranSQL = "DELETE FROM pembayaran WHERE id_pesanan='$id_pesanan'";
    $conn->query($deletePembayaranSQL);

    // Delete Pesanan record
    $deletePesananSQL = "DELETE FROM pesanan WHERE id_pesanan='$id_pesanan'";
    $conn->query($deletePesananSQL);

    // Redirect to the list_pesanan.php page after deletion
    header("Location: list_pesanan.php");
    exit();
} else {
    // Redirect to the list_pesanan.php page if no ID is provided
    header("Location: list_pesanan.php");
    exit();
}

// Close the database connection
$conn->close();
?>
