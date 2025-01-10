<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Login</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #6dd5ed, #2193b0);
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-image: url("registerpic.jpg");
        }

        /* Navigation Bar */
        nav {
            background-color: #333;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        nav ul li {
            margin: 0;
        }

        nav ul li a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 14px 20px;
            font-size: 16px;
            font-weight: 500;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        nav ul li a:hover,
        nav ul li a.active {
            background-color: #575757;
            color: #e0e0e0;
        }

        /* Responsive Menu */
        @media (max-width: 768px) {
            nav ul {
                flex-direction: column;
                align-items: center;
            }

            nav ul li a {
                width: 100%;
                text-align: center;
            }
        }

        /* Main Container */
        .container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .form-container {
            background: #ffffff;
            padding: 40px 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .form-container h1 {
            margin-bottom: 30px;
            font-size: 24px;
            color: #333;
        }

        .form-container input,
        .form-container select {
            width: 90%;
            padding: 12px 15px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        .form-container input:focus,
        .form-container select:focus {
            border-color: #2193b0;
            outline: none;
        }

        .form-container button {
            width: 92%;
            padding: 14px;
            background-color: #2193b0;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        .form-container button:hover {
            background-color: #17699e;
            transform: scale(1.02);
        }

        .form-container button:active {
            transform: scale(1);
        }

        .form-container p {
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }

        .form-container p a {
            color: #2193b0;
            text-decoration: none;
            font-weight: bold;
        }

        .form-container p a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .form-container {
                padding: 30px 20px;
            }

            .form-container h1 {
                font-size: 20px;
            }

            .form-container button {
                font-size: 14px;
            }
        }

        /* Footer */
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            font-size: 14px;
        }

        footer a {
            color: #2193b0;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav aria-label="Main Navigation">
        <ul>
            <li><a href="index_page.html">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="patient_login_form.php" class="active">Login</a></li>
            <li><a href="register_patient.php">Register</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <div class="form-container">
            <h1>Patient Login</h1>
            <form action="patient_login_process.php" method="POST">
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <select name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="login">Log In</button>
            </form>
            <p>Don't have an account? <a href="register_patient.php">Register</a></p>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Hospital Management System. Designed with ❤️ by <a href="#">Subhradip Ghosh</a>.</p>
    </footer>
</body>
</html>
