<?php
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "phptest");
$connection = mysqli_connect (DB_HOST, DB_USER, DB_PASS, DB_NAME)
        or die("Conection error!");
$email=NULL;
$msg=NULL;
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query="SELECT * FROM user WHERE email='$email'"; 
    $result = mysqli_query($connection, $query)
        or die("Unexpected error: " . mysqli_error($connection));
    $user = mysqli_fetch_array($result);
    if ($user == NULL) {
        $msg="Error logging you in.";
    } else if(!password_verify($password,$user[2])){
        $msg="Error logging you in.";
    } else {
        session_start(); 
        $_SESSION['email'] = $user[0];
        $_SESSION['name'] = $user[1];
        header("Location: index.php?msg=Welcome, ".$user[1]."!");
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Log in</title>
    </head>
    <body>
        <a href="index.php">Home page</a>
        <a href="register.php">Registration</a><br><br>
        
        
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" 
             name="login" method="POST">
            <?php echo $msg; ?><br>
            <table>
                <tr>
                    <td>E-mail:</td> 
                    <td><input style="width:200px"  type="email" name="email" 
                               required  placeholder="Enter email"
                               value="<?php echo $email; ?>"></td>
                </tr>      
                <tr>
                    <td>Password:</td> 
                    <td><input style="width:200px"  type="password" name="password" 
                               required placeholder="Enter password" ></td>
                </tr>           
                <tr>
                    <td></td>
                    <td><input style="width:200px" type="submit" 
                               value="Log in"></td>
                </tr>
            </table>
        </form>
    </body>
</html>

