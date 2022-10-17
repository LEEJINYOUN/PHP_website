<?php
require('conn.php');
$join_id = mysqli_real_escape_string($connnect, $_POST['id']);
$join_pw = mysqli_real_escape_string($connnect, $_POST['pw']);
$join_name = mysqli_real_escape_string($connnect, $_POST['name']);
$join_email = mysqli_real_escape_string($connnect, $_POST['email']);
$join_date = date('Y-m-d H:i:s');
$join_date_now = date('Y-m-d H:i:s', strtotime($join_date."+9 hours"));
$join_query = "SELECT * FROM `member` WHERE id='$join_id'";
$join_result = mysqli_query($connnect, $join_query);

if($join_result->num_rows > 0) {
    $join_row = mysqli_fetch_assoc($join_result);
    $join_id = $join_row['id'];
    echo "<script>alert('존재하는 아이디입니다');</script>";
    echo "<script>location.href='join.php';</script>";
}
else {
    $join_insert_query = "INSERT INTO `member`(`id`, `pw`, `name`, `email`, `date`, `permit`) VALUES ('$join_id','$join_pw','$join_name','$join_email','$join_date_now','0')";
    $join_insert_result = $connnect->query($join_insert_query);
    $join_id = mysqli_insert_id($connnect);
    echo "<script>alert('회원가입 성공');</script>";
}
echo "<script>location.href='board.php';</script>";
?>