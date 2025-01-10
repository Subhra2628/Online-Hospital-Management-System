<?php
include 'Hospital_db.php';
session_start();
$id = $_GET['id']; // Get the doctor ID from the URL

// First, delete all appointments associated with the doctor
$sql = "DELETE FROM appointment_db WHERE doctor_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);  // Bind the doctor ID
$stmt->execute();

// Now, delete the doctor from the doctor_db table
$sql = "DELETE FROM doctor_db WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);  // Bind the doctor ID
if ($stmt->execute()) {
    header('Location: manage_doctors.php');
    exit;
}

$stmt->close();
?>
