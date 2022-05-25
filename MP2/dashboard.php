<?php
session_start();

if(!isset($_SESSION["username"])){
    header("Location: login.php");
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
                <a href="logout.php">Logout</a>
                </form>
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
</body>
</html>