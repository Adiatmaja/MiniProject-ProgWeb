<?php
require_once("connection.php");
$sql="
SELECT olahraga.idolahraga as IdOlahraga, olahraga.NamaOlahraga as NamaOlahraga, tipe.NamaTipe as TipeOlahraga, level.NamaLevel as Level, olahraga.Peralatan,
olahraga.Deskripsi as Deskripsi, video.Durasi as Durasi, instruktur.NamaInstruktur as Instruktur, video.LinkVideo as Video, image.ImagePath as Image  
FROM olahraga
INNER JOIN tipe ON olahraga.IdTipe=tipe.Idtipe
INNER JOIN level ON olahraga.IdLevel=level.IdLevel
INNER JOIN video ON olahraga.IdVideo=video.IdVideo
INNER JOIN instruktur ON olahraga.IdInstruktur=instruktur.IdInstruktur
INNER JOIN Image ON olahraga.IdImage=image.IdImage
ORDER BY IdOlahraga
";
$result=mysqli_query($conn, $sql);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>fit.now</title>
</head>
<body>
    <header>
        <div class="container">
            <div class="video-background">
                <img src="assets/bg.jfif" alt="">
            </div>
            <div class="header">
                <div class="header-kiri">
                    fit.now
                </div>
                <div class="header-kanan">
                    <a href="index.php">Home</a>
                    <?php
                        session_start();
                        if(!isset($_SESSION['username'])){
                            echo ("<a href='login.php'>Login</a>");
                        }else if(isset($_SESSION['username'])){
                            echo"<a href='dashboard.php'>Dashboard</a>";
                            echo'<form action="index.php" method="POST">
                                <button type="submit" class="btn-link" value="logout" name="logout"> Logout </button></form>';
                            
                                if(isset($_POST["logout"])){
                                    session_destroy();
                                    header("Location: index.php");
                                }
                        }
                    ?>
                    
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
            <div class="content">
                <span class="greetings">Start With Us</span>
                <span class="domain">fit.now</span>
            </div>
        </div>
        
    </header>
    <div class="content">
        
    </div>
    <div class="contain">
        <?php
            $sql2="Select NamaLevel from level";
            $result2=mysqli_query($conn, $sql2);
            if (mysqli_num_rows($result2)>0){
                while($row2 = mysqli_fetch_assoc($result2)){
                    
                    echo "
                    <h2>".$row2['NamaLevel']."</h2>
                    <div class='levels'>
                    "; 
                    if (mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_assoc($result)){
                            if($row["Level"]==$row2["NamaLevel"]){
                                
                                echo "
                                <div class='description'>
                                    <a href=detail.php?id=".$row['IdOlahraga']."><img src=".$row["Image"]." alt=''>
                                    <h2 class='judul'>".$row['NamaOlahraga']."</h2></a>
                                </div>";
                                   
                            }
                        }mysqli_data_seek($result,0);
                    }
                    echo "</div>";
                }
            }
            ?>
    </div>
    <br>
    <footer>
        <p>© All Copyright goes to its rightful owner</p>
    </footer>
</body>
</html>