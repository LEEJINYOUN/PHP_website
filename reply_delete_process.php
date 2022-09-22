<?php
    session_start();
    require('conn.php');
    $number = $_GET['number'];
    $board_num = $_GET['board_num'];
    $query = "DELETE FROM reply WHERE `reply`.`number` = '$number'";
    $result = $connnect->query($query);
    $query2 = "UPDATE `board` SET `reply_count`=reply_count - 1 WHERE `number`='$board_num'";
    $connnect->query($query2);
?>
<script>
location.replace("read.php?number=<?php echo $board_num?>");
</script>