<?php
$servername = "localhost";
$username = "root";
$password = "12345";
$dbname = "testdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username_input = $_POST['username'];
    $password_input = $_POST['password'];

    // VULNERABLE SQL QUERY - DO NOT USE IN PRODUCTION
    $sql = "SELECT * FROM test_users WHERE username = '$username_input' AND password = '$password_input'";

    echo "SQL Query: " . $sql . "<br>";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Login successful!";
    } else {
        echo "Login failed. Incorrect username or password.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username"><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password"><br><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>