<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    require('db_connection.php');
    $con = OpenCon();
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['stdid'])) {
        // removes backslashes
        $stdid = stripslashes($_REQUEST['stdid']);
        //escapes special characters in a string
        $stdid = mysqli_real_escape_string($con, $stdid);

        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);

        $stdname    = stripslashes($_REQUEST['stdname']);
        $stdname    = mysqli_real_escape_string($con, $stdname);

        $doj = date("Y-m-d");

        $age = stripslashes($_REQUEST['age']);
        $age    = mysqli_real_escape_string($con, $age);

        $department = stripslashes($_REQUEST['department']);
        $department    = mysqli_real_escape_string($con, $department);

        $mobileno = stripslashes($_REQUEST['mobileno']);
        $mobileno    = mysqli_real_escape_string($con, $mobileno);

        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        
        $query    = "INSERT into `std` (stdID, passwd, stdName, DoJ, Age, department, mobileNo, email)
                     VALUES ('$stdid', '$password', '$stdname', '$doj', '$age', '$department', '$mobileno','$email')";
        try{             
            $result   = mysqli_query($con, $query) or die(mysql_error());
            if ($result) {
                echo "<div class='form'>
                    <h3>You are registered successfully.</h3><br/>
                    <p class='link'>Click here to <a href='login.php'>Login</a></p>
                    </div>";
            } else {
                echo "<div class='form' style='background-color: white;'>
                    <h3>Required fields are missing.</h3><br/>
                    <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                    </div>";
            }
        } catch(Exception $e) {
            echo "<div class='form' style='background-color: white;'>
                    <h3>" .$e->getMessage(); "</h3><br/>
                    <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                    </div>";
        }
    } else {
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="stdid" placeholder="Student ID" required />
        <input type="password" class="login-input" name="password" placeholder="Password" required>
        <input type="text" class="login-input" name="stdname" placeholder="Student Name" required>
        <input type="date" class="login-input" name="doj" placeholder="Date of Joining" required>
        <input type="number" class="login-input" name="age" placeholder="Age" required>
        <input type="text" class="login-input" name="department" placeholder="Department" required>
        <input type="number" class="login-input" name="mobileno" placeholder="Mobile No." required>
        <input type="text" class="login-input" name="email" placeholder="Email Adress" required>
        
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link"><a href="login.php">Click to Login</a></p>
    </form>
<?php
    }
    CloseCon($con);
?>
</body>
</html>