<?php
include 'Hospital_db.php';
session_start();

// Ensure patient is logged in
if (!isset($_SESSION['id'])) {
    header('Location: patient_login_form.php'); // Redirect to login if not logged in
    exit;
}

$patient_id = $_SESSION['id']; // Get patient ID from session

// Fetch patient details based on patient_id
$sql_patient = "SELECT * FROM patient_db WHERE id = ?";
$stmt_patient = $conn->prepare($sql_patient);
$stmt_patient->bind_param("i", $patient_id);
$stmt_patient->execute();
$result_patient = $stmt_patient->get_result();
$patient_details = $result_patient->fetch_assoc();

// Fetch appointment details for the logged-in patient
$sql_appointment = "SELECT appointment_db.id, appointment_db.appointment_date, appointment_db.appointment_time, 
                            doctor_db.name AS doctor_name
                     FROM appointment_db
                     JOIN doctor_db ON appointment_db.doctor_id = doctor_db.id
                     WHERE appointment_db.patient_id = ? 
                     ORDER BY appointment_db.appointment_date
                     LIMIT 1";

$stmt_appointment = $conn->prepare($sql_appointment);
$stmt_appointment->bind_param("i", $patient_id); // Bind the patient ID
$stmt_appointment->execute();
$result_appointment = $stmt_appointment->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard</title>
    <style>
        /* General Page Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
    margin: 0;
    padding: 0;
    background-image: url('appointment.jpg');
            background-repeat: no-repeat;
            background-size: cover;
}
nav ul {
    list-style: none;
    padding: 0;
    background-color: #333;
    display: flex;
    justify-content: center;
}

nav ul li {
    margin: 10px;
}

nav ul li a {
    color: white;
    text-decoration: none;
    padding: 14px 20px;
    display: block;
}

nav ul li a:hover, nav ul li a.active {
    background-color: #575757;
}
.dashboard-container {
    max-width: 900px;
    margin: 50px auto;
    background-color: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    opacity: 0.7;
}

h1 {
    font-size: 28px;
    color: #333;
    text-align: center;
    margin-bottom: 20px;
}

h2 {
    font-size: 22px;
    color: #333;
    margin-bottom: 15px;
}

/* Details Section Styles */
.details-section, .appointment-section {
    margin-bottom: 30px;
}

.details-section p, .appointment-section p {
    font-size: 16px;
    line-height: 1.6;
    color: #555;
}

.details-section p strong, .appointment-section p strong {
    color: #333;
}

/* Appointment Section Styles */
.appointment-time {
    font-weight: bold;
    color: #007bff;
}

/* Button Styles */
.button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    font-size: 16px;
    text-align: center;
    transition: background-color 0.3s ease;
}

.button:hover {
    background-color: #0056b3;
}

/* Layout Styles */
.details-section, .appointment-section {
    padding: 15px;
    background-color: #f9f9f9;
    border-radius: 6px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.details-section {
    margin-bottom: 20px;
}

.appointment-section {
    margin-bottom: 30px;
}

/* Media Queries for Responsive Design */
@media screen and (max-width: 768px) {
    .dashboard-container {
        padding: 20px;
    }

    h1 {
        font-size: 24px;
    }

    h2 {
        font-size: 20px;
    }

    .details-section p, .appointment-section p {
        font-size: 14px;
    }

    .button {
        font-size: 14px;
        padding: 8px 16px;
    }
}

    </style>
</head>
<body>
<nav>
        <ul>
            <li><a href="index_page.html">Home</a></li>
            <li><a href="about.php" >About Us</a></li>
            
        </ul>
    </nav>

<div class="dashboard-container">
    <h1>Welcome, <?php echo $patient_details['name']; ?>!</h1>

    <div class="details-section">
        <h2>Your Details</h2>
        <p><strong>Name:</strong> <?php echo $patient_details['name']; ?></p>
        <p><strong>Email:</strong> <?php echo $patient_details['email']; ?></p>
        <p><strong>Age:</strong> <?php echo $patient_details['age']; ?></p>
        <p><strong>Gender:</strong> <?php echo $patient_details['gender']; ?></p>
    </div>

    <div class="appointment-section">
        <h2>Your Next Appointment</h2>
        <?php if ($result_appointment->num_rows > 0) { // Check if appointment exists ?>
    <?php $appointment_details = $result_appointment->fetch_assoc(); ?>
    <p><strong>Doctor:</strong> <?php echo $appointment_details['doctor_name']; ?></p>
    <p><strong>Appointment Date:</strong> <?php echo $appointment_details['appointment_date']; ?></p>
    <p><strong>Appointment Time:</strong> <span class="appointment-time"><?php echo $appointment_details['appointment_time']; ?></span></p>
<?php } else { // If no appointment is found ?>
    <p>You do not have any upcoming appointments scheduled.</p>
<?php } ?>

    </div>

    <a href="patient_edit_profile.php" class="button">Edit Profile</a>
</div>

</body>
</html>
