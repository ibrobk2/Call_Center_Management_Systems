<?php 
// session_start();

include_once("server.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include_once("process.php"); ?>

    <div class="container">
        <?php  
        if(isset($_SESSION['sent'])){
            echo $_SESSION['sent'];
        }
        
        ?>
        <h2>Admin Login</h2>
        <form action="admin_login.php" method="post">
        <?php include_once("errors.php"); ?>

            
            <div class="form-group">
                <input type="text" placeholder="Username" name="admin">
            </div>
            
            <div class="form-group">
                <input type="password" placeholder="Choose Password" name="pass">
            </div>
           
            <button name="admin_login">Login</button>
        </form>
    </div>
</body>
</html>