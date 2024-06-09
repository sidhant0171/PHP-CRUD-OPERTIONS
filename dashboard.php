<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
              
        .container {
            text-align: center;
        }

        table {
            margin: 20px;
        }

        form {
            margin: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <?php
    include('connection.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
     
        $name = $_POST['name'];
        $email = $_POST['email'];
        $id = $_POST['id'];

        $updateQuery = "UPDATE users SET name='$name', email='$email' WHERE id=$id";

        if ($conn->query($updateQuery) === TRUE) { 
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error; 
        }
    }

    
    
    $query = "SELECT * FROM users";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Edit</th><th>Delete</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td><a href='?action=edit&id=" . $row['id'] . "'>Edit</a></td>";
            echo "<td><a href='delete.php?id=" . $row['id'] . "'>Delete</a></td>";
            echo "</tr>";
        }

        echo "</table>";

        if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
            $editUserId = $_GET['id'];

            $editQuery = "SELECT * FROM users WHERE id=$editUserId";
            $editResult = $conn->query($editQuery);

            if ($editResult->num_rows > 0) {
                $editRow = $editResult->fetch_assoc();
            
                ?>
                <form method="post" action="" style="text-align: center;">
                    <input type="hidden" name="id" value="<?php echo $editRow['id']; ?>">
                    Name: <input type="text" name="name" value="<?php echo $editRow['name']; ?>"><br>
                    Email: <input type="text" name="email" value="<?php echo $editRow['email']; ?>"><br>
                    <input type="submit" value="Update">
                </form>
                <?php
            } else {
                echo "User not found for editing.";
            }
         }
    } else {
        echo "No results found";
    }


    $conn->close();      
    ?>

</div>

</body>
</html>
