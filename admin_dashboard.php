<?php   
include 'Hospital_db.php';
session_start();
$timeout=900;
if(!isset($_SESSION['id']))
{
    header('Location:admin_login_form.php');
    exit;
}
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
    session_unset();
    session_destroy();
    header("Location: admin_login_form.php");
    exit;
} else {
    $_SESSION['last_activity'] = time(); // Update the last activity time
}

// Fetch total doctors
$doctor_count_query = "SELECT COUNT(*) AS total FROM doctor_db";
$doctor_result = $conn->query($doctor_count_query);
$doctor_count = $doctor_result->fetch_assoc()['total'];

// Fetch total patients
$patient_count_query = "SELECT COUNT(*) AS total FROM patient_db";
$patient_result = $conn->query($patient_count_query);
$patient_count = $patient_result->fetch_assoc()['total'];

// Fetch total appointments
$appointment_count_query = "SELECT COUNT(*) AS total FROM appointment_db";
$appointment_result = $conn->query($appointment_count_query);
$appointment_count = $appointment_result->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <style>

    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-image: url("admindashb.jpg");
    background-repeat: no-repeat;
    background-size: cover;
}
h1 {
    text-align: center;
    margin: 20px 0;
    color:blue;
}
.dashboard {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 30px;
}
.card {
    background-color:darkgrey;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    text-align: center;
    opacity:0.8;
}
nav ul {
    list-style-type: none;
    margin: 0;
    padding: 10px;
    background: #333;
    display: flex;
    justify-content: center;
    background-color: cadetblue;
}
nav ul li {
    margin: 0 10px;
}
nav ul li a {
    text-decoration: none;
    color: white;
    padding: 5px 10px;
    transition: background 0.3s;
}
nav ul li a:hover {
    background: #555;
    color:aqua
}
nav ul li a.logout:hover {
 background-color:red;
}
</style>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <nav>
    <ul>
        <li><a href="manage_doctors.php">Manage Doctors</a></li>
        <li><a href="manage_patients.php">Manage Patients</a></li>
        <li><a href="manage_appointments.php">Manage Appointments</a></li>
        <li ><a href="logout.php" class="logout">Logout</a></li>
    </ul>
</nav>
    <div class="dashboard">
        <div class="card">
            <h2>Total Doctors</h2>
            <p><?php echo $doctor_count; ?></p>
        </div>
        <div class="card">
            <h2>Total Patients</h2>
            <p><?php echo $patient_count; ?></p>
        </div>
        <div class="card">
            <h2>Total Appointments</h2>
            <p><?php echo $appointment_count; ?></p>
        </div>
    </div>
   

</body>
</html>

