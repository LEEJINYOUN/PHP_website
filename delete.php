<?php
    session_start();
    require('conn.php');
    $number = $_GET['number'];
    $query = "DELETE FROM board WHERE `board`.`number` = '$number'";
    $query2 = "DELETE FROM `reply` WHERE `reply`.`board_num` = '$number'";
    $result = $connnect->query($query);
    $result2 = $connnect->query($query2);
?>
<script>
alert('<?php echo '글이 삭제되었습니다.'?>');
location.replace('<?php echo 'board.php' ?>');
</script>