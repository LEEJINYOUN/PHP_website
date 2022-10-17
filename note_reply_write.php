<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/note_write.css">
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    require('navbar.php');
    require('conn.php');
    if(isset($_SESSION['id'])){
        $number = $_GET['idx'];
        $query = "SELECT * FROM `recv_note` WHERE `idx`= $number";
        $result = $connnect->query($query);
        $rows = mysqli_fetch_assoc($result);
    ?>
    <aside>
        <ul id="note_menu">
            <li><img src="/imgs/recv.png" alt="recv" title="recv" /><a href="note.php">받은쪽지함</a></li>
            <li><img src="/imgs/send.png" alt="recv" title="recv" /><a href="note_send.php">보낸쪽지함</a></li>
        </ul>
    </aside>
    <div id="write_note_in">
        <form action="note_reply_process.php" method="post" enctype="multipart/form-data">
            <div id="write_t">답장쓰기</div>
            <div id="write_form">
                <div class="wr_ip"><input type="text" name="recv_name" value="<?php echo $rows['send_id']; ?>"
                        readonly /></div>
                <div class="wr_ip wr_ip_top"><input type="text" name="note_reply_title" value="RE:" required /></div>
                <div class="wr_ip wr_ip_top"><textarea name="note_reply_content" placeholder="내용" required></textarea>
                </div>
                <button type="submit" class="wri_bt wr_ip_top">보내기</button>
            </div>
        </form>
    </div>
    <?php } ?>
</body>

</html>