<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="readport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/read.css">
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    require('conn.php');
    $number = $_GET['number'];
    $query = "SELECT `number`, `title`, `content`, `id`, `date`, `hit` FROM `board` WHERE `number`= $number";
    $hit = "UPDATE `board` SET `hit`=hit + 1 WHERE `number`='$number'";
    $connnect->query($hit);
    $result = $connnect->query($query);
    $rows = mysqli_fetch_assoc($result);
    ?>
    <?php
    $bno = $_GET['number'];
    $sql = "SELECT * FROM board WHERE `number` = '$bno'";
    ?>

    <section class="read_container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="read_th" colspan="3">게시판 글보기</th>
                </tr>
            </thead>
            <tbody>
                <tr class="read_tr_title">
                    <td class="read_td_title_one">글제목</td>
                    <td colspan="2"><?php echo $rows['title']?></td>
                </tr>
                <tr class="read_tr_id">
                    <td>작성자</td>
                    <td colspan="2"><?=htmlspecialchars($rows['id'])?></td>
                </tr>
                <tr class="read_tr_date">
                    <td>작성일자</td>
                    <td colspan="2"><?=htmlspecialchars($rows['date'])?></td>
                </tr>
                <tr class="read_tr_content">
                    <td class="read_td_content_one">내용</td>
                    <td class="read_td_content_two" colspan="2">
                        <?=htmlspecialchars($rows['content'])?></td>
                </tr>
            </tbody>
        </table>
        <?php if(isset($_SESSION['id'])) { 
        if($_SESSION['id'] == $rows['id']) {
        echo
        "<div class='btns'>
            <a class='mainBtn' href='board.php'>목록</a>
            <a class='modifyBtn' href='modify.php?number=".$rows['number']."'>수정</a>
            <a class='deleteBtn' href='delete.php?number=".$rows['number']."'>삭제</a>
        </div>";
        }
        else if ($_SESSION['id'] != $rows['id']) {
            echo 
            "<div class='btns'>
                <a class='mainBtn' href='board.php'>목록</a>
            </div>";
        }
        } else {
            echo 
            "<div class='btns'>
                <a class='mainBtn' href='board.php'>목록</a>
            </div>";
         }?>
    </section>
</body>

</html>