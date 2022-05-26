<?php
session_start();

require_once("connection.php");

if(isset($_SESSION["username"])){
    header("Location: dashboard.php");
}

if ($_POST){
    $user=$_POST["username"];
    $password=$_POST["password"];
    $query="SELECT * FROM admin WHERE username = '".$user."' AND 
    password = '".$password."'LIMIT 1;";
    $result_query=mysqli_query($conn,$query);
    $jumlah_row=mysqli_num_rows($result_query);
    if($jumlah_row > 0){
        $row=mysqli_fetch_assoc($result_query);
        $_SESSION["username"]=$user;
        header("Location: dashboard.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="template.css">
    <title>Document</title>
</head>
<body>
<header>
        <div class="header">
            <div class="header-kiri">
                fit.now
            </div>
            <div class="header-kanan">
                <a href="index.php">Home</a>
                <div class="searchBox">
                    <input class="searchInput"type="text" name="" placeholder="Cari Olahraga">
                    <button class="searchButton" href="#">
                        <i class="material-icons">
                            search
                        </i>
                    </button>
                </div>
            </div>
        </div>
    </header>
    <form action="login.php" method="post">
        <input type="text" placeholder="type your username" name="username">
        <input type="password" placeholder="type your password" name="password">
        <button class="w-100 btn btn-lg btn-primary" name="submit" value="sign-in" type="submit">Login</button>
        
    </form>
    <footer>
        <p>© All Copyright goes to its rightful owner</p>
    </footer>
</body>
</html>