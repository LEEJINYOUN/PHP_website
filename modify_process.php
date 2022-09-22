<?php
require('conn.php');
$modify_number = mysqli_real_escape_string($connnect, $_POST['number']);
$modify_title = mysqli_real_escape_string($connnect, $_POST['title']);
$modify_content = mysqli_real_escape_string($connnect, $_POST['content']);
$modify_newlock_pw = mysqli_real_escape_string($connnect, $_POST['lock_pw']);
$modify_date = date('Y-m-d H:i:s');
$modify_date_now = date('Y-m-d H:i:s', strtotime($modify_date."+9 hours"));
$modify_query = "UPDATE `board` SET `title`='$modify_title', `content`='$modify_content', `lock_pw`='$modify_newlock_pw', `date`='$modify_date_now' WHERE `number`='$modify_number'";
$modify_result = $connnect->query($modify_query);

if($modify_result) { ?>
<script>
alert('글이 수정되었습니다');
location.replace("read.php?number=<?php echo $modify_number?>");
</script>
<?php
} else {
    echo '글 수정 실패';
}
?>