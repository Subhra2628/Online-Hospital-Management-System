<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:rgb(226, 217, 217);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color:#d0e8f2;
           
        }

        .login-form {
            background-color: white;
            padding: 70px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 350px;
            background-image: url("best.jpg");
          
        }

        .login-form h2 {
            text-align: center;
            margin-bottom: 20px;
            color:navy
        }

        .login-form input[type="email"],
        .login-form input[type="password"] 
        {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
            opacity:0.8;
        }
        input{
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

         input:focus
        {
            font-size: 15px;
           
            color:cadetblue;
         
        }

        .login-form button {
            width: 97%;
            padding: 10px;
            background-color: #28a745; /* Green color */
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            opacity:0.8;
        }

        .login-form button:hover {
            background-color:blue ;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <form method="post" action="admin_login_process.php" class="login-form" autocomplete="off">
        <h2>Admin Login</h2>
        <input type="email" name="email" placeholder="email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>
