<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Update</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>

<?php
    
    require('db_connection.php');
    $con = OpenCon();
    echo mysqli_real_escape_string($con, $_SESSION['stdid']);
    
    // // When form submitted, update values in the database.
    if (isset($_POST['stdid'])) {
        // removes backslashes
        $stdid = stripslashes($_REQUEST['stdid']);    // removes backslashes
        $stdid = mysqli_real_escape_string($con, $stdid);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        
        $actualid = mysqli_real_escape_string($con, $_SESSION['stdid']);
        $result = mysqli_query($con, "SELECT passwd FROM `std` WHERE stdID = '$actualid'");
        $actualpassword = $result->fetch_assoc();
        $actualpassword = $actualpassword['passwd'];
        if($stdid == $actualid && $password == $actualpassword) {
                        $mobileno = stripslashes($_REQUEST['mobileno']);
            $mobileno    = mysqli_real_escape_string($con, $mobileno);

            $email    = stripslashes($_REQUEST['email']);
            $email    = mysqli_real_escape_string($con, $email);
        
            $query    = "UPDATE `std` SET mobileNo = '$mobileno', email = '$email' WHERE stdID = '$stdid'";
            $result = mysqli_query($con, $query) or die(mysql_error());
            if($result) {
                header("Location: userprofile.php");
            }
        }
        else {
            echo "<div class='form'>
                  <h3>Incorrect Student ID/ Password.</h3><br/>
                  </div>";
        }
    }
        
?>        
<form class='form' action='' method='post'>
    <h1 class='login-title'>Update Profile</h1>
    <input type='text' class='login-input' name='stdid' placeholder='Student ID'  />
    <input type='password' class='login-input' name='password' placeholder='Password'>
    <?php 
        $stdid = mysqli_real_escape_string($con, $_SESSION['stdid']);
        $query    = "SELECT * FROM `std` WHERE stdID='$stdid'";
        $result   = mysqli_query($con, $query);
        $row = $result->fetch_assoc();
    ?>
    <input type='text' class='login-input' name='stdname' placeholder='Student Name' value=<?php echo $row['stdName']?> readonly>
    <input type='date' class='login-input' name='doj' placeholder='Date of Joining' value=<?php echo $row['DoJ']?> readonly>
    <input type='number' class='login-input' name='age' placeholder='Age' value=<?php echo $row['Age']?> readonly>
    <input type='text' class='login-input' name='department' placeholder='Department' value=<?php echo $row['department']?> readonly>
    <input type='number' class='login-input' name='mobileno' placeholder='Mobile No.' value=<?php echo $row['mobileNo']?> >
    <input type='text' class='login-input' name='email' placeholder='Email Adress' value=<?php  echo $row['email']?> >
    
    <input type='submit' name='submit' value='Update' class='login-button'>
</form>
<?php

CloseCon($con);
    
    ?>
</body>
</html>