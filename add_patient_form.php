<?php
include 'Hospital_db.php';
session_start();
$timeout = 900;
if (!isset($_SESSION['id'])) {
    header('Location:admin_login_form.php');
    exit;
}
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
    session_unset();
    session_destroy();
    header('Location:admin_login_form.php');
    exit;
}
?>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: lightskyblue;
            margin: 0;
            padding: 0;
        }

        .add {
            padding: 40px;
            border-radius: 8px;
            background-size: cover;
            width: 90%; /* Set width to 90% for flexible design */
            max-width: 400px; /* Max width to prevent it from being too wide on large screens */
            margin: auto;
            margin-top: 100px;
            background-image: url('patient_image.jpg');
            background-repeat: no-repeat;
            background-position: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-color: rgba(255, 255, 255, 0.8); /* Added transparency */
        }

        .add h1 {
            text-align: center;
            margin-bottom: 20px;
            color: darkturquoise;
            font-size: 24px;
            font-weight: bold;
        }

        .add input[type="text"],
        .add input[type="email"],
        .add input[type="number"],
        .add select {
            padding: 12px;
            margin: 12px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            opacity: 0.9;
            width: 100%;
            box-sizing: border-box;
            font-size: 14px;
        }

        .add select {
            height: 40px;
        }

        .add button {
            width: 100%;
            padding: 14px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            margin-top: 20px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease, transform 0.2s;
        }

        .add button:hover {
            background-color: darkgreen;
            transform: scale(1.05);
        }

        .add button:active {
            transform: scale(1.02);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .add {
                width: 80%;
                margin-top: 50px; /* Reduce top margin for smaller screens */
            }
        }

        @media (max-width: 480px) {
            .add {
                width: 95%;
                margin-top: 30px; /* Reduce top margin even more for very small screens */
            }
        }
    </style>
</head>
<body>
    <form action="add_patient_process.php" method="POST" class="add">
        <h1>Add New Patient</h1>
        <input type="text" placeholder="Name" name="name" required><br>
        <input type="email" placeholder="Email" name="email" required><br>
        <select name="gender" required>
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>
        <input type="text" placeholder="Contact" name="contact" required><br>
        <input type="number" placeholder="Age" name="age" required><br>
        <button type="submit" name="login">Add Patient</button>
    </form>
</body>
</html>
