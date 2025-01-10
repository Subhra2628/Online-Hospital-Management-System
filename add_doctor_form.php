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
            font-family: 'Arial', sans-serif;
            background-color: lightskyblue;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .add {
            padding: 40px;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
            background-image: url('doctor_.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent background */
        }

        .add h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-size: 26px;
            font-weight: bold;
        }

        .add input[type="text"],
        .add input[type="email"],
        .add input[type="number"] {
            padding: 12px;
            margin: 12px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
            font-size: 16px;
            opacity: 0.9;
            transition: all 0.3s ease;
        }

        .add input[type="text"]:focus,
        .add input[type="email"]:focus,
        .add input[type="number"]:focus {
            border-color: #28a745;
            box-shadow: 0 0 10px rgba(40, 167, 69, 0.5);
            outline: none;
        }

        .add button {
            width: 100%;
            padding: 14px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            margin-top: 20px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
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
                padding: 30px;
                width: 80%;
            }
        }

        @media (max-width: 480px) {
            .add {
                width: 90%;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <form action="add_doctor_process.php" method="POST" class="add">
        <h1>Add New Doctor</h1>
        <input type="text" placeholder="Name" name="name" required><br>
        <input type="email" placeholder="Email" name="email" required><br>
        <input type="text" placeholder="Contact" name="contact" required><br>
        <input type="text" placeholder="Specialization" name="specialization" required><br>
        <button type="submit" name="login">Add Doctor</button>
    </form>
</body>
</html>
