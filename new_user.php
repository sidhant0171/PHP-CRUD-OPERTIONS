<?php
include('connection.php');

$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_verify = $_POST['password_verify'];
 

    if ($password !== $password_verify) {
        $errorMessage = "Error: Passwords do not match.";
    }
    
    else 
    
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $id = '9';
        $is_active = 1;
        $joining_date = date('Y-m-d');

        $sql = "INSERT INTO users (id, name, username, email, password, is_active, joining_date) 
                VALUES ('$id', '$name', '$username', '$email', '$hashedPassword', '$is_active', '$joining_date')";

        if ($conn->query($sql) === TRUE) {
            echo "Great! New user created successfully";
            exit;
        } else {
            $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New User Registration</title>
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

        form:valid .button {
            background-color: #4CAF50; 
        }

        .error-message {
            color: red;
        }
    </style>
</head>
<body> 
<body>

    <h1>New User Registration</h1>

    <div class="form-container">
        <form method="post" action="new_user.php">
            <input type="text" name="name" class="form-input" placeholder="Full Name" maxlength="20" pattern="[A-Za-z ]+" required>
            <input type="text" name="username" class="form-input" placeholder="Username" maxlength="20" pattern="[A-Za-z]+" required>
            <input type="email" name="email" class="form-input" placeholder="Email" required>
            <input type="password" name="password" class="form-input" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
            <input type="password" name="password_verify" class="form-input" placeholder="Verify Password" required>
            <input type="hidden" name="id" class="form-input" placeholder="id" required>
            <input type="hidden" name="is_active" value="1">
            <input type="hidden" name="joining_date" value="<?php echo date('Y-m-d'); ?>">
            <button type="submit" class="button">Register </button>
            <p class="error-message"><?php echo $errorMessage; ?></p>
        </form>
    </div>

</body>
</html>
