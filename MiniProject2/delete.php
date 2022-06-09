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

$sql = "DELETE FROM olahraga WHERE IdOlahraga = '".$_GET["id"]."'";
if(mysqli_query($conn, $sql)){
    echo "
    <script>
        alert('Data Berhasil Dihapus');
        document.location.href = 'dashboard.php';
    </script>
    ";
} else {
    echo "
    <script>
        alert('Data Gagal Dihapus');
        document.location.href = 'dashboard.php';
    </script>
    ";
}
?>