<?php
include 'Hospital_db.php';
session_start();
$timeout=900;
if(!isset($_SESSION['id']))
{
    header('Location:admin_login_form.php');
    exit;
}
if(isset($_SESSION['last_activity']) &&  (time() - $_SESSION['last_activity'] > $timeout)) 
{
    session_unset();
    session_destroy();
    header('Location:admin_login_form.php');
    exit;
}
else
{
    $_SESSION['last_activity']=time();
}
if($_SERVER['REQUEST_METHOD']==='POST')
{
    $name=$_POST['name'];
    $specialization=$_POST['specialization'];
    $contact=$_POST['contact'];
    $email=$_POST['email'];

$sql="INSERT INTO doctor_db(name,specialization,contact,email)VALUES(?,?,?,?)";
$stmt=$conn->prepare($sql);
$stmt->bind_param("ssss",$name,$specialization,$contact,$email);
if($stmt->execute())
{
    echo"<p>Data Successfully added</p>";
}
else
{
    echo"<p>Error</> ";
}
$stmt->close();
}
?>
<html>
    <head>
        <style>
          p{
            text-align: center;
            color:limegreen;
          }
            </style>
    </head>
</html>