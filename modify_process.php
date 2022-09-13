<?php
require('conn.php');
$number = mysqli_real_escape_string($connnect, $_POST['number']);
$title = mysqli_real_escape_string($connnect, $_POST['title']);
$content = mysqli_real_escape_string($connnect, $_POST['content']);
$date = date('Y-m-d H:i:s');
$date_now = date('Y-m-d H:i:s', strtotime($date."+9 hours"));
$query = "UPDATE `board` SET `title`='$title',`content`='$content',`date`='$date_now' WHERE `number`='$number'";
$result = $connnect->query($query);

if($result) {
?>
<script>
alert('수정되었습니다');
location.replace("read.php?number=<?php echo $number?>");
</script>
<?php
} else {
    echo 'fail';
}
?>