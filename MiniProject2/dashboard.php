<?php
require_once("connection.php");
session_start();

if(!isset($_SESSION["username"])){
    header("Location: login.php");
}elseif (isset($_POST["logout"])){
    session_destroy();
    header("Location:login.php");
}

$user=$_SESSION["username"];

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
    <title>Document</title>
    <link rel="stylesheet" href="dashboard.css">
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
    <div class="produk">
        <table>
            <tr>
                <th>Nama Olahraga</th>
                <th>Tipe Olahraga</th>
                <th>Level</th>
                <th>Peralatan</th>
                <th>Durasi</th>
                <th>Instruktur</th>
                <th>Action</th>
            </tr>
            <?php
                if (mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<tr>";
                        echo "<td>".$row['NamaOlahraga']."</td>";
                        echo "<td>".$row['TipeOlahraga']."</td>";
                        echo "<td>".$row['Level']."</td>";
                        echo "<td>".$row['Peralatan']."</td>";
                        echo "<td>".$row['Durasi']."</td>";
                        echo "<td>".$row['Instruktur']."</td>";
                        echo "<td><a href=''>Edit </a><a href=''>Delete</a></td>";
                        echo "</tr>";
                    }
                }
            ?>
        </table>
    </div>
</body>
<footer>
        <p>© All Copyright goes to its rightful owner</p>
    </footer>
</html>