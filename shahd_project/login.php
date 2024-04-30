<?php
// Database connection parameters
$servername = "localhost"; // Change these credentials according to your setup
$username = "root";
$password = "ayman1234";
$dbname = "cloud_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables to store user input
$id = $password = "";
$idErr = $passwordErr = "";
$isValid = true;

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate ID
    if (empty($_POST["id"])) {
        $idErr = "ID is required";
        $isValid = false;
    } else {
        $id = test_input($_POST["id"]);
        // Check if ID is numeric
        if (!is_numeric($id)) {
            $idErr = "ID must be a number";
            $isValid = false;
        }
    }

    // Validate password
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
        $isValid = false;
    } else {
        $password = test_input($_POST["password"]);
    }

    // If input is valid, query the database
    if ($isValid) {
        $sql = "SELECT * FROM Students WHERE id='$id' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // ID and password are correct, fetch student data
            $row = $result->fetch_assoc();
            $name = $row["name"];
        } else {
            // Invalid ID or password
            $idErr = "Invalid ID or password";
            $isValid = false;
        }
    }
}

// Function to sanitize input data
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Data</title>
    <style>
        
            body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            background-image: url('_6f9422d8-f124-4343-9862-82c36cee6c1f.jpeg');
            background-size: cover;
        }

        .navbar {
            overflow: hidden;
            background-color: #333;
            padding: 10px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            margin-right: 10px;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
        }

        .student-info {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f2f2f2;
        }

        .student-info p {
            margin: 10px 0;
        }

        .student-info span {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="navbar">
    <a href="all_team.php"><i class="fas fa-users"></i> Team Member</a>
        <a href='signup.html'><i class="fas fa-user-plus"></i> Add Member</a>
        <a href='index.html'><i class="fas fa-sign-out-alt"></i> Log out</a>

    </div>
    <div class="container">
        <h2>Welcome, <?php echo $name; ?></h2>
        <?php if ($isValid): ?>
            <div class="student-info">
                <p><span>ID:</span> <?php echo $row["id"]; ?></p>
                <p><span>Name:</span> <?php echo $row["name"]; ?></p>
                <p><span>Age:</span> <?php echo $row["age"]; ?></p>
                <p><span>CGPA:</span> <?php echo $row["cgpa"]; ?></p>
                <!-- Add more data fields as needed -->
            </div>
        <?php else: ?>
            <p><?php echo $idErr; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
