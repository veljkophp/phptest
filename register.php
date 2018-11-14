<?php
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "phptest");
$connection = mysqli_connect (DB_HOST, DB_USER, DB_PASS, DB_NAME)
        or die("Conection error!");
$email=NULL;
$name=NULL;
$msg=NULL;
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $repeatpassword = $_POST['repeatpassword'];
    
    $query="SELECT count(*) FROM user WHERE email='$email'";    
    $result = mysqli_query($connection, $query)
        or die("Unexpected error: " . mysqli_error($connection));
    $numberofusers = mysqli_fetch_array($result)[0];
    if ($numberofusers>= 1) {
        $msg="User with that email already exists!";
    }
    else if ($password != $repeatpassword) {
        $msg="Passwords are not same!";
    }
    else {
        $password=password_hash($password, PASSWORD_DEFAULT);
        $query="INSERT INTO user(email, name, password) VALUES ('$email', '$name', '$password')";    
        $result = mysqli_query($connection, $query)
            or die("Unexpected error: " . mysqli_error($connection)); 
        $msg="Successed registration.";
        $email=NULL;
        $name=NULL;
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registration</title>
    </head>
    <body>
        <a href="index.php">Home page</a>
        <a href="login.php">Login</a><br><br>
        
        
       <form name="register" method="POST" 
             action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <?php echo $msg; ?><br>
            <table>
                <tr>
                    <td>E-mail:</td> 
                    <td><input style="width:200px"  type="email" name="email" 
                               required  placeholder="Enter email"
                               value="<?php echo $email; ?>"></td>
                </tr>
                <tr>
                    <td>Name:</td> 
                    <td><input style="width:200px" type="text" name="name" 
                               required placeholder="Enter name"
                               value="<?php echo $name; ?>"></td>
                </tr>
                <tr>
                    <td>Password:</td> 
                    <td><input style="width:200px"  type="password" name="password" 
                               required placeholder="Enter password" ></td>
                </tr>
                <tr>
                    <td>Repeat password:</td> 
                    <td><input style="width:200px"  type="password" name="repeatpassword" 
                               required placeholder="Repeat password" ></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input style="width:200px" type="submit" 
                               value="Register"></td>
                </tr>
            </table>    
        </form>
    </body>
</html>

