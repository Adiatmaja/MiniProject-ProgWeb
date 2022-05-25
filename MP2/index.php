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
                    <a href="login.php">Login</a>
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
                    $counter=0;
                    echo "
                    <h2>".$row2['NamaLevel']."</h2>
                    <div class='levels'>
                    "; 
                    if (mysqli_num_rows($result)>0){
                        while($row = mysqli_fetch_assoc($result)){
                            if($row["Level"]==$row2["NamaLevel"]){
                                if($counter>=3){
                                    echo "</div>";
                                    echo "<div class='levels'>";
                                    $counter=0;
                                }
                                echo "
                                <div class='description'>
                                    <a href=detail.php?id=".$row['IdOlahraga']."><img src=".$row["Image"]." alt=''>
                                    <h2 class='judul'>".$row['NamaOlahraga']."</h2></a>
                                </div>";
                                $counter+=1;   
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