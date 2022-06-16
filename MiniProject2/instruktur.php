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

$id = null;
if (isset($_GET["id"])){
    $id = $_GET["id"];
    $IdInstruktur = $_GET["id"];

    $sql = "SELECT * FROM instruktur WHERE IdInstruktur = '".$IdInstruktur."'";
    $result = mysqli_query($conn,$sql);
    $data = mysqli_fetch_assoc($result);
    
    $nama = $data["NamaInstruktur"];
} else if (empty($_GET["id"])){
    $nama = '';
}

if ($_POST){
    if (($_POST["IdInstruktur"]) != null) {
        $NamaInstruktur = $_POST["NamaInstruktur"];
        $IdInstruktur = $_POST["IdInstruktur"];
        $sql = "UPDATE instruktur SET 
        NamaInstruktur = '".$NamaInstruktur."' 
        WHERE IdInstruktur = '".$IdInstruktur."' ";
        
        if (mysqli_query($conn, $sql)) {
            echo "
            <script>
                alert('Update Data Berhasil');
                document.location.href = 'dashboard.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Update Data Gagal');
                document.location.href = 'dashboard.php';
            </script>
            ";
        }
    } else {
        $NamaInstruktur = $_POST["NamaInstruktur"];
    
        $sql = "INSERT INTO instruktur VALUES ('', '".$NamaInstruktur."')";

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
    <form class="formdata" action="instruktur.php" method="post">
        <table>
            <input type="hidden" name="IdInstruktur" value="<?php if($id!=0) {echo $IdInstruktur;}?>">
            <tr>
                <td>Nama Instruktur</td>
                <td><input type="text" name="NamaInstruktur" value="<?= $nama;?>" required></td>
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