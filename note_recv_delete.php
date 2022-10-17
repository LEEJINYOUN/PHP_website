<?php
require('conn.php');
$delete_number = $_GET['idx'];
$recv_delete_query = "DELETE FROM recv_note WHERE `idx` = '$delete_number'";
$recv_delete_result = $connnect->query($recv_delete_query);

?>
<script>
alert('<?php echo '글이 삭제되었습니다.'?>');
location.replace('<?php echo 'note.php' ?>');
</script>