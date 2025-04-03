<?php
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // get form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // check if email is already in database
    $checkemail = "SELECT * FROM users WHERE email= '$email'";
    $result = $conn->query($checkemail);

    if ($result->num_rows > 0) {
        echo "Error: This email already has an account";
    } else {
    

        $sql = "INSERT INTO users(username, email, password) VALUES ('$username', '$email','$password')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Account created successfully!');
                window.location.href = 'signin.html';
                </script>"; 
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error; 
        }
    }
}
?>