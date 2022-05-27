<?php
require_once("connection.php");
if($_GET){
    $search=$_GET['search'];
    $sql="
    SELECT olahraga.idolahraga as IdOlahraga, olahraga.NamaOlahraga as NamaOlahraga, tipe.NamaTipe as TipeOlahraga, level.NamaLevel as Level, olahraga.Peralatan,
    olahraga.Deskripsi as Deskripsi, video.Durasi as Durasi, instruktur.NamaInstruktur as Instruktur, video.LinkVideo as Video, image.ImagePath as Image  
    FROM olahraga
    INNER JOIN tipe ON olahraga.IdTipe=tipe.Idtipe
    INNER JOIN level ON olahraga.IdLevel=level.IdLevel
    INNER JOIN video ON olahraga.IdVideo=video.IdVideo
    INNER JOIN instruktur ON olahraga.IdInstruktur=instruktur.IdInstruktur
    INNER JOIN Image ON olahraga.IdImage=image.IdImage 
    where olahraga.NamaOlahraga='".$search."' or tipe.NamaTipe='".$search."' or level.NamaLevel='".$search."'
    ";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="search.css">
</head>
<body>
<header>
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
                        echo'<form action="Search.php?search='.$search.'" method="POST">
                            <button type="submit" class="btn-link" value="logout" name="logout"> Logout </button></form>';
                            if(isset($_POST["logout"])){
                                session_destroy();
                                header("Location:Search.php?search=".$search);
                            }    
                    }
                ?>
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
    <?php
        $result=mysqli_query($conn, $sql);
        if (mysqli_num_rows($result)>0){
            echo "<h1 class='s'>Search for '".$search."'</h1>";
            while($row = mysqli_fetch_assoc($result)){
                
                echo "<div class='contain'><a href=detail.php?id=".$row['IdOlahraga']."><img src=".$row['Image'].">";
                echo "<div class='detail'><p class='detail'>Olahraga\t: ".$row['NamaOlahraga']."</p>";
                echo "<p class='detail'>Tipe\t: ".$row['TipeOlahraga']."</p>";
                echo "<p class='detail'>Level\t: ".$row['Level']."</p></div></a></div>";

            }
        }else{
            echo "<p class='s'> data tidak ditemukan</p>";
        }
        
    ?>
    
</body>
<footer>
        <p>© All Copyright goes to its rightful owner</p>
    </footer>
</html>