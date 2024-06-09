<?php
include('connection.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submittedUsername = $_POST['username'];
    $submittedPassword = $_POST['password'];

    
    $checkUserSql = "SELECT * FROM users WHERE username = ?";
    $checkUserStmt = $conn->prepare($checkUserSql);
    $checkUserStmt->bind_param("s", $submittedUsername);
    $checkUserStmt->execute();    $userResult = $checkUserStmt->get_result();

    if ($userResult->num_rows > 0) {
        
        $userRow = $userResult->fetch_assoc();
        $storedPassword = $userRow['password'];

        if (password_verify($submittedPassword, $storedPassword)) {
            
            header("Location: dashboard.php?name=$submittedUsername");
            exit();
        } else {
            $errorMessage = 'Invalid password';
        }
    } else {
        $errorMessage = 'User not found';
    }  
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
        }

        h1 {
            color: #333;
        }

        .form-container {
            width: 300px;
            margin: 0 auto;
        }

        .form-input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }

        .button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: #ff0000;
        }
    </style>
</head>
<body>

    <h1>Login</h1>

    <div class="form-container">
        <form method="post" action="login.php">
            <input type="text" name="username" class="form-input" placeholder="Username" required>
            <input type="password" name="password" class="form-input" placeholder="Password" required>
            <button type="submit" class="button">Login</button> 
        </form>

        <?php if (isset($errorMessage)) : ?>
            <p class="error-message"><?php echo $errorMessage; ?></p>
        <?php endif; ?>
    </div>

</body>
</html>
