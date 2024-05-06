<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIRECRACKER</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
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
    <div class="container">
        <h1>Welcome to Shree Fireworks:</h1>
        <button class="btn" onclick="window.location.href='add.php'">Add New Worker</button>
        <button class="btn" onclick="window.location.href='update.php'">Update Worker Info</button>
        <button class="btn" onclick="window.location.href='dlt.php'">Delete Worker</button>
        <button class="btn" onclick="window.location.href='det.php'">Show Worker Info</button>
    </div>
</body>
</html>

