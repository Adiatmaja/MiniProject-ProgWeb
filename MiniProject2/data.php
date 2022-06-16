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


$sqlInstruktur = "SELECT * FROM instruktur";
$resultInstruktur = mysqli_query($conn,$sqlInstruktur);

$targetFolder = "assets/";

$id = null;
if (isset($_GET["id"])){
    $id = $_GET["id"];
    $IdOlahraga = $_GET["id"];

    $sql="
    SELECT olahraga.idolahraga as IdOlahraga, olahraga.NamaOlahraga as NamaOlahraga, tipe.NamaTipe as TipeOlahraga, level.NamaLevel as Level, olahraga.Peralatan,
    olahraga.Deskripsi as Deskripsi, video.Durasi as Durasi, instruktur.IdInstruktur, instruktur.NamaInstruktur as Instruktur, video.LinkVideo as Video, image.ImagePath as Image  
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
    $NamaTipe = $data["TipeOlahraga"];
    $NamaLevel = $data["Level"];
    $IdInstruktur = $data["IdInstruktur"];
    $Deskripsi = $data["Deskripsi"];
    $Peralatan = $data["Peralatan"];
    $IdVideo = $data["Video"];
    $Durasi = $data["Durasi"];
} else {
    $NamaOlahraga = '';
    $NamaTipe = '';
    $NamaLevel = '';
    $IdInstruktur = '';
    $Deskripsi = '';
    $Peralatan = '';
    $IdVideo = '';
    $Durasi = '';
}

