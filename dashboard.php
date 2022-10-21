<?php   session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Complain Dashboard</title>
    <style>
        body{
            background-color: lightblue;
            font-family:sans-serif;
           
        }
    </style>
</head>
<body>

<a href="index.php">Logout</a>
    <h2 style="color:green;"><span><?php if(isset($_SESSION['user'])){ echo $_SESSION['user']." "; session_destroy();}?></span> , Welcome to Call Center Management System.</h2>

    <!-- start -->
    <?php
    include("server.php");
if(isset($_POST["SubmitBtn"])){
    //Complain Section and variables declarations

    $msg=$_POST["msg"];
    $fname = $_POST['fname'];
    $phone = $_POST['phone'];
    $subject = "Contact mail";
    // $from=$_POST["email"];
    // $headers = "From:" . $from."\r\n";
    // $headers .= "MIME-Version: 1.0\r\n";
    // $headers .= "Content-type: text/html\r\n";
    // $headers = "From: $from";

    $sql = "INSERT INTO complains (fname, phone, complain) VALUES ('$fname', '$phone', '$msg')";
    $result = mysqli_query($conn, $sql);


    if($result){
    echo "<p style='background-color: azure; color:darkgreen; font-size: 18px; padding:5px;'>Your Complain has been received.</p>";

    }else{
    echo "Email Not sent.";

    }
    }


?>

<form id="emailForm" name="emailForm" method="post" action="dashboard.php" >
<table width="100%" border="0" align="center" cellpadding="4" cellspacing="1">
<tr>
  <td colspan="2"><strong>Write Customer Complain Below:</strong></td>
</tr>
<tr>
  <td>Customer Full Name :</td>
  <td><input name="fname" type="text" id="fname"></td>
</tr>
<tr><tr>
  <td>Customer Phone Number :</td>
  <td><input name="phone" type="number" id="email"></td>
</tr>
<tr>
  <td>Complain :</td>
  <td>
  <textarea name="msg" cols="45" rows="5" id="msg"></textarea>
  </td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td><input name="SubmitBtn" type="submit" id="SubmitBtn" value="Submit"></td>
</tr>
</form>

<footer style="position:absolute; bottom: 10px;">
  <h4>&copy; Group 9</h4>
</footer>

    <!--end  -->
</body>
</html>