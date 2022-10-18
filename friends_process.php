<?php
session_start();
require('conn.php');
if(isset($_SESSION['id'])){
$fri_id = mysqli_real_escape_string($connnect, $_POST['fri_id']);
$user_name = mysqli_real_escape_string($connnect, $_POST['user_name']);
$fri_query = "SELECT * FROM `friends` WHERE fri_id= '$fri_id'";
$fri_result = mysqli_query($connnect, $fri_query);

if($fri_result->num_rows > 0){
    echo "<script>alert('이미 추가되어있습니다.'); history.back();</script>";
}
else {
    $fri_insert_query = "INSERT INTO
                        `friends`
                        (`idx`, `user`, `fri_id`, `fri_name`)
                        VALUES (NULL, '{$_SESSION['id']}', '{$fri_id}', '{$user_name}')";
    $fri_insert_result = $connnect->query($fri_insert_query);

	echo "<script>alert('사용자를 추가했습니다.');</script>";
	}
}
echo "<script>location.href='note.php';</script>";

?>