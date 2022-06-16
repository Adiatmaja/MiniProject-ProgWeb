<?php
session_start();
require_once("connection.php");

if(isset($_SESSION["username"])){
    header("Location: dashboard.php");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login Admin</title>
</head>
<body>
<header>
        <div class="header">
            <div class="header-kiri">
                fit.now
            </div>
            <div class="header-kanan">
                <a href="index.php">Home</a>
                <form class="searchBox" method="GET" action="search.php">
                    <input class="searchInput" type="text" name="search" placeholder="Cari Olahraga">
                    <button class="searchButton">
                        <i class="material-icons">    
                            search
                        </i>
                    </button>
                </form> 
            </div>
        </div>
    </header>
    <form class="form-login" action="login.php" method="post">
        <h1>Login Admin</h1>
        <input type="text" id="username" placeholder="type your username" name="username"><br>
        <input type="password" id="password" placeholder="type your password" name="password"><br>
        <button class="w-100 btn btn-lg btn-primary" name="submit" value="sign-in" type="submit" onclick="validationLogin()">Login</button>
        <p id="alert" class="alert"></p>
    </form>
    
    <?php
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
            }else if($jumlah_row == 0 && $user!=null && $password!=null){
                echo "username atau password salah";
            }
        }
    ?>
    
    <script type="text/javascript">
        var inpUsername = document.getElementById("username");
        var inpPassword = document.getElementById("password");

        function validationLogin(){
            if(inpUsername.value === "" || inpPassword.value === ""){
                document.getElementById("alert").innerHTML = "Username atau Password tidak boleh kosong";
                event.preventDefault();
            }
        }
    </script>
    
</body>
<footer>
        <p>© All Copyright goes to its rightful owner</p>
    </footer>
</html>