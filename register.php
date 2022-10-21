<?php include_once("server.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include_once("process.php"); ?>

    <div class="container">
        <h2>Registration Form</h2>
        <?php 
        if($errors!=""){
        include_once("errors.php");
    
    }
        ?>

        <form action="register.php" method="post">
            <div class="form-group">
                <input type="text" placeholder="Full Name" name="fname">
            </div>
            <div class="form-group">
                <input type="text" placeholder="Username" name="user">
            </div>
            <div class="form-group">
                <input type="number" placeholder="Phone Number" name="phone">
            </div>
            <div class="form-group">
                <input type="email" placeholder="Email Address" name="email">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Choose Password" name="pwd" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"  title = 'the password must be 8 characters length and include at least one upper case letter,one lower case letter and one numeric digit' min_length="8">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Confirm Password" name="cpwd">
            </div>
            <button name="btn_register" id="regbtn">Register</button>
        </form>

        <p id="st">Already Registered? Login <a href="login.php">Here</a></p>
    </div>
</body>
</html>