<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "ayman1234";
$dbname = "cloud_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all student records from the database
$sql = "SELECT * FROM Students";
$result = $conn->query($sql);

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Students</title>
    <!-- Include Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            background-image: url('_6f9422d8-f124-4343-9862-82c36cee6c1f.jpeg');
            background-size: cover;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .student-block {
            background-color: #f9f9f9;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        .student-block:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .student-name {
            font-size: 24px;
            color: #333;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .student-info {
            font-size: 16px;
            color: #666;
        }

        .show-details-btn {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .show-details-btn:hover {
            background-color: #555;
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
            display: inline-flex;
            align-items: center; /* Center the icon and text vertically */
        }

        .navbar a:hover {
            background-color: white;
            color: black;
        }

        .data-icon {
            margin-right: 5px; /* Adjust spacing between icon and text */
        }
    </style>
</head>
<body>
<div class="navbar">
    <a href="#" onclick="goBack()"><i class="fas fa-arrow-left"></i> Main</a>
    <a href='signup.html'><i class="fas fa-plus"></i> ADD Student</a>
    <a href='index.html'><i class="fas fa-sign-out-alt"></i> Log out</a>
</div>
<div class="container">
    <h2>Team Data</h2>
    <?php
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<div class='student-block'>";
            echo "<div class='student-name'><i class='fas fa-user data-icon'></i>" . $row["name"] . "</div>";
            echo "<button class='show-details-btn' onclick='showDetails(" . $row["id"] . ")'>About</button>";
            echo "<div class='student-info student-details-" . $row["id"] . "' style='display:none;'>";
            echo "<div><i class='fas fa-id-card data-icon'></i>ID: " . $row["id"] . "</div>";
            echo "<div><i class='fas fa-birthday-cake data-icon'></i>Age: " . $row["age"] . "</div>";
            echo "<div><i class='fas fa-graduation-cap data-icon'></i>CGPA: " . $row["cgpa"] . "</div>";
            // Add more student info as needed
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>No data found</p>";
    }
    ?>
</div>

<script>
    function showDetails(studentId) {
        var details = document.querySelector('.student-details-' + studentId);
        if (details.style.display === 'none') {
            details.style.display = 'block';
        } else {
            details.style.display = 'none';
        }
    }

    function goBack() {
        window.history.back();
    }
</script>
</body>
</html>