<!DOCTYPE html>
<html>
<head>
    <title>Update details</title>
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
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            font-size: 16px;
            transition: background-color 0.3s;
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
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <h2>Update Worker Details & Product Quantity</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        
        Worker Name: 
        <select name="worker_name">
            <?php
            $servername = "localhost";
            $username = "root"; 
            $password = ""; 
            $dbname = "mini"; 

            $conn = new mysqli($servername, $username, $password, $dbname, 3307);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            
            $worker_query = "SELECT DISTINCT worker_name FROM worker";
            $worker_result = $conn->query($worker_query);

            if ($worker_result->num_rows > 0) {
                while($row = $worker_result->fetch_assoc()) {
                    echo "<option value='" . $row["worker_name"] . "'>" . $row["worker_name"] . "</option>";
                }
            }
            $conn->close();
            ?>
        </select><br><br>
        Product:
        <select name="product">
            <option value="cracker">Cracker</option>
            <option value="Atom_Bomb">Atom Bomb</option>
            <option value="Rocket">Rocket</option>
            <option value="Sparklers">Sparklers</option>
        </select><br><br>
        Quantity: <input type="number" name="quantity"><br><br>
        <input type="submit" name="submit" value="Submit" class="btn">
    </form>

    <div class="button-container">
        <button onclick="window.location.href='add.php'" class="btn">Add New Worker</button>
        <button onclick="window.location.href='dlt.php'" class="btn">Delete Worker</button>
        <button onclick="window.location.href='det.php'" class="btn">Show Information</button>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "localhost";
        $username = "root"; 
        $password = ""; 
        $dbname = "mini"; 

        $conn = new mysqli($servername, $username, $password, $dbname, 3307);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $worker_name = $_POST['worker_name'];
        $product = $_POST['product'];
        $quantity = $_POST['quantity'];

        if (!empty($worker_name) && !empty($quantity) && !empty($product)) {
            
            $check_query = "SELECT * FROM worker WHERE worker_name='$worker_name' AND product='$product' AND quantity='$quantity'";
            $check_result = $conn->query($check_query);
            if ($check_result->num_rows > 0) {
                echo "Record already exists for this worker with the same product and quantity.";
            } else {
                $sql = "UPDATE worker SET quantity='$quantity', product='$product' WHERE worker_name='$worker_name'";
                if ($conn->query($sql) === TRUE) {
                    echo "Record updated successfully";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }
        } else {
            echo "Worker Name, Quantity, and Product are required.";
        }

        $conn->close();
    }
    ?>
</body>
</html>
