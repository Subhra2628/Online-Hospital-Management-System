<?php
include 'Hospital_db.php';
session_start();
$timeout = 900;

// Session validation
if (!isset($_SESSION['id'])) {
    header('Location:admin_login_form.php');
    exit;
}
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout)) {
    session_destroy();
    session_unset();
    header('Location:admin_login_form.php');
    exit;
} else {
    $_SESSION['last_activity'] = time();
}

// Handle search query
$search = isset($_GET['search']) ? trim($_GET['search']) : "";

// Fetch appointments with patient and doctor names
$sql = "
    SELECT 
        appointment_db.id AS appointment_id, 
        appointment_db.appointment_date, 
        appointment_db.appointment_time, 
        appointment_db.status, 
        patient_db.name AS patient_name, 
        doctor_db.name AS doctor_name
    FROM 
        appointment_db
    JOIN 
        patient_db ON appointment_db.patient_id = patient_db.id
    JOIN 
        doctor_db ON appointment_db.doctor_id = doctor_db.id
    WHERE 
        patient_db.name LIKE ? 
        OR doctor_db.name LIKE ? 
        OR appointment_db.appointment_date LIKE ?
";
$stmt = $conn->prepare($sql);
$search_param = "%" . $search . "%";
$stmt->bind_param("sss", $search_param, $search_param, $search_param);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Appointments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            background-image: url('appointment.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            opacity: 0.6;
        }
        .actions {
            margin-bottom: 15px;
            text-align: right;
        }
        .actions a {
            text-decoration: none;
            padding: 10px 15px;
            color: white;
            background-color: #007bff;
            border-radius: 5px;
        }
        .actions a:hover {
            color: darkorange;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        table th {
            background-color: darkslategray;
            color: white;
        }
        .search-bar {
            margin: 20px;
            text-align: center;
        }
        .search-bar input[type="text"] {
            padding: 8px;
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .search-bar button {
            padding: 8px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .search-bar button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Manage Appointments</h1>
    <div class="container">
        <!-- Actions -->
        <div class="actions">
            <a href="add_appointment_form.php">Add New Appointment</a>
        </div>

        <!-- Search Bar -->
        <div class="search-bar">
            <form method="GET" action="manage_appointments.php">
                <input type="text" name="search" placeholder="Search by Patient, Doctor, or Date"
                       value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit">Search</button>
            </form>
        </div>

        <!-- Appointments Table -->
        <table>
            <thead>
                <tr>
                  
                    <th>Patient Name</th>
                    <th>Doctor Name</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                           
                            <td><?php echo $row['patient_name']; ?></td>
                            <td><?php echo $row['doctor_name']; ?></td>
                            <td><?php echo $row['appointment_date']; ?></td>
                            <td><?php echo $row['appointment_time']; ?></td>
                            <td><?php echo ucfirst($row['status']); ?></td>
                            <td>
                                <a href="edit_appointment.php?id=<?php echo $row['appointment_id']; ?>">Edit</a>
                                <a href="delete_appointment.php?id=<?php echo $row['appointment_id']; ?>"
                                   onclick="return confirm('Are you sure you want to delete this appointment?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No appointments found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <p style="text-align: center"><a href="admin_dashboard.php">Back To Admin Dashboard</a></p>
</body>
</html>
