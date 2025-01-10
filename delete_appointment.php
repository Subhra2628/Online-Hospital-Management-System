<?php
include 'Hospital_db.php';
session_start();
$id=$_GET['id'];
$sql="DELETE FROM appointment_db WHERE id=?";
$stmt=$conn->prepare($sql);
$stmt->bind_param("i",$id);
if($stmt->execute())
{
    header('Location:manage_appointments.php');
    exit;
}
$stmt->close();
?>