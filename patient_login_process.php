<?php
include 'Hospital_db.php';
session_start();

// Timeout settings
$timeout = 900;

// Check if the user is already logged in
if (!isset($_SESSION['id'])) {
    header('Location: patient_login_form.php');
    exit;
}

// Check for session timeout
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
    session_destroy();
    header('Location: patient_login_form.php');
    exit;
}
// Update session activity timestamp
$_SESSION['last_activity'] = time();

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name=$_POST['name'];
    $email = $_POST['email'];
    $gender=$_POST['gender'];
    $password = $_POST['password'];
  

    // Query to fetch user by email
    $sql = "SELECT * FROM patient_db WHERE email = ? AND name=? AND gender=?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind the email parameter
        $stmt->bind_param("sss", $email,$name,$gender);

        // Execute the query
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if user exists
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['id'] = $user['id'];
                $_SESSION['name'] = $user['name'];

                // Redirect to the patient dashboard
                header('Location: patient_dashboard.php');
                exit;
            } else {
                echo "Invalid email or password.";
            }
        } else {
            echo "No account found with this email.";
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
