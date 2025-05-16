<?php
// manage_brand.php
include 'db.php';

// Fetch all brands
$sql = "SELECT * FROM brands";
$result = $conn->query($sql);
?>
<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8" />  
    <title>Manage Brands</title>  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />  
</head>  
<body>  

<div class="container mt-4">  
    <h4>Manage Brands</h4>  

    <!-- Status message -->
    <?php if (isset($_GET['status'])): ?>
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <?php
                if ($_GET['status'] === 'updated') echo "✅ Brand updated successfully!";
                if ($_GET['status'] === 'deleted') echo "🗑️ Brand deleted successfully!";
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card mt-3">  
        <div class="card-header bg-light">  
            <strong>LISTED BRANDS</strong>  
        </div>  
        <div class="card-body p-3">  

            <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap gap-2">  
                <div>  
                    Show   
                    <select id="entries" class="form-select form-select-sm d-inline-block" style="width: auto;">  
                        <option selected>10</option>  
                        <option>25</option>  
                        <option>50</option>  
                        <option>100</option>  
                    </select>   
                    entries  
                </div>  
                <div>  
                    Search: <input type="search" class="form-control form-control-sm d-inline-block" style="width: auto;" />  
                </div>  
            </div>  

            <table class="table table-bordered table-striped table-hover table-sm mb-0">  
                <thead class="table-light">  
                    <tr>  
                        <th style="width: 5%;">#</th>  
                        <th>Brand Name</th>  
                        <th>Creation Date</th>  
                        <th>Updation Date</th>  
                        <th>Action</th>  
                    </tr>  
                </thead>  
                <tbody>  
                    <?php if ($result->num_rows > 0): ?>
                        <?php $count = 1; while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo htmlspecialchars($row['brand_name']); ?></td>
                                <td><?php echo $row['creation_date']; ?></td>
                                <td><?php echo $row['updation_date']; ?></td>
                                <td>
                                    <a href="edit_brand.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="delete_brand.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this brand?')">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No data available in table</td>
                        </tr>
                    <?php endif; ?>
                </tbody>  
                <tfoot class="bg-light">  
                    <tr>  
                        <th>#</th>  
                        <th>Brand Name</th>  
                        <th>Creation Date</th>  
                        <th>Updation Date</th>  
                        <th>Action</th>  
                    </tr>  
                </tfoot>  
            </table>  

            <div class="mt-2 small text-muted">  
                Showing <?php echo $result->num_rows; ?> entries  
            </div>  
        </div>  
    </div>  
</div>  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>  
</body>  
</html>

<?php $conn->close(); ?>
