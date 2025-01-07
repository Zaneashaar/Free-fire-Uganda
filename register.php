<?php
// Database connection details
$host = "sql8.freesqldatabase.com";
$dbname = "sql8756111";
$username = "sql8756111";
$password = "HQLkYCyuCD";
$port = 3306;

// Connect to the database
$conn = new mysqli($host, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve and sanitize form data
$user = $conn->real_escape_string($_POST['username']);
$email = $conn->real_escape_string($_POST['email']);
$pass = $conn->real_escape_string($_POST['password']);

// Validate if the user or email already exists
$sql_check = "SELECT * FROM users WHERE username = '$user' OR email = '$email'";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows > 0) {
    // User or email already exists
    echo "<script>alert('Username or Email already exists. Please try again.'); window.history.back();</script>";
} else {
    // Hash the password for security
    $hashed_password = password_hash($pass, PASSWORD_BCRYPT);

    // Insert the new user into the database
    $sql_insert = "INSERT INTO users (username, email, password) VALUES ('$user', '$email', '$hashed_password')";
    if ($conn->query($sql_insert) === TRUE) {
        echo "<script>alert('Registration successful! Redirecting to login page...'); window.location.href = 'login.html';</script>";
    } else {
        echo "<script>alert('Registration failed. Please try again.'); window.history.back();</script>";
    }
}

// Close the database connection
$conn->close();
?>
