<?php
require_once("connection.php");
if($_GET){
    $id=$_GET['id'];
    $sql="
    SELECT olahraga.idolahraga as IdOlahraga, olahraga.NamaOlahraga as NamaOlahraga, tipe.NamaTipe as TipeOlahraga, level.NamaLevel as Level, olahraga.Peralatan,
    olahraga.Deskripsi as Deskripsi, video.Durasi as Durasi, instruktur.NamaInstruktur as Instruktur, video.LinkVideo as Video, image.ImagePath as Image  
    FROM olahraga
    INNER JOIN tipe ON olahraga.IdTipe=tipe.Idtipe
    INNER JOIN level ON olahraga.IdLevel=level.IdLevel
    INNER JOIN video ON olahraga.IdVideo=video.IdVideo
    INNER JOIN instruktur ON olahraga.IdInstruktur=instruktur.IdInstruktur
    INNER JOIN image ON olahraga.IdImage=image.IdImage where IdOlahraga=".$id;
    $result=mysqli_query($conn, $sql);
    if (mysqli_num_rows($result)>0){
        $row=mysqli_fetch_assoc($result);
        $nama=$row["NamaOlahraga"];
        $tipe=$row["TipeOlahraga"];
        $level=$row["Level"];
        $desc=$row["Deskripsi"];
        $dur=$row["Durasi"];
        $peralatan=$row["Peralatan"];
        $Instruktur=$row["Instruktur"];
        $image=$row["Image"];
        $video=$row["Video"];
    }else{
        echo "data tidak ada";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $nama?></title>
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
                <?php
                    session_start();
                    if(!isset($_SESSION['username'])){
                        echo ("<a href='login.php'>Login</a>");
                    }else if(isset($_SESSION['username'])){
                        echo"<a href='dashboard.php'>Dashboard</a>";
                        echo'<form action="Detail.php?id='.$id.'" method="POST">
                            <button type="submit" class="btn-link" value="logout" name="logout"> Logout </button></form>';
                        
                            if(isset($_POST["logout"])){
                                session_destroy();
                                header("Location:Detail.php?id=".$id);
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
    <div class="title">
        <h1><?php echo $nama?></h1>
    </div>
    <div class="image">
        <img src=<?php echo $image?> alt="">
    </div>
    
    <div class="container">
        <h2>About</h2>
        <div class="info">
            <table>
                <tr>
                    <td>Instruktur</td>
                    <td>: <?php echo $Instruktur?></td>
                </tr>
                <tr>
                    <td>Tipe Olahraga</td>
                    <td>: <?php echo $tipe?></td>
                </tr>
                <tr>
                    <td>Duration</td>
                    <td>: <?php echo $dur?> min</td>
                </tr>
                <tr>
                    <td>Level</td>
                    <td>: <?php echo $level?></td>
                </tr>
                <tr>
                    <td>Peralatan</td>
                    <td>: <?php
                    if($peralatan!=null){
                        echo $peralatan;
                    }else{
                        echo "-";
                    }
                    ?></td>
                </tr>
            </table>
        </div> 
    
        <div class="desc">
            <p>
            <?php echo $desc?>
            </p>
        </div>
    </div>
    <div class="video">
        <h2>Video</h2>
        <?php echo $video?>
    </div>
    
</body>
<footer>
        <p>© All Copyright goes to its rightful owner</p>
</footer>
</html>