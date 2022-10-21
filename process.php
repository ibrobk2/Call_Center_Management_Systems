<?php
session_start();
include_once("server.php");//Establishing database connection

//PHP MAILER ...
//Include required PHPMailer files
require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';
//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

   
$errors = array();

if(isset($_POST['btn_register'])){
    //variable declarations
    $fname = $_POST['fname'];
    $username = $_POST['user'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = md5($_POST['pwd']);
    $cpassword = md5($_POST['cpwd']);

    //VALIDATION SECTION
    if(empty($fname)){array_push($errors, "Full Name is Required");}
    if(empty($username)){array_push($errors, "Username is Required");}
    if(empty($phone)){array_push($errors, "Phone Number is Required");}
    if(empty($email)){array_push($errors, "Email Address is Required");}
    if(empty($password)){array_push($errors, "Password is Required");}
    if(empty($cpassword)){array_push($errors, "Confirm Password is Required");}

    if($password!=$cpassword){array_push($errors, "Passwords Mismatched");}
    
    $query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $qresult = mysqli_query($conn, $query);
    if(mysqli_num_rows($qresult)>0){
        array_push($errors, "User Already Exist.");
    }

 


    if(count($errors)==0){
         //SQL statement
  

    $sql = "INSERT INTO users (id, fullName, username, phone, email, pass) VALUES (null, '$fname', '$username', '$phone', '$email', '$password')";
    $res = mysqli_query($conn, $sql);
    
    
        $subject = "Welcome to Group 9 Call Center Management.";
        $subject2 = "Congrats, Registration Successful, A message was sent to your email.<br>You can now Login.";
        $message = "Dear ".$fname." <br> You are now registered on Group 9 Call Center Management System, you can now login.<br> <b>Your Login Details are:</b> <br>Username: ".$username."<br> Password: ".$password." <br><br><br>Thanks<br><b>Group 9 Members.</b>";
     
//Create instance of PHPMailer
	$mail = new PHPMailer();
//Set mailer to use smtp
	$mail->isSMTP();
//Define smtp host
	$mail->Host = "smtp.gmail.com";
//Enable smtp authentication
	$mail->SMTPAuth = true;
//Set smtp encryption type (ssl/tls)
	$mail->SMTPSecure = "ssl";
//Port to connect smtp
	$mail->Port = "465";
//Set gmail username
	$mail->Username = //"sender@gmail.com";
//Set gmail password
	$mail->Password = //"your_password_here";
//Email subject
	$mail->Subject = $subject;
//Set sender email
	$mail->setFrom('sender@gmail.com');
//Enable HTML
	$mail->isHTML(true);
//Attachment
	// $mail->addAttachment('img/attachment.png');
//Email body
	$mail->Body = $message;
//Add recipient
	$mail->addAddress($email);
//Finally send email
	if ( $mail->send() ) {
        $_SESSION['sent'] = $subject2;
	}else{
		echo "Message could not be sent. Mailer Error: ".$mail->ErrorInfo;
	}
//Closing smtp connection
	$mail->smtpClose();  


    // 
        
    $_SESSION['sent'] = $subject2; 
       
       

    header("Location:login.php");
    }


   

   
}



    // 

   //USER LOGIN SECTION
if(isset($_POST['btn_login'])){
    $username = $_POST['user'];
    $password = md5($_POST['pwd']);


    //VALIDATION SECTION
    if(empty($username)){array_push($errors, "Username is Required");}
    if(empty($password)){array_push($errors, "Password is Required");}

    

    $sql = "SELECT * FROM users WHERE username='$username' AND pass='$password' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)==1){
        $_SESSION['user'] = $_POST['user'];
        header("Location: dashboard.php");
    }else{
       array_push($errors, "Invalid username/password or user not registered");
       
    }
}

//ADMIN LOGIN SECTION
if(isset($_POST['admin_login'])){
    $username = $_POST['admin'];
    $password = $_POST['pass'];


    //ADMIN VALIDATION SECTION
    if(empty($username)){array_push($errors, "Admin Username is Required");}
    if(empty($password)){array_push($errors, "Admin Password is Required");}

    

    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result)==1){
        header("Location: admin_dashboard.php");
    }else{
       array_push($errors, "Invalid username/password or Admin not registered");
       
    }
}


//DELETE SECTION
if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $sql = "DELETE FROM complains WHERE id='$id' ";
    $result = mysqli_query($conn, $sql);
}


?>