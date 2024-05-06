<!DOCTYPE html>
<html>
<head>
    <title>Delete Worker</title>
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
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            font-size: 14px;
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

        .button-container .row {
            display: flex;
            justify-content: space-between;
        }

        .button-container .row button {
            margin: 0 5px;
        }
    </style>
</head>
<body>
    <h2>Delete Worker</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        Worker Name:
        <select name="worker_name" id="workerName">
            <?php
            
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "mini";

            $conn = new mysqli($servername, $username, $password, $dbname, 3307);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            
            $sql = "SELECT worker_name FROM worker";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["worker_name"] . "'>" . $row["worker_name"] . "</option>";
                }
            } else {
                echo "<option value=''>No workers found</option>";
            }
            $conn->close();
            ?>
        </select>
        <input type="submit" name="delete_worker" value="Delete" class="btn">
    </form>

    <div class="button-container">
        <div class="row">
            <button onclick="window.location.href='add.php'" class="btn">Add New Worker</button>
            <button onclick="window
            .location.href='update.php'" class="btn">Update Worker Info</button>
            <button onclick="window.location.href='det.php'" class="btn">Show Worker Info</button>
        </div>
    </div>

    <?php
    
    if(isset($_POST['delete_worker'])) {
        
        $conn = new mysqli($servername, $username, $password, $dbname, 3307);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        
        $worker_name = $_POST['worker_name'];

        
        $sql = "DELETE FROM worker WHERE worker_name = '$worker_name'";

        
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Worker deleted successfully.');</script>";
            
            echo "<script>window.location.href = window.location.href;</script>";
        } else {
            echo "<script>alert('Error deleting worker: " . $conn->error . "');</script>";
        }

        $conn->close();
    }
    ?>
</body>
</html>
