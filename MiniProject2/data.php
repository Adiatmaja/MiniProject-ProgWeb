<?php
require_once("connection.php");
session_start();

// Sampe Pre Fill Link Video

if (isset($_GET["id"])){
    $IdOlahraga = $_GET["id"];

    $sql="
    SELECT olahraga.idolahraga as IdOlahraga, olahraga.NamaOlahraga as NamaOlahraga, tipe.NamaTipe as TipeOlahraga, level.NamaLevel as Level, olahraga.Peralatan,
    olahraga.Deskripsi as Deskripsi, video.Durasi as Durasi, instruktur.NamaInstruktur as Instruktur, video.LinkVideo as Video, image.ImagePath as Image  
    FROM olahraga
    INNER JOIN tipe ON olahraga.IdTipe=tipe.Idtipe
    INNER JOIN level ON olahraga.IdLevel=level.IdLevel
    INNER JOIN video ON olahraga.IdVideo=video.IdVideo
    INNER JOIN instruktur ON olahraga.IdInstruktur=instruktur.IdInstruktur
    INNER JOIN Image ON olahraga.IdImage=image.IdImage
    WHERE IdOlahraga = '".$IdOlahraga."'
    ";
    $result = mysqli_query($conn,$sql);
    $data = mysqli_fetch_assoc($result);

    $NamaOlahraga = $data["NamaOlahraga"];
    $Deskripsi = $data["Deskripsi"];
    $Peralatan = $data["Peralatan"];
    $IdVideo = $data["Video"];
    $Durasi = $data["Durasi"];
} else {
    $NamaOlahraga = '';
    $Deskripsi = '';
    $Peralatan = '';
    $IdVideo = '';
    $Durasi = '';
}

if ($_POST){
    if (empty($_GET["id"])) {
        $NamaOlahraga = $_POST["NamaOlahraga"];
        $IdTipe = $_POST["IdTipe"];
        $IdLevel = $_POST["IdLevel"];
        $IdInstruktur = $_POST["IdInstruktur"];
        $Deskripsi = $_POST["Deskripsi"];
        $Peralatan = $_POST["Peralatan"];
        $LinkVideo = "<iframe src='" . $_POST["IdVideo"] . "'></iframe>";
        $Durasi = $_POST["Durasi"];
        $IdImage = $_POST["IdImage"];
        // Insert Tabel Video
        $sql = "INSERT INTO video VALUES ('', '$LinkVideo', '$Durasi')";
        if (mysqli_query($conn, $sql)) {
            // Insert Tabel Image
            if (isset($_FILES)){
                $targetFolder = "pictures/";
                $path = $targetFolder.$_FILES['Image']['name'];
                $extension = pathinfo($path, PATHINFO_EXTENSION);
                if(move_uploaded_file($_FILES['Image']['tmp_name'], $path)){
                    $sql = "INSERT INTO image VALUES ('', '$path')";
                    if (mysqli_query($conn, $sql)) {
                        // Insert Tabel Olahraga
                        $Video = "SELECT IdVideo FROM video WHERE LinkVideo = '".$LinkVideo."'";
                        $Image = "SELECT IdImage FROM image WHERE ImagePath = '".$path."'";
                        $sql = "INSERT INTO olahraga VALUES ('', '$NamaOlahraga', '$IdTipe', '$IdLevel', '$IdInstruktur', '$Deskripsi', $Peralatan, $Video, $Image)";
                        if (mysqli_query($conn, $sql)) {
                            echo "
                            <script>
                                alert('Data Berhasil Ditambah');
                                document.location.href = 'dashboard.php';
                            </script>
                            ";
                        } else {
                            echo "
                            <script>
                                alert('Data Gagal Ditambah');
                                document.location.href = 'dashboard.php';
                            </script>
                            ";
                        }
                    }
                } else {
                    echo "
                    <script>
                        alert('Gagal Upload Gambar');
                        document.location.href = 'dashboard.php';
                    </script>
                    ";
                }
            }
        } else {
            echo "
            <script>
                alert('Data Video Gagal Ditambah');
                document.location.href = 'dashboard.php';
            </script>
            ";
        }
    } else if ($_GET["id"]) {
        $NamaOlahraga = $_POST["NamaOlahraga"];
        $IdTipe = $_POST["IdTipe"];
        $IdLevel = $_POST["IdLevel"];
        $IdInstruktur = $_POST["IdInstruktur"];
        $Deskripsi = $_POST["Deskripsi"];
        $Peralatan = $_POST["Peralatan"];
        $LinkVideo = "<iframe src='" . $_POST["IdVideo"] . "'></iframe>";
        $Durasi = $_POST["Durasi"];
        $IdImage = $_POST["IdImage"];
        // Update Tabel Video
        $sql = "UPDATE video SET LinkVideo = '$LinkVideo', Durasi = '$Durasi' WHERE IdVideo = '".$IdVideo."'";
        if (mysqli_query($conn, $sql)) {
            // Update Tabel Image
            if (isset($_FILES)){
                $targetFolder = "pictures/";
                $path = $targetFolder.$_FILES['Image']['name'];
                $extension = pathinfo($path, PATHINFO_EXTENSION);
                if(move_uploaded_file($_FILES['Image']['tmp_name'], $path)){
                    $sql = "UPDATE image SET ImagePath = '$path' WHERE IdImage = '".$IdImage."'";
                    if (mysqli_query($conn, $sql)) {
                        // Update Tabel Olahraga
                        $Video = "SELECT IdVideo FROM video WHERE LinkVideo = '".$LinkVideo."'";
                        $Image = "SELECT IdImage FROM image WHERE ImagePath = '".$path."'";
                        $sql = "UPDATE olahraga SET NamaOlahraga = '$NamaOlahraga', IdTipe = '$IdTipe', IdLevel = '$IdLevel', IdInstruktur = '$IdInstruktur', Deskripsi = '$Deskripsi', Peralatan = '$Peralatan', IdVideo = '$Video', IdImage = '$Image' WHERE IdOlahraga = '".$IdOlahraga."'";
                        if (mysqli_query($conn, $sql)) {
                            echo "
                            <script>
                                alert('Data Berhasil Diupdate');
                                document.location.href = 'dashboard.php';
                            </script>
                            ";
                        } else {
                            echo "
                            <script>
                                alert('Data Gagal Diupdate');
                                document.location.href = 'dashboard.php';
                            </script>
                            ";
                        }
                    }
                } else {
                    echo "
                    <script>
                        alert('Gagal Update Gambar');
                        document.location.href = 'dashboard.php';
                    </script>
                    ";
                }
            }
        } else {
            echo "
            <script>
                alert('Data Video Gagal Diubah');
                document.location.href = 'dashboard.php';
            </script>
            ";
        }
    }
}


