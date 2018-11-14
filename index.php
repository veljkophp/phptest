<?php
    session_start(); 
    $login=FALSE;
    if(isset($_SESSION['email'])) {
        $login=TRUE;
    }
    $msg=NULL;
    if(isset($_GET['msg'])){
        $msg=$_GET['msg'];
    }
?>  
<html>
    <head>
        <meta charset="UTF-8">
        <title>Home page</title>
    </head>
    <body>
        <?php if($login) { ?>
            <a href="logout.php">Log out</a>
        <?php } else { ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php } ?>
        <br><br>
        <?php echo $msg;?><br/>
        <form action="results.php" method="GET">
        
            Search:<input type="text" name="search">
            <input type="submit" value="Search">
        
        </form>
    </body>
</html>
