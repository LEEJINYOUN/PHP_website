<?php
require('conn.php');
$reply_board_num = mysqli_real_escape_string($connnect, $_POST['number']);
$reply_name = mysqli_real_escape_string($connnect, $_POST['name']);
$reply_content = mysqli_real_escape_string($connnect, $_POST['content']);
$reply_date = date('Y-m-d H:i:s');
$reply_date_now = date('Y-m-d H:i:s', strtotime($reply_date."+9 hours"));
$reply_query = "INSERT INTO
                    `reply`(`number`, `board_num`, `name`, `content`, `date`)
                    VALUES (NULL, '{$reply_board_num}', '{$reply_name}', '{$reply_content}', '{$reply_date_now}')";
$reply_result = mysqli_query($connnect, $reply_query);
$reply_count_query = "UPDATE `board` SET `reply_count` = reply_count + 1 WHERE `number`='$reply_board_num'";
$connnect->query($reply_count_query);

if ($reply_result) { ?>
<script>
location.replace("read.php?number=<?php echo $reply_board_num?>");
</script>
<?php
} else {
    echo '댓글 작성 실패';
}
mysqli_close($connnect);
?>