<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/note_send_read.css">
    <title>Document</title>
</head>

<body>
    <?php 
    session_start();
    require('navbar.php');
    require('conn.php');
    $number = $_GET['idx'];
    $query = "SELECT * FROM `send_note` WHERE `idx`= $number";
    $result = $connnect->query($query);
    $rows = mysqli_fetch_assoc($result);
    if(isset($_SESSION['id'])) {?>
    <aside>
        <ul id="note_menu">
            <li><img src="/icon/recv.png" alt="recv" title="recv" /><a href="note.php">받은쪽지함</a></li>
            <li><img src="/icon/send.png" alt="recv" title="recv" /><a href="note_send.php">보낸쪽지함</a></li>
        </ul>
    </aside>
    <div id="note_read">
        <div id="note_read_bt">
            <a href="note_send_delete.php?idx=<?php echo $rows['idx']; ?>" class="del_bt">삭제</a>
        </div>
        <div id="no_ri_line"></div>
        <div id="note_info">
            <div id="user_info">
                <ul>
                    <li><b>보낸사람</b>&nbsp;&nbsp;&nbsp;<?php echo $rows['send_id']; ?></li>
                    <li><b>받는사람</b>&nbsp;&nbsp;&nbsp;<?php echo $rows['recv_id']; ?></li>
                    <li><b>보낸시간</b>&nbsp;&nbsp;&nbsp;<?php echo $rows['send_date']; ?></li>
                </ul>
                <div id="no_ri_line"></div>
            </div>
            <div id="bo_content">
                <?php echo nl2br("$rows[note_content]"); ?>
            </div>
        </div>
    </div>
    <?php 
    }
?>
</body>

</html>