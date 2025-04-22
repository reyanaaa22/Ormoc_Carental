<?php
include 'db.php'; // Include your database connection

$error = ''; // Initialize error message
$msg = ''; // Initialize success message

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $brand = trim($_POST['brand']); // Get the brand name from the form

    // Check if the brand name is not empty
    if (!empty($brand)) {
        // Prepare the SQL query to insert the brand into the database
        $stmt = $conn->prepare("INSERT INTO brands (brand_name, creation_date, updation_date) VALUES (?, NOW(), NOW())");
        $stmt->bind_param("s", $brand);

        // Execute the query and check if it was successful
        if ($stmt->execute()) {
            $msg = 'Brand created successfully!';
        } else {
            $error = 'Database error: ' . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        $error = 'Brand name cannot be empty.';
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Brand</title>
    <style>
        .form-container {
            width: 100%;
            margin: 30px auto;
            border: 1px solid #eee;
            border-radius: 5px;
            padding: 20px;
            background: #fff;
        }
        .form-header {
            background: #f9f5f0;
            padding: 10px;
            font-weight: bold;
            color: #333;
            border-bottom: 1px solid #ddd;
        }
        .form-body {
            padding: 20px;
        }
        input[type="text"] {
            width: 50%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #004153;
            color: white;
            padding: 10px 20px;
            border: none;
            margin-top: 15px;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background-color: #006d91;
        }
        .alert {
            padding: 10px;
            margin-top: 10px;
            border-radius: 4px;
        }
        .succWrap {
            background-color: #d4edda;
            color: #155724;
        }
        .errorWrap {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>

    <h2>Create Brand</h2>

    <div class="form-container">
        <div class="form-header">Form Fields</div>
        <div class="form-body">
            <!-- Success/Error Messages -->
            <?php if ($error) { ?>
                <div class="errorWrap"><strong>ERROR</strong>: <?php echo htmlentities($error); ?> </div>
            <?php } else if ($msg) { ?>
                <div class="succWrap"><strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?> </div>
            <?php } ?>

            <!-- Brand creation form -->
            <form id="brandForm" method="POST" action="create_brand.php">
                <label><strong>Brand Name</strong></label><br><br>
                <input type="text" name="brand" required><br><br>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

    <script>
        // JavaScript to submit the form asynchronously (AJAX)
        document.getElementById('brandForm').addEventListener('submit', function(e) {
            e.preventDefault();  // Prevent the default form submission behavior
            const formData = new FormData(this);

            fetch('', {  // Sends the POST request to the same page
                method: 'POST',
                body: formData
            })
            .then(res => res.text())  // Read the response as text
            .then(data => {
                document.getElementById('brandMessage').innerHTML = data;  // Display the message returned by PHP
                this.reset();  // Reset the form
            })
            .catch(err => {
                document.getElementById('brandMessage').innerHTML = `<div class="alert alert-danger">Error: ${err.message}</div>`;
            });
        });
    </script>

</body>
</html>
