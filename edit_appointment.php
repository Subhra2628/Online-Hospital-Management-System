<?php
include 'Hospital_db.php';
session_start();
$id = $_GET['id'];

$sql = "SELECT * FROM appointment_db WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$appointment = $stmt->get_result();
?>
<html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f9;
                margin: 0;
                padding: 0;
                background-image: url("appointment.jpg") !important; /* Ensure the image is loaded */
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center;
            }
   
            h1 {
                text-align: center;
                margin-bottom: 20px;
            }
            form input, form select, form button {
                width: 100% !important;
                margin: 10px 0 !important;
                padding: 10px !important;
                border: 1px solid #ccc !important;
                border-radius: 5px !important;
            }
            form button {
                background-color: #007bff !important;
                color: white !important;
                border: none !important;
                cursor: pointer;
            }
            form button:hover {
                background-color: #0056b3 !important;
            }
            form .add{
                width: 40% !important;
                margin: 100px auto;
                background: rgba(255, 255, 255, 0.8) !important;
                padding: 30px !important;
                border-radius: 8px !important;
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2) !important;
            }
        </style>
    </head>
    <body>
        <div class="add">
            <form action="update_appointment.php" method="POST">
                <h1>Edit Appointment Details</h1>
                <?php
                if ($appointment->num_rows > 0) {
                    $result = $appointment->fetch_assoc();
                ?>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <label for="appointment_date">Appointment Date:</label>
                    <input type="date" name="date" value="<?php echo htmlspecialchars($result['appointment_date']); ?>" required>
                    <label for="appointment_time">Appointment Time:</label>
                    <input type="time" name="time" value="<?php echo $result['appointment_time']; ?>" required>
                    <label for="status">Status:</label>
                    <select name="status" required>
                        <option value="pending" <?php echo ($result['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                        <option value="approved" <?php echo ($result['status'] == 'approved') ? 'selected' : ''; ?>>Approved</option>
                        <option value="canceled" <?php echo ($result['status'] == 'canceled') ? 'selected' : ''; ?>>Canceled</option>
                    </select>
                    <button type="submit">Update Appointment</button>
                <?php
                } else {
                    echo "<p>Appointment not found!</p>";
                }
                ?>
            </form>
        </div>
    </body>
</html>
