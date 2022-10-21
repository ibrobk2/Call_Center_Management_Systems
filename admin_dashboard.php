<?php  include("server.php");  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body{
            font-family: sans-serif;
        }
        table{
            width: 80%;
            margin: auto;
        }
        table,th,td{
               border: 1px solid black;
               border-collapse: collapse;
               padding: 10px;
        }

        tr:nth-of-type(even){
            background-color: rgb(200,200,200);
        }

        h2{
            text-align:center;
            font-size: 35px;
        }
        button{
            padding: 6px;
        }

        .status{
            background-color: dodgerblue;
        }

        #del{
            background-color: red;
        }

        #logout{
            position: relative;
            float: right;
            font-size: 22px;
            text-decoration: none;
        }

        #admin{
            float:left;
            font-size:25px;
        }
    </style>
</head>
<body>
    <?php include("process.php");   ?>
    <div class="container">
    <h3><a href="#" id="admin">Admin Dashboard</a></h3>
    <a href="index.php" id="logout">Logout</a>
    <br><br><br>
        <h2>Customer Complaints Table</h2>

        <table>
            <thead>
                <tr>
                    <th>SNo.</th>
                    <th>Customer Full Name</th>
                    <th>Phone Number</th>
                    <th>Complain</th>
                    <th>Date</th>
                    <th>TicketID</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $sn = 1;
                $sql = "SELECT * FROM complains";
                $result = mysqli_query($conn, $sql);
                
                while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $row['fname']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['complain']; ?></td>
                    <td><?php echo date('Y-m-d H:i:s'); ?></td>
                    <td><?php echo ($row['id']+2022); ?></td>
                    <td><button id="<?php echo $row['id'];?>" onclick="this.innerHTML='Resolved';this.style.backgroundColor='green';"  class="status">Pending</button></td>
                    <td><a href="admin_dashboard.php?delete=<?=$row['id']; ?>"><button id="del">Delete</button></a></td>
                </tr>
                <?php  endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>