<?php
require('conn.php');
$delete_number = $_GET['number'];
$delete_board_query = "DELETE FROM board WHERE `board`.`number` = '$delete_number'";
$delete_reply_query = "DELETE FROM `reply` WHERE `reply`.`board_num` = '$delete_number'";
$delete_board_result = $connnect->query($delete_board_query);
$delete_reply_result = $connnect->query($delete_reply_query);
?>
<script>
alert('<?php echo '글이 삭제되었습니다.'?>');
location.replace('<?php echo 'board.php' ?>');
</script>