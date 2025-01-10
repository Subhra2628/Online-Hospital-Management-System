<?php
include 'Hospital_db.php';
session_start();
$id=$_GET['id'];
$sql="DELETE FROM patient_db WHERE id=?";
$stmt=$conn->prepare($sql);
$stmt->bind_param("i",$id);
if($stmt->execute())
{
   header('Location:manage_patients.php');
   exit;
}
$stmt->close();
?>