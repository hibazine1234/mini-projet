<?php
include 'db.php';
if (isset($_GET['id'])) {
    $id  = (int) $_GET['id'];
    $sql = "DELETE FROM employees WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
}
header("location:liste.php");

$conn->close();
