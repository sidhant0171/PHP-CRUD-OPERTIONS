<?php
include('connection.php');

if (isset($_GET['id'])) {
    $deleteUserId = $_GET['id'];

    $deleteQuery = "DELETE FROM users WHERE id=$deleteUserId";

    if ($conn->query($deleteQuery) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {

}
header("Location: dashboard.php");



$conn->close();
?>
