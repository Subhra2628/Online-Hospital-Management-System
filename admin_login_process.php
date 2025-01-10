<?php
ini_set('display_errors', 1); // Enable error display
error_reporting(E_ALL);     
include 'Hospital_db.php';
session_start();
if($_SERVER['REQUEST_METHOD']==='POST')
{
    $email=$_POST['email'];
    $password=$_POST['password'];
    $sql="SELECT * FROM admin_db WHERE email=?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("s",$email);
    $stmt->execute();
   $result= $stmt->get_result()->fetch_assoc();
    
        if (!$result)
         {
            echo "Invalid email or password.";
            exit;
        }
        if($result)
    {
        $pass=$result['password'];
        if(PASSWORD_VERIFY( $password, $pass))
        {
                $_SESSION['id']=$result['id'];
                $_SESSION['email']=$result['email'];
                $_SESSION['last_activity']=time();
                header('Location:admin_dashboard.php');
        }
        else
        {
           echo"<p class='text'>Please Verify Your Email or Password</p>";
        }
    }
    $stmt->close();
}
?>
<html>
    <head>
        <style>
            .text{
                text-align: center;
                color:red;
                margin-top:300px;
                margin-bottom: 300px;
                margin-left: 300px;
                margin-right: 300px;
            }
        </style>
    </head>
</html>