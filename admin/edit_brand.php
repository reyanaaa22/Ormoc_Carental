<?php
// edit_brand.php
include 'db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Invalid brand ID.");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $brand_name = $_POST['brand_name'];

    $stmt = $conn->prepare("UPDATE brands SET brand_name = ?, updation_date = NOW() WHERE id = ?");
    $stmt->bind_param("si", $brand_name, $id);

    if ($stmt->execute()) {
        header("Location: manage_brand.php?status=updated");
        exit();
    } else {
        echo "Error updating brand.";
    }
}

// Fetch brand details
$stmt = $conn->prepare("SELECT * FROM brands WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$brand = $result->fetch_assoc();

if (!$brand) {
    die("Brand not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Brand</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

<div class="container mt-4">
    <h4>Edit Brand</h4>
    <form method="POST" class="mt-3">
        <div class="mb-3">
            <label class="form-label"><strong>Brand Name</strong></label>
            <input type="text" name="brand_name" class="form-control" value="<?php echo htmlspecialchars($brand['brand_name']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Brand</button>
        <a href="manage_brand.php" class="btn btn-secondary">Back</a>
    </form>
</div>

</body>
</html>

<?php $conn->close(); ?>
