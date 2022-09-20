<?php
    require('conn.php');
    $number = mysqli_real_escape_string($connnect, $_POST['number']);
    $lock_password = mysqli_real_escape_string($connnect, $_POST['lock_password']);
    $query = "SELECT `number`, `title`, `content`, `id`, `date`, `hit`, `lock_pw` FROM `board` WHERE `number`= $number";
    $result = $connnect->query($query);
    $rows = mysqli_fetch_assoc($result);
    if($rows['lock_pw'] == $lock_password) { ?>
<script>
location.replace('read.php?number=<?php echo $number?>');
</script>
<?php
    } else { ?>
<script>
alert('비밀번호가 틀립니다.')
location.replace('lock.php?number=<?php echo $number?>');
</script>
<?php }
?>