<?php
require('conn.php');
$reply_delete_number = $_GET['number'];
$reply_delete_board_num = $_GET['board_num'];
$reply_delete_query = "DELETE FROM reply WHERE `reply`.`number` = '$reply_delete_number'";
$reply_delete_result = $connnect->query($reply_delete_query);
$reply_count_delete_query = "UPDATE `board` SET `reply_count` = reply_count - 1 WHERE `number`='$reply_delete_board_num'";
$connnect->query($reply_count_delete_query);
?>
<script>
location.replace("read.php?number=<?php echo $reply_delete_board_num?>");
</script>