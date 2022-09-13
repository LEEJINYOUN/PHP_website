<?php
require('conn.php');
$id = mysqli_real_escape_string($connnect, $_POST['id']);
$pw = mysqli_real_escape_string($connnect, $_POST['pw']);
$date = date('Y-m-d H:i:s');
$date_now = date('Y-m-d H:i:s', strtotime($date."+9 hours"));
$query = "select * from member where id='$id'";
$result = mysqli_query($connnect, $query);

if($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    $id = $row['id'];
    echo "<script>alert('존재하는 아이디입니다');</script>";
    echo "<script>location.href='join.php';</script>";
}
else {
    $query = "INSERT INTO `member`(`id`, `pw`, `date`, `permit`) VALUES ('$id','$pw','$date_now','0')";
    $result = $connnect->query($query);
    $id = mysqli_insert_id($connnect);
    echo "<script>alert('회원가입 성공!');</script>";
}
echo "<script>location.href='board.php';</script>";
?>