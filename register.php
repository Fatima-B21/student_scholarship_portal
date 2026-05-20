<?php
include 'server.php';

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $cnic = $_POST['cnic'];
    $password = $_POST['password'];

    $sql = "INSERT INTO students (name, email, cnic, password)
            VALUES ('$name','$email','$cnic','$password')";

    if (mysqli_query($conn, $sql)) {

        header("Location: login.php?registered=1");
        exit();
    } else {
        $message = "Error: ".mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
</head>
<body>

<h2>Register</h2>

<form method="POST">
    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>CNIC:</label><br>
    <input type="text" name="cnic" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit" name="register">Register</button>
</form>

</body>
</html>
