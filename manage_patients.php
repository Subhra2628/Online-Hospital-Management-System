<?php
include 'Hospital_db.php';
session_start();

// Session timeout logic
$timeout = 900; // Set timeout to 15 minutes
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


$search = isset($_GET['search']) ? trim($_GET['search']) : "";

// Prepare the SQL query based on the search input
if ($search) {
    $sql = "SELECT * FROM patient_db WHERE name LIKE ? OR email LIKE ? OR medical_history LIKE ?";
    $stmt = $conn->prepare($sql);
    $search_param = "%" . $search . "%"; 
    $stmt->bind_param("sss", $search_param, $search_param, $search_param);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // If no search term, get all patients
    $sql = "SELECT * FROM patient_db";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Patients</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 0;
    background-image: url('patient_image.jpg');
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
    opacity: 0.7;
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

table th,
table td {
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
    <h1>Manage Patients</h1>
    <div class="container">
        <!-- Actions -->
        <div class="actions">
            <a href="add_patient_form.php">Add New Patient</a>
        </div>

        <!-- Search Form -->
        <div class="search-bar">
            <form method="GET" action="manage_patients.php">
                <input type="text" name="search" placeholder="Search by Name, Email, or Medical History"
                    value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit">Search</button>
            </form>
        </div>

        <!-- Patient Table -->
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>disease</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0) { ?>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['age']; ?></td>
                            <td><?php echo $row['gender']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['medical_history']; ?></td>
                            <td>
                                <a href="edit_patient.php?id=<?php echo $row['id']; ?>">Edit</a>
                                <a href="delete_patient.php?id=<?php echo $row['id']; ?>"
                                   onclick="return confirm('Are you sure you want to delete this patient?');">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="6">No results found for "<?php echo htmlspecialchars($search); ?>"</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <p style="text-align: center"><a href="admin_dashboard.php">Back To Admin Dashboard</a></p>
</body>
</html>
