<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    require('db_connection.php');
    session_start();
    $con = OpenCon();
    // When form submitted, check and create user session.
    if (isset($_POST['stdid'])) {
        $stdid = stripslashes($_REQUEST['stdid']);    // removes backslashes
        $stdid = mysqli_real_escape_string($con, $stdid);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query    = "SELECT * FROM `std` WHERE stdID='$stdid'
                     AND passwd='$password'";
        // $query    = "SELECT * FROM `std` WHERE stdID='$stdid'
        // AND passwd='" . md5($password) . "'";             
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['stdid'] = $stdid;
            // Redirect to user dashboard page
            header("Location: userprofile.php");
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Student ID/ Password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" method="post" name="login">
        <h1 class="login-title">Login</h1>
        <input type="text" class="login-input" name="stdid" placeholder="stdid" autofocus="true"/>
        <input type="password" class="login-input" name="password" placeholder="Password"/>
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link"><a href="registration.php">New Registration</a></p>
  </form>
<?php
    }
    CloseCon($con);
?>
</body>
</html>