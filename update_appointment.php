<?php   
include 'Hospital_db.php';
session_start();
$id=$_POST['id'];
$date=$_POST['date'];
$time=$_POST['time'];
$status=$_POST['status'];

$sql="UPDATE appointment_db SET appointment_date=?, appointment_time=?, status=?  WHERE id=?";
$stmt=$conn->prepare($sql);
$stmt->bind_param("sssi",$date,$time,$status,$id);
if($stmt->execute())
{
    header('Location:manage_appointments.php');
    exit;

}
$stmt->close();
?>