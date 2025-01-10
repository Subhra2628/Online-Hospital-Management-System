<?php
include 'Hospital_db.php';
session_start();
$timeout=900;
if(!isset($_SESSION['id']))
{
    header('Location:admin_login_form.php');
    exit;
}
if(isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout))
{   
    header('Location:admin_login_form.php');
    exit   ;

}
if($_SERVER['REQUEST_METHOD']=='POST')
{
    $name=$_POST['name'];
    $email=$_POST['email'];
    $gender=$_POST['gender'];
    $contact=$_POST['contact'];
    $age=$_POST['age'];

    $sql="INSERT INTO patient_db(name,email,gender,contact,age)VALUES(?,?,?,?,?)";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("ssssi",$name,$email,$gender,$contact,$age);
    if($stmt->execute())
    {
        header('Location:manage_patients.php');
        exit;
    }
    $stmt->close();
}