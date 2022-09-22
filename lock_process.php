<?php
require('conn.php');
$lock_number = mysqli_real_escape_string($connnect, $_POST['number']);
$lock_password = mysqli_real_escape_string($connnect, $_POST['lock_password']);
$lock_query = "SELECT `number`, `title`, `content`, `id`, `date`, `hit`, `lock_pw` FROM `board` WHERE `number`= $lock_number";
$lock_result = $connnect->query($lock_query);
$lock_rows = mysqli_fetch_assoc($lock_result);
if($lock_rows['lock_pw'] == $lock_password) { ?>
<script>
location.replace('read.php?number=<?php echo $lock_number?>');
</script>
<?php
} else { ?>
<script>
alert('비밀번호가 틀립니다.')
location.replace('lock.php?number=<?php echo $lock_number?>');
</script>
<?php }
?>