<?php
session_start();
require('conn.php');
if(isset($_SESSION['id'])){
$note_reply_recv_id = mysqli_real_escape_string($connnect, $_POST['recv_name']);
$note_reply_send_id = mysqli_real_escape_string($connnect, $_SESSION['id']);
$note_reply_title = mysqli_real_escape_string($connnect, $_POST['note_reply_title']);
$note_reply_content = mysqli_real_escape_string($connnect, $_POST['note_reply_content']);

$send_reply_URL = 'note_send.php';

$send_reply_query = "INSERT INTO 
                    `send_note`
                    (`idx`, `recv_id`, `send_id`, `note_title`, `note_content`, `recv_chk`)
                    VALUES (NULL, '{$note_reply_recv_id}', '{$note_reply_send_id}', '{$note_reply_title}', '{$note_reply_content}', '0')";

$recv_reply_query = "INSERT INTO 
                    `recv_note`
                    (`idx`, `recv_id`, `send_id`, `note_title`, `note_content`)
                    VALUES (NULL, '{$note_reply_recv_id}', '{$note_reply_send_id}', '{$note_reply_title}', '{$note_reply_content}')";

$send_result = mysqli_query($connnect, $send_reply_query);
$recv_result = mysqli_query($connnect, $recv_reply_query);

if ($send_result && $recv_result) { ?>
<script>
alert('<?php echo '글이 등록되었습니다.'?>');
location.replace('<?php echo $send_reply_URL ?>');
</script>
<?php
    } else {
        echo '글쓰기 실패';
    } }
    mysqli_close($connnect);
?>