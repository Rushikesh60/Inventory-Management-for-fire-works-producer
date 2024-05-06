<!DOCTYPE html>
<html>
<head>
    <title>Product & Worker Information</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }

        .container {
            text-align: center;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin: 10px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1><center>Shree Fireworks<center></h1>

    <?php
    
    $servername = "localhost";
    $username = "root"; 
    $password = ""; 
    $dbname = "mini"; 

    
    $conn = new mysqli($servername, $username, $password, $dbname, 3307);

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

   
    $sql = "SELECT * FROM worker";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Worker & Product Information</h2>";
        echo "<table>";
        echo "<tr><th>Worker Name</th><th>Product</th><th>Quantity</th></tr>"; // Removed the Srno column
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["worker_name"] . "</td><td>" . $row["product"] . "</td><td>" . $row["quantity"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No data found.";
    }

    
    $sql = "SELECT product, SUM(quantity) AS total_quantity FROM worker GROUP BY product";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        
        echo "<h2>Total products available</h2>";
        echo "<table>";
        echo "<tr><th>Product</th><th>Total Quantity</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["product"] . "</td><td>" . $row["total_quantity"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No data found.";
    }

    $conn->close();
    ?>

    <div class="container">
        <button class="btn" onclick="window.location.href='add.php'">Add New Worker</button>
        <button class="btn" onclick="window.location.href='update.php'">Update Worker Info</button>
        <button class="btn" onclick="window.location.href='dlt.php'">Delete Worker</button>
    </div>
</body>
</html>
