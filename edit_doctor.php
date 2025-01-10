<?php
include 'Hospital_db.php';
session_start();
$id=$_GET['id'];
$sql="SELECT * FROM doctor_db WHERE id=?";
$stmt=$conn->prepare($sql);
$stmt->bind_param("i",$id);
$stmt->execute();
$result = $stmt->get_result();
?>
<html>
    <head>
        <style>
     body
            {
                background-color:lightskyblue;
            }
         .add
         {
            padding: 80px;
            border-radius: 8px;
            background-size: cover;
            width:300px;
            margin: auto;
            margin-top: 100px;
            background-image: url('add_doctorr.jpg');
            background-repeat: no-repeat;
            background-position: center;
           
         }
         .add h1
         {
            text-align: center;
            margin-bottom: 50px;
            color:darkturquoise;
         }
         .add input[type=text],input[type=email]
         {
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
            opacity:0.8;
            width: 90%;
         }
         .add button {
    width: 95%;
    padding: 10px;
    background-color: #28a745; /* Green */
    color: white;
    border: none;
    border-radius: 5px;
    margin-top: 20px;
    cursor: pointer;
    opacity: 0.9;
}

.add button:hover {
    background-color: darkgreen;
    opacity: 1;
}
        </style>
        <form action="edit_doctor_process.php" method="POST" class="add">
        <h1>Edit Doctor</h1>
            <?php
            if ($result->num_rows > 0) {
                // Fetch the record
                $row = $result->fetch_assoc();
            ?>
             <input type="hidden" name="id" value="<?php echo $id; ?>">
                <label>Name</label><br>
                <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" placeholder="Name" required>
                <label>Email</label><br>
                <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" placeholder="Email" required>
                <label>Contact No</label><br>
                <input type="text" name="contact" value="<?php echo htmlspecialchars($row['contact']); ?>" placeholder="Contact" required>
                <label>Specialization</label><br>
                <input type="text" name="specialization" value="<?php echo htmlspecialchars($row['specialization']); ?>" placeholder="Specialization" required>
                <br>
                <button type="submit">Update Doctor</button>
                <?php
            } else {
                echo "<p>No doctor found with the given ID.</p>";
            }
            ?>
        </form>
    </head>
</html>