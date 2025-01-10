<?php
include 'Hospital_db.php';
session_start();
$timeout = 900;

// Check if admin is logged in
if (!isset($_SESSION['id'])) {
    header('Location: admin_login_form.php');
    exit;
}

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
    session_destroy();
    session_unset();
    header('Location: admin_login_form.php');
    exit;
} else {
    $_SESSION['last_activity'] = time();
}

// Fetch patients and doctors for the dropdowns
$patients = $conn->query("SELECT id, name FROM patient_db");
$doctors = $conn->query("SELECT id, name FROM doctor_db");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Appointment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            background-image: url('appointment.jpg');
            background-size: cover;
        }
        .container {
            width: 800px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            opacity: 0.6;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        form input, form select, form button {
            width: 100%;
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        form input[type=date],input[type=time]
        {
            width: 96%;
        }
        form button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add Appointment</h1>
        <form method="POST" action="add_appointment_process.php">
            <label for="appointment_date">Appointment Date:</label>
            <input type="date" name="appointment_date" required>

            <label for="appointment_time">Appointment Time:</label>
            <input type="time" name="appointment_time" required>

            <label for="patient_id">Patient:</label>
            <select name="patient_id" required>
                <option value="">Select Patient</option>
                <?php while ($patient = $patients->fetch_assoc()) { ?>
                    <option value="<?php echo $patient['id']; ?>">
                        <?php echo $patient['name']; ?>
                    </option>
                <?php } ?>
            </select>

            <label for="doctor_id">Doctor:</label>
            <select name="doctor_id" required>
                <option value="">Select Doctor</option>
                <?php while ($doctor = $doctors->fetch_assoc()) { ?>
                    <option value="<?php echo $doctor['id']; ?>">
                        <?php echo $doctor['name']; ?>
                    </option>
                <?php } ?>
            </select>

            <label for="status">Status:</label>
            <select name="status" required>
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="canceled">Canceled</option>
            </select>

            <button type="submit">Add Appointment</button>
        </form>
    </div>
</body>
</html>
