<?php
session_start();
include 'dbconf.php';

// Register and login flow, use password hashing for more security

if (isset($_POST["register"])) {

    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $password = mysqli_real_escape_string($con, $_POST["password"]);
    $password = password_hash($password, PASSWORD_DEFAULT);
    $firstname = mysqli_real_escape_string($con, $_POST["firstname"]);
    $lastname = mysqli_real_escape_string($con, $_POST["lastname"]);
    $phone = mysqli_real_escape_string($con, $_POST["phone"]);
    $query = mysqli_query($con, "INSERT INTO users (email, password, firstname, lastname, phone) VALUES ('$email', '$password','$firstname','$lastname','$phone')") or die(mysqli_error($con));

}

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $query = mysqli_query($con, "SELECT * FROM users WHERE email='$email'") or die(mysqli_error($con));
    $user = mysqli_fetch_assoc($query);

    if ($user) {
        if (password_verify($password, $user["password"])) {
            //return true;
            $_SESSION["email"] = $email;
            $_SESSION["userid"] = $user[id];
            $_SESSION["firstname"] = $user[firstname];
            header("location:dashboard.php");
        } else {
            //return false;
            echo '<script>alert("Wrong User Details")</script>';
        }
    }

}

?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">

</head>

<body class="login-bg">
    <div class="form-wrapper">
        <form action="../index.php" method="post">
            <h3>CalendRX Portal</h3>

            <div class="form-item">
                <input type="text" name="email" required="required" placeholder="Email" autofocus required></input>
            </div>

            <div class="form-item">
                <input type="password" name="password" required="required" placeholder="Password" required></input>
            </div>

            <div class="button-panel">
                <input type="submit" class="button" title="Log In" name="login" value="Login"></input>
            </div>
        </form>
        <div class="reminder">

        </div>
        <a href="/pages/register.html">No Account, Please register</a>

    </div>

</body>

</html>