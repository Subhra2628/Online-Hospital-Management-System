<?php
$servername="localhost";
$username="root";
$password="";
$conn=new mysqli($servername,$username,$password);
$database="CREATE DATABASE IF NOT EXISTS hospital_db";
if($conn->query($database)===TRUE)
{
   // echo"database created";
}
if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->select_db('hospital_db');

$admin="CREATE TABLE IF NOT EXISTS admin_db(id int AUTO_INCREMENT primary key,
email VARCHAR(255),
password VARCHAR(255))";
if($conn->query($admin)===TRUE)
{
    //echo"admin created";
}

$Doctor="CREATE TABLE IF NOT EXISTS doctor_db(
id int Primary key AUTO_INCREMENT, 
name VARCHAR(255),
specialization VARCHAR(255),
contact VARCHAR(100),
password VARCHAR(255))";
if($conn->query($Doctor)===TRUE)
{
    //echo"doctor create";
}
$checkColumn = "SHOW COLUMNS FROM doctor_db LIKE 'email'";
$result = $conn->query($checkColumn);

if ($result->num_rows === 0) { // If the 'email' column does not exist
    $sql = "ALTER TABLE doctor_db ADD email VARCHAR(255)";
    if ($conn->query($sql) === TRUE) {
       // echo "Column 'email' added successfully!";
    } else {
        echo "Error altering table: " . $conn->error;
    }
} else {
    //echo "Column 'email' already exists!";
}

$Patient="CREATE TABLE IF NOT EXISTS patient_db(
id int primary key AUTO_INCREMENT,
name VARCHAR(255),
age int,
gender ENUM('male', 'female', 'other'),
contact VARCHAR(100),
email VARCHAR(255),
password VARCHAR(255),
medical_history TEXT)";
if($conn->query($Patient)===TRUE)
{
   // echo"Patient create";
}
$column_name = 'medical_history';
$table_name = 'patient_db';
$query = "SHOW COLUMNS FROM $table_name LIKE '$column_name'";

$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
   // echo "Column '$column_name' exists in the table '$table_name'.";
} else {
   // echo "Column '$column_name' does not exist in the table '$table_name'.";
}
if ($result->num_rows === 0) {
    $alter_query = "ALTER TABLE $table_name ADD COLUMN medical_history TEXT";
    if ($conn->query($alter_query) === TRUE) {
       // echo "Column 'medical_history' added successfully.";
    } else {
        //echo "Error adding column: " . $conn->error;
    }
}


$Appointment="CREATE TABLE IF NOT EXISTS appointment_db(
id int primary key AUTO_INCREMENT,
appointment_date DATE,
appointment_time TIME,
patient_id int,
doctor_id int,
FOREIGN KEY(patient_id) REFERENCES patient_db(id),
FOREIGN KEY(doctor_id) REFERENCES doctor_db(id),
status ENUM('pending', 'approved', 'canceled'))
";
if($conn->query($Appointment)===TRUE)
{
   // echo"create";
}
else{
    die ($conn->error);
}

$Medical_records="CREATE TABLE IF NOT EXISTS medical_records_db(
id int primary key AUTO_INCREMENT,
diagnosis TEXT,
test_result TEXT,
prescription TEXT,
medical_date DATE,
patient_id int,
doctor_id int,
FOREIGN KEY(patient_id) REFERENCES patient_db (id),
FOREIGN KEY(doctor_id) REFERENCES doctor_db(id))";
if($conn->query($Medical_records)===TRUE)
{
    //echo"create";
}

$admin_email="admin@gmail.com";
$pass="admin@123";
$password= password_hash($pass,PASSWORD_DEFAULT);
$sql="INSERT INTO admin_db(email,password) VALUES(?,?)";
$stmt=$conn->prepare($sql);
$stmt->bind_param("ss",$admin_email,$password);
if($stmt->execute())
{
    //echo"admin";
}