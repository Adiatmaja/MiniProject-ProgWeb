<?php
session_start();

if(!isset($_SESSION["username"])){
    header("Location: login.php");
}elseif (isset($_POST["logout"])){
    session_destroy();
    header("Location:login.php");
}

$user=$_SESSION["username"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="template.css">
</head>
<body>
<header>
        <div class="header">
            <div class="header-kiri">
                fit.now
            </div>
            <div class="header-kanan">
                <a href="index.php">Home</a>
                <form action="dashboard.php" method="POST">
                    <button type="submit" class="btn-link" value="logout" name="logout"> Logout </button>
                </form>
                <form class="searchBox" method="GET" action="search.php">
                    <input class="searchInput" type="text" name="search" placeholder="Cari Olahraga" required>
                    <button class="searchButton">
                        <i class="material-icons">    
                            search
                        </i>
                    </button>
                </form> 
            </div>
        </div>
    </header>
</body>
<footer>
        <p>© All Copyright goes to its rightful owner</p>
    </footer>
</html>