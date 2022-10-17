<?php
session_start();
require('conn.php');
if(isset($_SESSION['id'])){
$note_recv_id = mysqli_real_escape_string($connnect, $_POST['recv_name']);
$note_send_id = mysqli_real_escape_string($connnect, $_SESSION['id']);
$note_title = mysqli_real_escape_string($connnect, $_POST['note_title']);
$note_content = mysqli_real_escape_string($connnect, $_POST['note_content']);

$send_URL = 'note_send.php';

$send_query = "INSERT INTO 
                    `send_note`
                    (`idx`, `recv_id`, `send_id`, `note_title`, `note_content`, `recv_chk`)
                    VALUES (NULL, '{$note_recv_id}', '{$note_send_id}', '{$note_title}', '{$note_content}', '0')";

$recv_query = "INSERT INTO 
                    `recv_note`
                    (`idx`, `recv_id`, `send_id`, `note_title`, `note_content`)
                    VALUES (NULL, '{$note_recv_id}', '{$note_send_id}', '{$note_title}', '{$note_content}')";

$send_result = mysqli_query($connnect, $send_query);
$recv_result = mysqli_query($connnect, $recv_query);

if ($send_result && $recv_result) { ?>
<script>
alert('<?php echo '글이 등록되었습니다.'?>');
location.replace('<?php echo $send_URL ?>');
</script>
<?php
} else {
    echo '글쓰기 실패';
} }
mysqli_close($connnect);
?>