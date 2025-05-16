<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Basic Info
    $title = $_POST['vehicle_title'];
    $brand = $_POST['brand'];
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
        if (!empty($_FILES[$imageKey]['name'])) {
            $fileTmp = $_FILES[$imageKey]['tmp_name'];
            $fileName = basename($_FILES[$imageKey]['name']);
            $targetDir = "uploads/";
            $newName = uniqid("img_", true) . "_" . $fileName;
            $targetFilePath = $targetDir . $newName;
            move_uploaded_file($fileTmp, $targetFilePath);
            $uploadedImages[$i] = $newName;
        } else {
            $uploadedImages[$i] = null;
        }
    }

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

    $stmt->bind_param(
        "sisdsiissssiiiiiiiiiiii",
        $title, $brand, $overview, $price, $fuel, $modelYear, $seating,
        $uploadedImages[1], $uploadedImages[2], $uploadedImages[3], $uploadedImages[4], $uploadedImages[5],
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
?>
