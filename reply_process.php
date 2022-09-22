<?php
require('conn.php');
$board_num = mysqli_real_escape_string($connnect, $_POST['number']);
$name = mysqli_real_escape_string($connnect, $_POST['name']);
$content = mysqli_real_escape_string($connnect, $_POST['content']);
$date = date('Y-m-d H:i:s');
$date_now = date('Y-m-d H:i:s', strtotime($date."+9 hours"));
$query = "INSERT INTO
                    `reply`(`number`, `board_num`, `name`, `content`, `date`)
                    VALUES (NULL, '{$board_num}', '{$name}', '{$content}', '{$date_now}')";
$result = mysqli_query($connnect, $query);
$query2 = "UPDATE `board` SET `reply_count`=reply_count + 1 WHERE `number`='$board_num'";
$connnect->query($query2);

if ($result) { ?>
<script>
location.replace("read.php?number=<?php echo $board_num?>");
</script>
<?php
    }
    else {
        echo 'fail';
    }
    mysqli_close($connnect);
?>