$user=$_SESSION["username"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="data.css">
</head>
<body>
    <header>
        <!-- <iframe src=""></iframe> -->
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
    <a class="back" href="dashboard.php">Kembali</a>
    <form class="formdata" action="data.php" method="post">
        <table>
            <input type="hidden" name="IdOlahraga" value="<?= $data["IdOlahraga"];?>">
            <tr>
                <td>Nama Olahraga</td>
                <td><input type="text" name="NamaOlahraga" value="<?= $NamaOlahraga ?>" required></td>
            </tr>
            <tr>
                <td>Tipe Olahraga</td>
                <td><select name="IdTipe">
                    <option value="1">Yoga</option>
                    <option value="2">HIIT</option>
                    <option value="3">Cardio</option>
                </select></td>
            </tr>
            <tr>
                <td>Level Olahraga</td>
                <td><select name="IdLevel">
                    <option value="1">Beginner</option>
                    <option value="2">Intermediate</option>
                    <option value="3">Advanced</option>
                </select></td>
            </tr>
            <tr>
                <td>Instruktur</td>
                <td><select name="IdInstruktur">
                    <option value="1">Jason Charchan</option>
                    <option value="2">Adriene Mishler</option>
                    <option value="3">Zen Dude</option>
                    <option value="4">Sashah Handal</option>
                    <option value="5">Charlee Atkens</option>
                    <option value="6">Briohny Smyth</option>
                </select></td>
            </tr>
            <tr>
                <td>Deskripsi Olahraga</td>
                <td><input type="text" name="Deskripsi" value="<?= $Deskripsi ?>" required></td>
            </tr>
            <tr>
                <td>Peralatan</td>
                <td><input type="text" name="Peralatan" value="<?= $Peralatan ?>"></td>
            </tr>
            <tr>
                <td>Link Video</td>
                <td><input type="url" name="LinkVideo" value="<?= $IdVideo ?>"></td>
            </tr>
            <tr>
                <td>Durasi Video</td>
                <td><input type="text" name="Durasi" value="<?= $Durasi ?>" required></td>
            </tr>
            <tr>
                <td>Gambar Olahraga</td>
                <td><input type="file" name="Image"></td>
            </tr>
            <tr>
                <td class="submit" colspan="2"><input class="button" type="submit" class="submit" value="submit"></td>
            </tr>
        </table>
    </form>
</body>
<footer>
        <p>© All Copyright goes to its rightful owner</p>
    </footer>
</html>