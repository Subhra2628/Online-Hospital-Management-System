<?php
include 'Hospital_db.php';
session_start();
$id=$_POST['id'];
if($_SERVER['REQUEST_METHOD']=='POST')
{
    $name=$_POST['name'];
    $email=$_POST['email'];
    $contact=$_POST['contact'];
    $specialization=$_POST['specialization'];
    $sql="UPDATE doctor_db SET name=?, email=?, contact=?, specialization=? WHERE id=?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("ssssi",$name,$email,$contact,$specialization,$id);
    if($stmt->execute())
    {
        header('Location:manage_doctors.php');
    }
    $stmt->close();
}