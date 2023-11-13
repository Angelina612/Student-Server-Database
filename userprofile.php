<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Profile Page</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body style="background-color: white;">
<?php
    require('db_connection.php');
    $con = OpenCon();

    $stdid = mysqli_real_escape_string($con, $_SESSION['stdid']);
    $query = "SELECT * FROM `std` WHERE stdID='$stdid'";
    $result = mysqli_query($con, $query) or die(mysql_error());
    $row = $result->fetch_assoc();

    CloseCon($con);
?>
<div class="form">
    <p>Student ID:  <?php echo $row['stdID']; ?></p>
    <p>Name:  <?php echo $row['stdName']; ?></p>
    <p>Date of Joining:  <?php echo $row['DoJ']; ?></p>
    <p>Age:  <?php echo $row['Age']; ?></p>
    <p>Department:  <?php echo $row['department']; ?></p>
    <p>Mobile No.:  <?php echo $row['mobileNo']; ?></p>
    <p>email:  <?php echo $row['email']; ?></p>
    <p><a href='profileupdate.php' ><button class="login-button">Update Profile</button></a></p>
    <p><a href='logout.php'>Logout</a></p>
</div>
</body>
</html>