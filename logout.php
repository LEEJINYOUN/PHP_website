<?php 
session_start();
$logout_session = session_destroy();
if($logout_session){
    echo "<script>location.href='board.php';</script>";
}
?>