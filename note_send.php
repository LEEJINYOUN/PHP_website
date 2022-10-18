<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/note.css">
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    require('navbar.php');
    require('conn.php');
    if( (isset($_SESSION['id']))){ ?>
    <aside>
        <ul id="note_menu">
            <li><img src="/icon/recv.png" alt="recv" title="recv" /><a href="note.php"><b>받은쪽지함</b></a></li>
            <li><img src="/icon/send.png" alt="recv" title="recv" /><a href="note_send.php">보낸쪽지함</a></li>
        </ul>
    </aside>
    <div id="main_in">
        <table class="list-table">
            <thead>
                <tr>
                    <th width="50" class="tc"><input type="checkbox" /></th>
                    <th width="150" class="tl">받는사람</th>
                    <th width="600" class="tl">내용</th>
                    <th width="200" class="tc">날짜</th>
                    <th width="100" class="tc">수신여부</th>
                </tr>
            </thead>
            <?php
            $sql = "SELECT *FROM `send_note` WHERE send_id= '".$_SESSION['id']."' ORDER BY idx DESC";
            $result = $connnect->query($sql);
            while($rows = mysqli_fetch_array($result)){
                $note_title = $rows['note_title']; 
                if(strlen($note_title)>30)
                { 
                    $note_title = str_replace($rows['note_title'],mb_substr($rows['note_title'],0,30,"utf-8")."...",$rows['note_title']);
                }
            ?>
            <tbody>
                <tr>
                    <td class="tc"><input type="checkbox" /></td>
                    <td><?php echo $rows['recv_id'];?></td>
                    <td><a href='note_send_read.php?idx=<?php echo $rows['idx']; ?>'><?php echo $note_title; ?></a>
                    </td>
                    <td class="tc"><?php echo $rows['send_date']; ?></td>
                    <td class="tc">
                        <?php 
              if($rows['recv_chk'] == "0")
              {
                echo "읽지않음";
              }else{ 
                echo "읽음";
              }
            ?>
                    </td>
                </tr>
            </tbody>
            <?php } ?>
        </table>
        <div id="note_bt">
            <ul>
                <li id="wri_m_bt"><a href="note_write.php">쪽지쓰기</a></li>
            </ul>
        </div>
    </div>
    <?php }?>
</body>

</html>