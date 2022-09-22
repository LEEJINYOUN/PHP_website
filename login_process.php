<?php
session_start();
require('conn.php');
$login_id = mysqli_real_escape_string($connnect, $_POST['id']);
$login_pw = mysqli_real_escape_string($connnect, $_POST['pw']);
$login_query = "SELECT * FROM `member` WHERE id='$login_id' and pw='$login_pw'";
$login_result = $connnect->query($login_query);
$login_row = mysqli_fetch_array($login_result);
if ($login_result -> num_rows > 0){
    $_SESSION['id'] = $login_row['id'];
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