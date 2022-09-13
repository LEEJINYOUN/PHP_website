<?php
session_start();
require('conn.php');
$id = mysqli_real_escape_string($connnect, $_POST['id']);
$pw = mysqli_real_escape_string($connnect, $_POST['pw']);
$sql = "select * from member where id='$id' and pw='$pw'";
$result = $connnect->query($sql);
$row = mysqli_fetch_array($result);
if ($result -> num_rows > 0){
    $_SESSION['id'] = $row['id'];
    if(isset($_SESSION['id'])) {
        echo "<script>location.href='board.php';</script>";
    }
    else {
        echo "<script>alert('로그인 실패.');</script>";
        echo "<script>location.href='login.php';</script>";
    }
}
else {
    echo "<script>alert('로그인 실패.');</script>";
    echo "<script>location.href='login.php';</script>";
}
?>