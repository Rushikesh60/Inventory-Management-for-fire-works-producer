<!DOCTYPE html>
<html>
<head>
    <title>Worker & Product</title>
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
        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"],
        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 8px 12px; /* Adjusted padding */
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            font-size: 14px; /* Adjusted font size */
            transition: background-color 0.3s;
            width: 100%;
        }

        input[type="submit"]:hover,
        .btn:hover {
            background-color: #45a049;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .button-container button {
            display: inline-block;
            margin: 0 5px; /* Adjusted margin */
        }

        .row {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
    <h2>Worker Details and Product Quantity</h2>
    <form method="post">
        
        Worker Name: 
        <input type="text" name="worker_name"><br><br>
        Product:
        <select name="product">
            <option value="Crackers">Crackers</option>
            <option value="Atom Bomb">Atom Bomb</option>
            <option value="Sparklers">Sparklers</option>
            <option value="Rocket">Rocket</option>
        </select><br><br>
        Quantity: <input type="number" name="quantity"><br><br>
        <input type="submit" name="submit" value="Submit" class="btn">
    </form>

    <div class="button-container">
        <div class="row">
            <button onclick="window.location.href='update.php'" class="btn">Update</button>
            <button onclick="window.location.href='dlt.php'" class="btn">Delete</button>
            <button onclick="window.location.href='det.php'" class="btn">Show Info</button>
        </div>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "localhost";
        $username = "root"; 
        $password = ""; 
        $dbname = "mini"; 

        $conn = new mysqli($servername, $username, $password, $dbname,3307);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $worker_name = $_POST['worker_name'];
        $product = $_POST['product'];
        $quantity = $_POST['quantity'];

        
        $check_query = "SELECT * FROM worker WHERE worker_name='$worker_name'";
        $check_result = $conn->query($check_query);

        if ($check_result->num_rows > 0) {
            echo "<p class='error-msg'>Worker already exists in the table.</p>";
        } else {
            
            $sql = "INSERT INTO worker (worker_name, product, quantity) VALUES ('$worker_name', '$product', '$quantity')";

            if ($conn->query($sql) === TRUE) {
                echo "<p class='success-msg'>Record inserted successfully.</p>";
            } else {
                echo "<p class='error-msg'>Error: " . $sql . "<br>" . $conn->error . "</p>";
            }
        }

        $conn->close();
    }
    ?>
</body>
</html>
