<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['username'];
$pass = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $name, $pass);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $_SESSION['username'] = $name; // Set the session variable
    echo "<script>console.log('Login successful')</script>";
    echo "<script>window.location.href='/booksite/sample/bookie.html'</script>";
} else {
    echo "<script>alert('Invalid username or password')</script>";
    echo "<script>window.location.href='/booksite/sample/signup.html'</script>";
}

$stmt->close();
$conn->close();
?>