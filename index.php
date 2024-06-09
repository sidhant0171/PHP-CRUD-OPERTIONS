<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px; 
        }
 
        h1 {
            color: #333;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
            color: #fff;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            box-shadow: 0 3px #666;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <h1>Welcome players</h1> 

    <p>Please choose an option:</p>

    <a href="login.php" class="button">Login</a>
    <br>
    <br>
    <a href="new_user.php" class="button">New User</a>

</body>
</html>
