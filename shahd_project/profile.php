<?php
session_start();
if(isset($_SESSION['user_data'])){
    $user_data = $_SESSION['user_data'];
    // Display user data
    echo "<h2>Welcome " . $user_data['name'] . "</h2>";
    echo "<p>ID: " . $user_data['id'] . "</p>";
    echo "<p>CGPA: " . $user_data['cgpa'] . "</p>";
    echo "<p>Age: " . $user_data['age'] . "</p>";
    echo "<p>Gender: " . $user_data['gender'] . "</p>";
} else {
    header("Location: index.html"); // Redirect if session is not set
    exit();
}
?>