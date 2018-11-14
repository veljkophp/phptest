<?php
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "phptest");
$connection = mysqli_connect (DB_HOST, DB_USER, DB_PASS, DB_NAME)
        or die("Conection error!");
session_start(); 
if(!isset($_SESSION['email'])){
    header("Location: index.php?msg=Please login!");
}
$search="";
if(isset($_GET['search'])) {
    $search=$_GET['search'];
}

$query="SELECT email, name FROM user WHERE email LIKE '%$search%' OR name LIKE '%$search%'";    
$result = mysqli_query($connection, $query)
    or die("Unexpected error: " . mysqli_error($connection));

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Results</title>
        <style>
            table {
                border-collapse: collapse;
            }

            table, td, th {
                border: 1px solid black;
            }
        </style>    
    </head>
    <body>
        <a href="index.php">Home page</a>
        
        
        <table>
            <tr>
                <th>Email</th>
                <th>Name</th>
            </tr>
            <?php while($user=mysqli_fetch_array($result)) {?>
                <tr>
                    <td><?php echo $user[0]; ?></td> 
                    <td><?php echo $user[1]; ?></td> 
                </tr>      
            <?php } ?>
        </table>
        
    </body>
</html>

