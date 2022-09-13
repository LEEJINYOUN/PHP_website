 <?php
require('conn.php');
$id = mysqli_real_escape_string($connnect, $_POST['name']);
$title = mysqli_real_escape_string($connnect, $_POST['title']);
$content = mysqli_real_escape_string($connnect, $_POST['content']);
$date = date('Y-m-d H:i:s');
$date_now = date('Y-m-d H:i:s', strtotime($date."+9 hours"));
$URL = 'board.php';
$query = "INSERT INTO 
                    `board`
                    (`number`, `title`, `content`, `id`, `date`, `hit`) 
                    VALUES (NULL,'{$title}','{$content}','{$id}','{$date_now}','0')";
$result = mysqli_query($connnect, $query);

if ($result) { ?>
<script>
alert('<?php echo '글이 등록되었습니다.'?>');
location.replace('<?php echo $URL ?>');
</script>
<?php
}
else {
    echo 'fail';
}
mysqli_close($connnect);
?>