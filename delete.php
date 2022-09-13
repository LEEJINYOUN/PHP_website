<?php
    session_start();
    require('conn.php');
    $number = $_GET['number'];
    $query = "DELETE FROM board WHERE `board`.`number` = '$number'";
    $result = $connnect->query($query);
?>
<script>
alert('<?php echo '글이 삭제되었습니다.'?>');
location.replace('<?php echo 'board.php' ?>');
</script>