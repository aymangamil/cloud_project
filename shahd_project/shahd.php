<?php
$servername = "localhost";
$username = "root";
$password = "ayman1234";
$dbname = "cloud_database";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo 'failed' ;
}
$id = $_POST['id'];
$name = $_POST['name'];
$password = $_POST['password'];
$cgpa = $_POST['cgpa'];
$gender=$_POST['gender'];
$age=$_POST['Age'];

// SQL query to add new student
$sql = "INSERT INTO Students (id,name, password,cgpa,gender,age) VALUES ('$id','$name', '$password','$cgpa','$gender','$age')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
    header("Location: index.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
