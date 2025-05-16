<?php
// delete_brand.php
include 'db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Invalid brand ID.");
}

$stmt = $conn->prepare("DELETE FROM brands WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: manage_brand.php?status=deleted");
    exit();
} else {
    echo "Error deleting brand.";
}

$conn->close();
?>
