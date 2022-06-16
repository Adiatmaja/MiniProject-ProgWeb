<?php
require_once("connection.php");
session_start();

if(!isset($_SESSION["username"])){
    header("Location: login.php");
}elseif (isset($_POST["logout"])){
    session_destroy();
    header("Location:login.php");
}

$user = $_SESSION["username"];

$sqlSelectId = "SELECT IdVideo, IdImage FROM olahraga WHERE IdOlahraga = '".$_GET["id"]."'";
$result = mysqli_query($conn, $sqlSelectId);
$data = mysqli_fetch_assoc($result);
$sqlSelectGambar = "SELECT ImagePath FROM gambar WHERE IdImage = '".$data["IdImage"]."'";
$result2 = mysqli_query($conn, $sqlSelectGambar);
$sqlDeleteOlahraga = "DELETE FROM olahraga WHERE IdOlahraga = '".$_GET["id"]."'";
$sqlDeleteVideo = "DELETE FROM video WHERE IdVideo = '".$data["IdVideo"]."'";
$sqlDeleteImage = "DELETE FROM image WHERE IdImage = '".$data["IdImage"]."'";

if(mysqli_query($conn, $sqlDeleteOlahraga)){
    if(mysqli_query($conn, $sqlDeleteVideo)){
        if(mysqli_query($conn, $sqlDeleteImage)){
            echo "
            <script>
                alert('Data Berhasil Dihapus');
                document.location.href = 'dashboard.php';
            </script>
            ";
        } else {
            echo "
            <script>
                alert('Data Image Gagal Dihapus');
                document.location.href = 'dashboard.php';
            </script>
            ";
        }
    } else {
        echo "
        <script>
            alert('Data Video Gagal Dihapus');
            document.location.href = 'dashboard.php';
        </script>
        ";
    }
} else {
    echo "
    <script>
        alert('Data Olahraga Gagal Dihapus');
        document.location.href = 'dashboard.php';
    </script>
    ";
}
?>