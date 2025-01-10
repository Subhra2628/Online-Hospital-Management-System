<?php
include 'Hospital_db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $patient_id = $_POST['patient_id'];
    $doctor_id = $_POST['doctor_id'];
    $status = $_POST['status'];

    $sql = "INSERT INTO appointment_db (appointment_date, appointment_time, patient_id, doctor_id, status)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssds", $appointment_date, $appointment_time, $patient_id, $doctor_id, $status);

    if ($stmt->execute()) {
        header("Location: manage_appointments.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
