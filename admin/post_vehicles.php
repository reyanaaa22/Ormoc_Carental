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

    <form action="submit_vehicle.php" method="post" enctype="multipart/form-data">  
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
                        <option value="brand1">Brand 1</option>  
                        <option value="brand2">Brand 2</option>  
                        <option value="brand3">Brand 3</option>  
                        <!-- Add more options dynamically if needed -->  
                    </select>  
                </div>  
            </div>  

            <div class="mb-3">  
                <label for="vehicleOverview" class="form-label">Vehical Overview<span class="required-star">*</span></label>  
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
                        <!-- Add other fuel types if needed -->  
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
                <div class="col-md-4">  
                    <label for="image1" class="form-label">Image 1 <span class="required-star">*</span></label>  
                    <input class="form-control" type="file" id="image1" name="image1" accept="image/*" required />  
                </div>  
                <div class="col-md-4">  
                    <label for="image2" class="form-label">Image 2 <span class="required-star">*</span></label>  
                    <input class="form-control" type="file" id="image2" name="image2" accept="image/*" required />  
                </div>  
                <div class="col-md-4">  
                    <label for="image3" class="form-label">Image 3 <span class="required-star">*</span></label>  
                    <input class="form-control" type="file" id="image3" name="image3" accept="image/*" required />  
                </div>  

                <div class="col-md-4">  
                    <label for="image4" class="form-label">Image 4 <span class="required-star">*</span></label>  
                    <input class="form-control" type="file" id="image4" name="image4" accept="image/*" required />  
                </div>  
                <div class="col-md-4">  
                    <label for="image5" class="form-label">Image 5</label>  
                    <input class="form-control" type="file" id="image5" name="image5" accept="image/*" />  
                </div>  
            </div>  
        </fieldset>  

        <!-- Accessories Section -->  
        <fieldset class="border p-3 mb-4">  
            <legend class="float-none w-auto px-2 small text-muted border rounded bg-light">ACCESSORIES</legend>  
            
            <div class="row">  
                <div class="col-md-3">  
                    <div class="form-check">  
                        <input class="form-check-input" type="checkbox" name="accessories[]" value="Air Conditioner" id="ac" />  
                        <label class="form-check-label" for="ac">Air Conditioner</label>  
                    </div>  
                    <div class="form-check">  
                        <input class="form-check-input" type="checkbox" name="accessories[]" value="Power Steering" id="powerSteering" />  
                        <label class="form-check-label" for="powerSteering">Power Steering</label>  
                    </div>  
                    <div class="form-check">  
                        <input class="form-check-input" type="checkbox" name="accessories[]" value="CD Player" id="cdPlayer" />  
                        <label class="form-check-label" for="cdPlayer">CD Player</label>  
                    </div>  
                </div>  

                <div class="col-md-3">  
                    <div class="form-check">  
                        <input class="form-check-input" type="checkbox" name="accessories[]" value="Power Door Locks" id="powerDoorLocks" />  
                        <label class="form-check-label" for="powerDoorLocks">Power Door Locks</label>  
                    </div>  
                    <div class="form-check">  
                        <input class="form-check-input" type="checkbox" name="accessories[]" value="Driver Airbag" id="driverAirbag" />  
                        <label class="form-check-label" for="driverAirbag">Driver Airbag</label>  
                    </div>  
                    <div class="form-check">  
                        <input class="form-check-input" type="checkbox" name="accessories[]" value="Central Locking" id="centralLocking" />  
                        <label class="form-check-label" for="centralLocking">Central Locking</label>  
                    </div>  
                </div>  

                <div class="col-md-3">  
                    <div class="form-check">  
                        <input class="form-check-input" type="checkbox" name="accessories[]" value="AntiLock Braking System" id="abs" />  
                        <label class="form-check-label" for="abs">AntiLock Braking System</label>  
                    </div>  
                    <div class="form-check">  
                        <input class="form-check-input" type="checkbox" name="accessories[]" value="Passenger Airbag" id="passengerAirbag" />  
                        <label class="form-check-label" for="passengerAirbag">Passenger Airbag</label>  
                    </div>  
                    <div class="form-check">  
                        <input class="form-check-input" type="checkbox" name="accessories[]" value="Crash Sensor" id="crashSensor" />  
                        <label class="form-check-label" for="crashSensor">Crash Sensor</label>  
                    </div>  
                </div>  

                <div class="col-md-3">  
                    <div class="form-check">  
                        <input class="form-check-input" type="checkbox" name="accessories[]" value="Brake Assist" id="brakeAssist" />  
                        <label class="form-check-label" for="brakeAssist">Brake Assist</label>  
                    </div>  
                    <div class="form-check">  
                        <input class="form-check-input" type="checkbox" name="accessories[]" value="Power Windows" id="powerWindows" />  
                        <label class="form-check-label" for="powerWindows">Power Windows</label>  
                    </div>  
                    <div class="form-check">  
                        <input class="form-check-input" type="checkbox" name="accessories[]" value="Leather Seats" id="leatherSeats" />  
                        <label class="form-check-label" for="leatherSeats">Leather Seats</label>  
                    </div>  
                </div>  
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