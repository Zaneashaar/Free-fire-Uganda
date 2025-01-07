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

// Retrieve form data
$user = $_POST['username'];
$pass = $_POST['password'];

// Sanitize inputs to prevent SQL injection
$user = $conn->real_escape_string($user);
$pass = $conn->real_escape_string($pass);

// Query to check credentials
$sql = "SELECT * FROM users WHERE username = '$user' OR email = '$user' AND password = '$pass'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Login successful
    echo "<script>alert('Login successful! Redirecting...'); window.location.href = 'dashboard.html';</script>";
} else {
    // Login failed
    echo "<script>alert('Invalid username or password. Please try again.'); window.history.back();</script>";
}

// Close the connection
$conn->close();
?>
