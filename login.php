<?php
include 'server.php';
$message = "";

if (isset($_GET['registered']) && $_GET['registered'] == 1) {
    $message = "Registered successfully! Please login.";
}


if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM students WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        header("Location: profile.php");
        exit();
    } else {
        $message = "Login failed! Incorrect email or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Login</title>
</head>
<body>

<h2>Login</h2>

<?php 
if($message) {

    $color = (isset($_GET['registered']) && $_GET['registered'] == 1) ? "green" : "red";
    echo "<p style='color:$color;'>$message</p>"; 
}
?>

<form method="POST">
    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit" name="login">Login</button>
</form>

<p>Don't have an account? <a href="register.php">Register here</a></p>

</body>
</html>
