<?php   
include 'Hospital_db.php';
session_start();
$timeout=900;
if(!isset($_SESSION['id']))
{
    header('Location:admin_login_form.php');
    exit;
}
if(isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $timeout))
{
   session_destroy();
   session_unset();
   header('Location:admin_login_form.php');
   exit;
}
else
{
    $_SESSION['last_activity'] = time();
}
$sql="SELECT * FROM doctor_db";
$stmt=$conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Doctors</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            background-image: url('doctor.jpg');
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
        .actions a:hover
        {
           color: darkorange
        }
        table {
            width: 100%;
            border-collapse: collapse;
           
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        table th {
            background:darkslategray;
            color: white;
        }
    </style>
</head>
<body>
    <h1>Manage Doctors</h1>
    <div class="container">
        <!-- Actions -->
        <div class="actions">
            <a href="add_doctor_form.php">Add New Doctor</a>
        </div>

        <!-- Doctors Table -->
        <table>
            <thead>
                <tr>
                    
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    
                    <th>Specialization</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $stmt->fetch_assoc()) { ?>
                <tr>
                 
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['contact']; ?></td>
                   
                    <td><?php echo $row['specialization']; ?></td>
                    <td>
                        <a href="edit_doctor.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <a href="delete_doctor.php?id=<?php echo $row['id']; ?>" 
                           onclick="return confirm('Are you sure you want to delete this doctor?');">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <p style="text-align: center"><a href="admin_dashboard.php">Back To Admin Dashboard</a></p>
</body>
</html>