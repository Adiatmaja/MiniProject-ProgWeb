<?php
require_once("connection.php");
$search=null;
$sql="SELECT * FROM `Olahraga` WHERE IdOlahraga='null'";
if($_GET){
    if(isset($_GET['search'])){
        $search=$_GET['search'];
        $sql="
        SELECT olahraga.idolahraga as IdOlahraga, olahraga.NamaOlahraga as NamaOlahraga, tipe.NamaTipe as TipeOlahraga, level.NamaLevel as Level, olahraga.Peralatan,
        olahraga.Deskripsi as Deskripsi, video.Durasi as Durasi, instruktur.NamaInstruktur as Instruktur, video.LinkVideo as Video, image.ImagePath as Image  
        FROM olahraga
        INNER JOIN tipe ON olahraga.IdTipe=tipe.Idtipe
        INNER JOIN level ON olahraga.IdLevel=level.IdLevel
        INNER JOIN video ON olahraga.IdVideo=video.IdVideo
        INNER JOIN instruktur ON olahraga.IdInstruktur=instruktur.IdInstruktur
        INNER JOIN image ON olahraga.IdImage=image.IdImage 
        where olahraga.NamaOlahraga LIKE '%".$search."%' or tipe.NamaTipe LIKE '%".$search."%' or level.NamaLevel LIKE '%".$search."%'
        ";
    }else{
        if($_GET['Nama']==null&&$_GET['tipe']==null&&$_GET['level']==null){
        }else{
            if($_GET['Nama']==null){
                $nama="= 0";
            }else{
                $nama=$_GET['Nama'];
                $nama="LIKE '%".$nama."%'";
            }
            if($_GET['tipe']==null){
                $tipe=0;
            }else{
                $tipe=$_GET['tipe'];
                $tipe="'".$tipe."'";
            }
            if($_GET['level']==null){
                $level=0;
            }else{
                $level=$_GET['level'];
                $level="'".$level."'";
            }

            $sql="
            SELECT olahraga.idolahraga as IdOlahraga, olahraga.NamaOlahraga as NamaOlahraga, tipe.NamaTipe as TipeOlahraga, level.NamaLevel as Level, olahraga.Peralatan,
            olahraga.Deskripsi as Deskripsi, video.Durasi as Durasi, instruktur.NamaInstruktur as Instruktur, video.LinkVideo as Video, image.ImagePath as Image  
            FROM olahraga
            INNER JOIN tipe ON olahraga.IdTipe=tipe.Idtipe
            INNER JOIN level ON olahraga.IdLevel=level.IdLevel
            INNER JOIN video ON olahraga.IdVideo=video.IdVideo
            INNER JOIN instruktur ON olahraga.IdInstruktur=instruktur.IdInstruktur
            INNER JOIN image ON olahraga.IdImage=image.IdImage 
            where olahraga.NamaOlahraga ".$nama." and tipe.NamaTipe = ".$tipe." and level.NamaLevel= ".$level."
            ";
        }
    }
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
    <button type="button" class="collapsible">Advanced Search</button>
    <div class="content">
    <form action="search.php" method="GET">
        <table>
            <tr><td>
            Nama Olahraga:
                </td><td>
            <input type="text" name="Nama" ><br>
            </td></tr>
            <tr><td>
            Tipe:
            </td><td>
            <?php
                $sql2="Select DISTINCT Tipe.NamaTipe as Tipe from tipe ";
                $result2=mysqli_query($conn, $sql2);
                if (mysqli_num_rows($result2)>0){
                    echo "<select name='tipe'>";
                    echo "<option value=''>None</option>";
                    while($row2 = mysqli_fetch_assoc($result2)){
                        echo "<option value=".$row2['Tipe'].">".$row2['Tipe']."</option>";
                    }
                }echo"</select><br>";

            ?>
            </td></tr>
            <tr><td>
            Level:
            </td><td>
            <?php
                $sql3="Select DISTINCT Level.NamaLevel as Level from level ";
                $result3=mysqli_query($conn, $sql3);
                if (mysqli_num_rows($result3)>0){
                    echo "<select name='level'>";
                    echo "<option value=''>None</option>";
                    while($row3 = mysqli_fetch_assoc($result3)){
                        echo "<option value=".$row3['Level'].">".$row3['Level']."</option>";
                    }
                }echo"</select><br>";
                
            ?>
            </td></tr>
        </table>
        <input type="submit" value="search">

    </form>
    </div>

    <script>
        var coll = document.getElementsByClassName("collapsible");
        var i;
        coll[0].addEventListener("click", function() {
            var content = this.nextElementSibling;
            if (content.style.display === "block") {
            content.style.display = "none";
            } else {
            content.style.display = "block";
            }
        });
        
</script>
    <?php
        $result=mysqli_query($conn, $sql);
        if (mysqli_num_rows($result)>0){
            if(isset($search)){
            echo "<h1 class='s'>Search for '".$search."'</h1>";}
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