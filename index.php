<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin-top: 50px;
        }

        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
        }

        h1 {
            font-size: 30px;
            margin-bottom: 20px;
        }

        .button {
            padding: 15px 30px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            border-radius: 5px;
            margin: 10px;
            display: inline-block;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .button-container {
            margin-top: 30px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Welcome to the Hospital Management System</h1>
        <div class="button-container">
            <!-- Admin Login Link -->
            <a href="admin_login_form.php" class="button">Admin Login</a>
            <!-- Patient Show Page Link -->
            <a href="index_page.html" class="button">Patient Dashboard</a>
        </div>
    </div>

</body>
</html>
