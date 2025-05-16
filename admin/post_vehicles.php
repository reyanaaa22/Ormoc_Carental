<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Basic Info
    $title = $_POST['vehicle_title'];
    $brand = (int)$_POST['brand']; // Ensuring that the brand is an integer
    $overview = $_POST['vehicle_overview'];
    $price = $_POST['price_per_day'];
    $fuel = $_POST['fuel_type'];
    $modelYear = $_POST['model_year'];
    $seating = $_POST['seating_capacity'];

    // Accessories - default to 0, set to 1 if in array
    $accFields = [
        'AirConditioner', 'PowerSteering', 'CDPlayer',
        'PowerDoorLocks', 'DriverAirbag', 'CentralLocking',
        'AntiLockBrakingSystem', 'PassengerAirbag', 'CrashSensor',
        'BrakeAssist', 'PowerWindows', 'LeatherSeats'
    ];
    $accessories = array_fill_keys($accFields, 0);
    if (isset($_POST['accessories'])) {
        foreach ($_POST['accessories'] as $acc) {
            $key = str_replace(' ', '', $acc);
            if (array_key_exists($key, $accessories)) {
                $accessories[$key] = 1;
            }
        }
    }

    // Handle image uploads
    $uploadedImages = [];
    for ($i = 1; $i <= 5; $i++) {
        $imageKey = 'image' . $i;
        if (isset($_FILES[$imageKey]) && !empty($_FILES[$imageKey]['name'])) {
            $fileTmp = $_FILES[$imageKey]['tmp_name'];
            $fileName = basename($_FILES[$imageKey]['name']);
            $targetDir = "uploads/";
            $newName = uniqid("img_", true) . "_" . $fileName;
            $targetFilePath = $targetDir . $newName;
            if (move_uploaded_file($fileTmp, $targetFilePath)) {
                $uploadedImages[$i] = $newName;
            } else {
                $uploadedImages[$i] = null;
            }
        } else {
            $uploadedImages[$i] = null;
        }
    }

    // Assigning the image variables to ensure they are passed by reference
    $image1 = $uploadedImages[1] ?: NULL;
    $image2 = $uploadedImages[2] ?: NULL;
    $image3 = $uploadedImages[3] ?: NULL;
    $image4 = $uploadedImages[4] ?: NULL;
    $image5 = $uploadedImages[5] ?: NULL;

    // Insert into database
    $stmt = $conn->prepare("
        INSERT INTO vehicles (
            VehiclesTitle, VehiclesBrand, VehiclesOverview, PricePerDay,
            FuelType, ModelYear, SeatingCapacity,
            Vimage1, Vimage2, Vimage3, Vimage4, Vimage5,
            AirConditioner, PowerSteering, CDPlayer,
            PowerDoorLocks, DriverAirbag, CentralLocking,
            AntiLockBrakingSystem, PassengerAirbag, CrashSensor,
            BrakeAssist, PowerWindows, LeatherSeats
        )
        VALUES (?, ?, ?, ?, ?, ?, ?,
                ?, ?, ?, ?, ?,
                ?, ?, ?, ?, ?, ?,
                ?, ?, ?, ?, ?, ?)
    ");

    // Bind parameters, ensuring we handle NULL values properly
    $stmt->bind_param(
        "sisdsiissssiiiiiiiiiiii",
        $title, $brand, $overview, $price, $fuel, $modelYear, $seating,
        $image1, $image2, $image3, $image4, $image5,
        $accessories['AirConditioner'], $accessories['PowerSteering'], $accessories['CDPlayer'],
        $accessories['PowerDoorLocks'], $accessories['DriverAirbag'], $accessories['CentralLocking'],
        $accessories['AntiLockBrakingSystem'], $accessories['PassengerAirbag'], $accessories['CrashSensor'],
        $accessories['BrakeAssist'], $accessories['PowerWindows'], $accessories['LeatherSeats']
    );

    if ($stmt->execute()) {
        echo "<script>alert('Vehicle posted successfully!'); window.location.href = 'post_vehicle.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

// Fetching brands for dropdown
$stmt = $conn->prepare("SELECT id, brand_name FROM brands");
$stmt->execute();
$result = $stmt->get_result();
$brands = [];
while ($row = $result->fetch_assoc()) {
    $brands[] = $row;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Post A Vehicle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .required-star { color: red; }
    </style>
</head>
<body>

<div class="container mt-4 mb-5">
    <h4>Post A Vehicle</h4>

    <form action="post_vehicles.php" method="post" enctype="multipart/form-data">
        <!-- Basic Info Section -->
        <fieldset class="border p-3 mb-4">
            <legend class="float-none w-auto px-2 small text-muted border rounded bg-light">BASIC INFO</legend>

            <div class="row mb-3 align-items-center">
                <label for="vehicleTitle" class="col-sm-2 col-form-label">Vehicle Title<span class="required-star">*</span></label>
                <div class="col-sm-4">
                    <input type="text" id="vehicleTitle" name="vehicle_title" class="form-control" required />
                </div>

                <label for="selectBrand" class="col-sm-2 col-form-label">Select Brand<span class="required-star">*</span></label>
                <div class="col-sm-4">
                    <select id="selectBrand" name="brand" class="form-select" required>
                        <option value="" selected disabled>Select</option>
                        <?php foreach ($brands as $brand): ?>
                            <option value="<?= htmlspecialchars($brand['id']) ?>"><?= htmlspecialchars($brand['brand_name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="vehicleOverview" class="form-label">Vehicle Overview<span class="required-star">*</span></label>
                <textarea id="vehicleOverview" name="vehicle_overview" class="form-control" rows="3" required></textarea>
            </div>

            <div class="row mb-3 align-items-center">
                <label for="pricePerDay" class="col-sm-2 col-form-label">Price Per Day<span class="required-star">*</span></label>
                <div class="col-sm-4">
                    <input type="number" min="0" step="0.01" id="pricePerDay" name="price_per_day" class="form-control" required />
                </div>

                <label for="fuelType" class="col-sm-2 col-form-label">Select Fuel Type<span class="required-star">*</span></label>
                <div class="col-sm-4">
                    <select id="fuelType" name="fuel_type" class="form-select" required>
                        <option value="" selected disabled>Select</option>
                        <option value="petrol">Petrol</option>
                        <option value="diesel">Diesel</option>
                        <option value="electric">Electric</option>
                        <option value="hybrid">Hybrid</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3 align-items-center">
                <label for="modelYear" class="col-sm-2 col-form-label">Model Year<span class="required-star">*</span></label>
                <div class="col-sm-4">
                    <input type="number" min="1900" max="2099" step="1" id="modelYear" name="model_year" class="form-control" required />
                </div>

                <label for="seatingCapacity" class="col-sm-2 col-form-label">Seating Capacity<span class="required-star">*</span></label>
                <div class="col-sm-4">
                    <input type="number" min="1" max="100" step="1" id="seatingCapacity" name="seating_capacity" class="form-control" required />
                </div>
            </div>
        </fieldset>

        <!-- Upload Images Section -->
        <fieldset class="border p-3 mb-4">
            <legend class="float-none w-auto px-2 small text-muted border rounded bg-light">Upload Images</legend>

            <div class="row g-3">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <div class="col-md-4">
                        <label for="image<?= $i ?>" class="form-label">Image <?= $i ?><?= $i <= 4 ? ' <span class="required-star">*</span>' : '' ?></label>
                        <input class="form-control" type="file" id="image<?= $i ?>" name="image<?= $i ?>" accept="image/*" <?= $i <= 4 ? 'required' : '' ?> />
                    </div>
                <?php endfor; ?>
            </div>
        </fieldset>

        <!-- Accessories Section -->
        <fieldset class="border p-3 mb-4">
            <legend class="float-none w-auto px-2 small text-muted border rounded bg-light">ACCESSORIES</legend>

            <div class="row">
                <?php
                $accessories = [
                    'Air Conditioner', 'Power Steering', 'CD Player',
                    'Power Door Locks', 'Driver Airbag', 'Central Locking',
                    'AntiLock Braking System', 'Passenger Airbag', 'Crash Sensor',
                    'Brake Assist', 'Power Windows', 'Leather Seats'
                ];
                foreach ($accessories as $i => $acc):
                ?>
                    <?php if ($i % 3 === 0): ?><div class="col-md-3"><?php endif; ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="accessories[]" value="<?= $acc ?>" id="<?= strtolower(str_replace(' ', '', $acc)) ?>" />
                            <label class="form-check-label" for="<?= strtolower(str_replace(' ', '', $acc)) ?>"><?= $acc ?></label>
                        </div>
                    <?php if ($i % 3 === 2 || $i === count($accessories) - 1): ?></div><?php endif; ?>
                <?php endforeach; ?>
            </div>
        </fieldset>

        <!-- Buttons -->
        <div class="mb-4 d-flex gap-2">
            <button type="reset" class="btn btn-dark">Cancel</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
