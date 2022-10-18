<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/note_send_read.css">
    <script defer src="./js/note_send_read.js"></script>
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    require('navbar.php');
    require('conn.php');
    $number = $_GET['idx'];
    $query = "SELECT * FROM `recv_note` WHERE `idx`= $number";
    $result = $connnect->query($query);
    $rows = mysqli_fetch_assoc($result);
    $re_da = $rows['send_date'];
    $rec_chk = 1;
    $fet = "UPDATE `send_note` SET `recv_chk`= $rec_chk WHERE `send_date`= '$re_da'";
    $connnect->query($fet);
    if(isset($_SESSION['id'])) { ?>
    <aside>
        <ul id="note_menu">
            <li><img src="/icon/recv.png" alt="recv" title="recv" /><a href="note.php">받은쪽지함</a></li>
            <li><img src="/icon/send.png" alt="recv" title="recv" /><a href="note_send.php">보낸쪽지함</a></li>
        </ul>
    </aside>
    <div id="note_read">
        <div id="note_read_bt">
            <a href="note_recv_delete.php?idx=<?php echo $rows['idx']; ?>" class="del_bt">삭제</a>
            <a href="note_reply_write.php?idx=<?php echo $rows['idx']; ?>" class="dap_bt">답장</a>
            <a class="dap_bt" id="fr_bt" href="#">주소록 추가</a>
        </div>
        <div id="frn_cre">
            <div id="frn_t">주소록 추가</div>
            <div id="no_ri_line"></div>
            <div id="frn_st">선택한 사용자를 추가합니다.</div>
            <form action="friends_process.php" method="post">
                <table class="frn-table">
                    <thead>
                        <tr>
                            <th width="120" class="tc">아이디</th>
                            <th width="120" class="tc">이름</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr align="center">
                            <td><input type="text" name="fri_id" value="<?php echo $rows['send_id']; ?>" size="15"
                                    readonly /></td>
                            <td><input type="text" name="user_name" required="required" size="15" /></td>
                        </tr>
                    </tbody>
                </table>
                <div id="frn_bt" class="tc">
                    <button type="submit" id="frn_submit">확인</button>
                    <button type="button" id="frn_cancel">취소</button>
                </div>
            </form>
        </div>
        <div id="no_ri_line"></div>
        <div id="note_info">
            <div id="user_info">
                <ul>
                    <li><b>보낸사람</b>&nbsp;&nbsp;&nbsp;<?php echo $rows['send_id']; ?></li>
                    <li><b>받은시간</b>&nbsp;&nbsp;&nbsp;<?php echo $rows['send_date']; ?></li>
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