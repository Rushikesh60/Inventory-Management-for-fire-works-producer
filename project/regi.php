<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        form {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>User Registration</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Name: <input type="text" name="name" required><br><br>
        Email: <input type="email" name="email" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        <input type="submit" name="submit" value="Register">
    </form>
    
    <p>Already registered? <a href="login.php">Login here</a></p>

    <?php
    // Database connection
    $servername = "localhost";
    $username = "root"; // Your MySQL username
    $password = ""; // Your MySQL password
    $dbname = "mini"; // Your MySQL database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname, 3307);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert user data into database when form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password']; // It's recommended to hash the password before storing it in the database

        // Check if email already exists
        $check_email_query = "SELECT * FROM user WHERE email='$email'";
        $check_email_result = $conn->query($check_email_query);
        if ($check_email_result->num_rows > 0) {
            echo "Error: Email already exists";
        } else {
            // Email does not exist, proceed with registration
            // SQL query to insert data into table
            $sql = "INSERT INTO user (name, email, password) VALUES ('$name', '$email', '$password')";
            if ($conn->query($sql) === TRUE) {
                // Redirect to login page
                header("Location: login.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    $conn->close();
    ?>
</body>
</html>
