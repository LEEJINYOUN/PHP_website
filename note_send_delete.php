<?php
require('conn.php');
$delete_number = $_GET['idx'];
$send_delete_query = "DELETE FROM send_note WHERE `idx` = '$delete_number'";
$send_delete_result = $connnect->query($send_delete_query);

?>
<script>
alert('<?php echo '글이 삭제되었습니다.'?>');
location.replace('<?php echo 'note_send.php' ?>');
</script>