if ($_POST){
    $IdTipe = $_POST["IdTipe"];
    $IdLevel = $_POST["IdLevel"];
    $IdInstruktur = $_POST["IdInstruktur"];
    if ($IdTipe != null && $IdLevel != null && $IdInstruktur != null){
        if ($_POST["IdOlahraga"] != null) {
            $IdOlahraga = $_POST["IdOlahraga"];
            $NamaOlahraga = $_POST["NamaOlahraga"];
            $Deskripsi = $_POST["Deskripsi"];
            $Peralatan = $_POST["Peralatan"];
            $LinkVideo = $_POST["LinkVideo"];
            $Durasi = $_POST["Durasi"];
            

            $sqlSelectVideoGambar = "SELECT IdVideo, IdImage FROM olahraga WHERE IdOlahraga = '".$IdOlahraga."'";
            $resultSelectVideoGambar = mysqli_query($conn,$sqlSelectVideoGambar);
            $dataSelectVideoGambar = mysqli_fetch_assoc($resultSelectVideoGambar);
            $IdVideo = $dataSelectVideoGambar["IdVideo"];
            $IdImage = $dataSelectVideoGambar["IdImage"];
            $sqlSelectGambar = "SELECT ImagePath FROM image WHERE IdImage = '".$IdImage."'";
            $resultSelectGambar = mysqli_query($conn,$sqlSelectGambar);
            $dataSelectGambar = mysqli_fetch_assoc($resultSelectGambar);
            $OldImage = $dataSelectGambar["ImagePath"];
            
            // Cek Format File
            $extension = pathinfo($_FILES["Image"]["name"], PATHINFO_EXTENSION);
            $extension = strtolower($extension);
            if($extension == "jpg" || $extension == "jpeg" || $extension == "png"){
                // Update Tabel Video
                $sqlVideo = "UPDATE video SET 
                            LinkVideo = '".$LinkVideo."', 
                            Durasi = '".$Durasi."' 
                            WHERE IdVideo = '".$IdVideo."'";
                if (mysqli_query($conn, $sqlVideo)) {
                    // Update Tabel Image
                    if (isset($_FILES)){
                        $temp = explode(".", $_FILES['Image']['name']);
                        $FileName = round(microtime(true)) . '.' . end($temp); // Rename File berdasarkan waktu sekarang
                        $path = $targetFolder.$FileName;
                        if(move_uploaded_file($_FILES['Image']['tmp_name'], $path)){
                            $sqlGambar = "UPDATE image SET 
                                        ImagePath = '".$path."' 
                                        WHERE IdImage = '".$IdImage."'";
                            if (mysqli_query($conn, $sqlGambar)) {
                                // Update Tabel Olahraga
                                $Video = "SELECT IdVideo FROM video WHERE LinkVideo = '".$LinkVideo."'";
                                $resultVideo = mysqli_query($conn, $Video);
                                $dataVideo = mysqli_fetch_assoc($resultVideo);
                                $Image = "SELECT IdImage FROM image WHERE ImagePath = '".$path."'";
                                $resultImage = mysqli_query($conn, $Image);
                                $dataImage = mysqli_fetch_assoc($resultImage);
                                $sqlOlahraga = "UPDATE olahraga SET 
                                                NamaOlahraga = '".$NamaOlahraga."', 
                                                IdTipe = '".$IdTipe."', 
                                                IdLevel = '".$IdLevel."', 
                                                IdInstruktur = '".$IdInstruktur."', 
                                                Deskripsi = '".$Deskripsi."', 
                                                Peralatan = '".$Peralatan."', 
                                                IdVideo = '".$dataVideo["IdVideo"]."', 
                                                IdImage = '".$dataImage["IdImage"]."' 
                                                WHERE IdOlahraga = '".$IdOlahraga."'";
                                if (mysqli_query($conn, $sqlOlahraga) && unlink($OldImage)) {
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
                                    </script>
                                    ";
                                }
                            }
                        } else {
                            echo "
                            <script>
                                alert('Gagal Update Gambar');
                            </script>
                            ";
                        }
                    }
                } else {
                    echo "
                    <script>
                        alert('Data Video Gagal Diupdate');
                    </script>
                    ";
                }
            } else {
                echo "
                <script>
                    alert('Format File Tidak Sesuai');
                </script>
                ";
            }
        }else {
            $NamaOlahraga = $_POST["NamaOlahraga"];
            $Deskripsi = $_POST["Deskripsi"];
            $Peralatan = $_POST["Peralatan"];
            $LinkVideo = $_POST["LinkVideo"];
            $Durasi = $_POST["Durasi"];
            
            // Cek Format File
            $extension = pathinfo($_FILES['Image']['name'], PATHINFO_EXTENSION);
            $extension = strtolower($extension);
            if ($extension == "jpg" || $extension == "png" || $extension == "jpeg") {
                // Insert Tabel Video
                $sqlVideo = "INSERT INTO video VALUES ('', '".$LinkVideo."', '".$Durasi."')";
                if (mysqli_query($conn, $sqlVideo)) {
                    // Insert Tabel Image
                    if (isset($_FILES)){
                        $temp = explode(".", $_FILES['Image']['name']);
                        $FileName = round(microtime(true)) . '.' . end($temp); // Rename File berdasarkan waktu sekarang
                        $path = $targetFolder.$FileName;
                        if(move_uploaded_file($_FILES['Image']['tmp_name'], $path)){
                            $sqlGambar = "INSERT INTO image VALUES('', '".$path."')";
                            if (mysqli_query($conn, $sqlGambar)) {
                                // Insert Tabel Olahraga
                                $Video = "SELECT IdVideo FROM video WHERE LinkVideo = '".$LinkVideo."'";
                                $resultVideo = mysqli_query($conn, $Video);
                                $dataVideo = mysqli_fetch_assoc($resultVideo);
                                $Image = "SELECT IdImage FROM image WHERE ImagePath = '".$path."'";
                                $resultImage = mysqli_query($conn, $Image);
                                $dataImage = mysqli_fetch_assoc($resultImage);
                                $sqlOlahraga = "INSERT INTO olahraga VALUES ('', '".$NamaOlahraga."', '".$IdTipe."', '".$IdLevel."', '".$IdInstruktur."', '".$Deskripsi."', '".$Peralatan."', '".$dataVideo["IdVideo"]."', '".$dataImage["IdImage"]."')";
                                if (mysqli_query($conn, $sqlOlahraga)) {
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
                                    </script>
                                    ";
                                }
                            }
                        } else {
                            echo "
                            <script>
                                alert('Gagal Upload Gambar');
                            </script>
                            ";
                        }
                    }
                } else {
                    echo "
                    <script>
                        alert('Data Video Gagal Ditambah');
                    </script>
                    ";
                }
            } else {
                echo "
                <script>
                    alert('Format File Gambar Tidak Sesuai');
                </script>
                ";
            }
        }
    } else {
        echo "
        <script>
            alert('Data Tidak Boleh Kosong');
        </script>
        ";
    }
}

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
    <form class="formdata" action="data.php" method="post" enctype="multipart/form-data">
        <table>
            <input type="hidden" name="IdOlahraga" value="<?php if($id!=0) {echo $IdOlahraga;}?>">
            <tr>
                <td>Nama Olahraga</td>
                <td><input type="text" name="NamaOlahraga" value="<?= $NamaOlahraga ?>" required></td>
            </tr>
            <tr>
                <td>Tipe Olahraga</td>
                <td><select name="IdTipe">
                    <option id="Tipe" value=""></option>
                    <option id="Tipe" value="1" <?php if($NamaTipe == 'Yoga'){echo " selected =\"selected\"";} ?>>Yoga</option>
                    <option id="Tipe" value="2" <?php if($NamaTipe == 'HIIT'){echo " selected =\"selected\"";} ?>>HIIT</option>
                    <option id="Tipe" value="3" <?php if($NamaTipe == 'Cardio'){echo " selected =\"selected\"";} ?>>Cardio</option>
                </select></td>
            </tr>
            <tr>
                <td>Level Olahraga</td>
                <td><select name="IdLevel">
                    <option id="Level" value=""></option>
                    <option id="Level" value="1" <?php if($NamaLevel == 'Beginner'){echo " selected =\"selected\"";} ?>>Beginner</option>
                    <option id="Level" value="2" <?php if($NamaLevel == 'Intermediate'){echo " selected =\"selected\"";} ?>>Intermediate</option>
                    <option id="Level" value="3" <?php if($NamaLevel == 'Advanced'){echo " selected =\"selected\"";} ?>>Advanced</option>
                </select></td>
            </tr>
            <tr>
                <td>Instruktur</td>
                <td><select name="IdInstruktur">
                    <option value=""></option>
                    <?php while($rowInstruktur = mysqli_fetch_row($resultInstruktur)) {
                        echo "<option id='Instruktur' value = '{$rowInstruktur[0]}'";
                        if($rowInstruktur[0] == $IdInstruktur){
                            echo " selected =\"selected\"";
                        }
                        echo ">{$rowInstruktur[1]}</option>";
                    } ?>
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
                <td>Link Video (Embed)</td>
                <td><input type="text" name="LinkVideo" id="Link" value='<?= $IdVideo ?>' required></td>
            </tr>
            <tr>
                <td>Durasi Video</td>
                <td><input type="number" name="Durasi" value="<?= $Durasi ?>" required></td>
            </tr>
            <tr>
                <td>Gambar Olahraga </td>
                <td rowspan="2"><input type="file" name="Image" value="" required></td>
            </tr>
            <tr>
                <td>(JPG / JPEG / PNG)</td>
                <td></td>
            </tr>
            <tr class="alert">
                <td class="alert" id="alert" colspan="2"></td>
                <td></td>
            </tr>
            <tr>
                <td class="submit" colspan="2"><input class="button" type="submit" class="submit" value="submit" onclick="validation()"></td>
            </tr>
        </table>
    </form>

    <script type="text/javascript">
        var inpLink = document.getElementById('Link');
        var regex = /embed/;

        function validation() {
            document.getElementById('alert').innerHTML = "";
            if(!regex.test(inpLink.value)) {
                document.getElementById('alert').innerHTML = "Mohon gunakan fitur embed pada tombol share video";
                event.preventDefault();
            }
        }
    </script>
</body>
<footer>
        <p>© All Copyright goes to its rightful owner</p>
    </footer>
</html>