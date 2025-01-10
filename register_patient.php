<?php
// User registration page
include 'Hospital_db.php';

$success = ""; // Variable to hold success message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $description=$_POST['description'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO patient_db (name, age, gender, contact, email,medical_history, password) VALUES (?, ?, ?, ?, ?, ?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisssss", $name, $age, $gender, $contact, $email,$description ,$password);

    if ($stmt->execute()) {
        $success = "Registration completed successfully!";
    } else {
        $error = "Error during registration!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            background-image: url("registerpic.jpg");
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            background-color: #333;
        }

        nav ul li {
            margin: 0;
        }

        nav ul li a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 14px 20px;
            transition: background 0.3s ease;
        }

        nav ul li a:hover, nav ul li a.active {
            background-color: #575757;
        }

        .container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 50px auto;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        label {
            display: block;
            font-size: 14px;
            color: #555;
            margin-bottom: 8px;
        }

        input, select, textarea,button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input:focus, select:focus {
            border-color: #4CAF50;
            outline: none;
        }

        button {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        .success {
            color: green;
            text-align: center;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .error {
            color: red;
            text-align: center;
            font-size: 16px;
            margin-bottom: 20px;
        }

        @media (max-width: 600px) {
            body {
                padding: 10px;
            }

            nav ul {
                flex-direction: column;
            }

            nav ul li a {
                text-align: center;
            }

            .container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="index_page.html" >Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="services.php" >Services</a></li>
            <li><a href="patient_login_form.php">Login</a></li>
            <li><a href="register_patient.php" class="active">Register</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1>Register</h1>

        <?php if (!empty($success)) { echo "<p class='success'>$success</p>"; } ?>
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>

        <form method="POST" action="register_patient.php">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>

            <label for="age">Age</label>
            <input type="number" id="age" name="age" required>

            <label for="gender">Gender</label>
            <select id="gender" name="gender" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
            <label>Disease</label>
            <textarea id="description" name="description" rows="5" cols="40" required></textarea><br><br>
            <label for="contact">Contact</label>
            <input type="text" id="contact" name="contact" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
