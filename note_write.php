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
    if(isset($_SESSION['id']))
    {
    ?>
    <script type="text/javascript">
    function adr_im() {
        window.name = "adrload";
        window.open("adress_import.php", "주소록 가져오기", "width=700, height=600");
    }
    </script>
    <aside>
        <ul id="note_menu">
            <li><img src="/icon/recv.png" alt="recv" title="recv" /><a href="note.php">받은쪽지함</a></li>
            <li><img src="/icon/send.png" alt="recv" title="recv" /><a href="note_send.php">보낸쪽지함</a></li>
        </ul>
    </aside>
    <div id="write_note_in">
        <form action="note_write_process.php" method="post" enctype="multipart/form-data">
            <div id="write_t">쪽지쓰기</div>
            <div id="write_form">
                <?php
                if(isset($_POST['addck']))
                {
                    $smt = $_POST['addck'];
                }else{
                    $smt="";
                }?>
                <div class="wr_ip">
                    <input type="text" name="recv_name" placeholder="받는사람" value="<?php echo $smt;?>" required />
                    <span id="add_bt" onclick="adr_im();">주소록</span>
                </div>
                <div class="wr_ip wr_ip_top"><input type="text" name="note_title" placeholder="제목" required /></div>
                <div class="wr_ip wr_ip_top"><textarea name="note_content" placeholder="내용" required></textarea></div>
                <button type="submit" class="wri_bt wr_ip_top">보내기</button>
            </div>
        </form>
        <?php } ?>

</body>

</html>