 <?php
require('conn.php');
$write_id = mysqli_real_escape_string($connnect, $_POST['name']);
$write_title = mysqli_real_escape_string($connnect, $_POST['title']);
$write_content = mysqli_real_escape_string($connnect, $_POST['content']);
$write_lock_pw = mysqli_real_escape_string($connnect, $_POST['lock_pw']);
$write_date = date('Y-m-d H:i:s');
$write_date_now = date('Y-m-d H:i:s', strtotime($write_date."+9 hours"));
$write_URL = 'board.php';
$write_query = "INSERT INTO 
                    `board`
                    (`number`, `title`, `content`, `id`, `date`, `hit`, `lock_pw`) 
                    VALUES (NULL, '{$write_title}', '{$write_content}', '{$write_id}', '{$write_date_now}', '0', '{$write_lock_pw}')";
$write_result = mysqli_query($connnect, $write_query);

if ($write_result) { ?>
<script>
alert('<?php echo '글이 등록되었습니다.'?>');
location.replace('<?php echo $write_URL ?>');
</script>
<?php
} else {
    echo '글쓰기 실패';
}
mysqli_close($connnect);
?>