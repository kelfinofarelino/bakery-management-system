<?php
include 'config.php';
checkLogin();

$id = mysqli_real_escape_string($conn, $_GET['id']);

// Get cake data to delete the photo file
$query = "SELECT * FROM kue WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$kue = mysqli_fetch_assoc($result);

if ($kue) {
    // Delete photo file
    if (file_exists('uploads/' . $kue['foto'])) {
        unlink('uploads/' . $kue['foto']);
    }
    
    // Delete from database
    $delete_query = "DELETE FROM kue WHERE id = '$id'";
    mysqli_query($conn, $delete_query);
}

header("Location: dashboard.php");
exit();
?>