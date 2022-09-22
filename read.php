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
    if(isset($_GET['page'])) {
    $page2 = $_GET['page'];
    } else {
    $page2 = 1;
    }
    if(isset($_GET['pagination'])){
        $pagination2 = $_GET['pagination'];
    }else{
        $pagination2 = 1;
    }
    $sql2 = "select *from reply";
    $res2 = $connnect->query($sql2);
    $totalboardnum2 = mysqli_num_rows($res2);
    $totalpagenum2 = ceil($totalboardnum2/5);
    $totalblocknum2 = ceil($totalpagenum2/5);
    $currentpagenum2 = (($page2-1)*5);
    $sql3 = "select *from reply order by number desc limit $currentpagenum2, 5";
    $res3 = $connnect->query($sql3);
    $num3=(($page2-1)*5)+1;
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

        <?php
        $number = $_GET['number'];
        $query2 = "SELECT * FROM `reply`";
        $result2 = $connnect->query($query2);
        while($rows = mysqli_fetch_array($res3)) {
            if ($rows['board_num'] == $number) {?>
        <div class="reply_post">
            <div class="reply_post_left">
                <div class="reply_post_name">
                    <input type="hidden" name="name" value="<?= $rows['name']?>"><?= $rows['name']?>
                </div>
                <div class="reply_post_content">
                    <textarea name="content" cols="150" rows="6"
                        readonly><?= $rows['content']?> <?= $rows['date']?></textarea>
                </div>
            </div>


            <?php
        if(isset($_SESSION['id'])) { 
            if($_SESSION['id'] == $rows['name']) {
                echo
                "<div class='reply_post_right'>
                    <a class='reply_delete_Btn' href='reply_delete_process.php?number=".$rows['number']."&board_num=".$rows['board_num']."'>삭제</a>
                </div>";
            }
            }}
        }
        ?>
        </div>

        <div class="board_pagination">
            <?php 
                $before2=$pagination2-1;
                $after2=$pagination2+1;
                $before3=$before2*5;
                $after3=$after2*5-4;
                if($pagination2>1)
                {
                    echo "<a class='page_before_btn' href='read.php?number=$number&pagination=$before2&page=$before3'>&laquo;</a>";
                }
                for($i2=$pagination2*5-4; $i2<=$pagination2*5; $i2++)
                {
                    if($i2<=$totalpagenum2) {
                    echo "<a class='board_pagination_number' href='read.php?number=$number&pagination=$pagination2&page=$i2'>[$i2]</a>";
                    } else {
                        break;
                    }
                }
                if($pagination2<$totalblocknum2) {
                    echo "<a class='page_after_btn' href='read.php?number=$number&pagination=$after2&page=$after3'>&raquo;</a>";
                }
                ?>
        </div>

        <?php
        if(isset($_SESSION['id'])) { ?>
        <div class="reply_create">
            <form action="reply_process.php" method="post">
                <div class="reply_name"><input type="hidden" name="name"
                        value="<?=$_SESSION['id']?>"><?=$_SESSION['id']?></div>
                <div class="reply_content"><textarea name="content" cols="150" rows="6" required
                        placeholder="댓글을 입력하세요."></textarea></div>
                <div class="reply_btn">
                    <input type="hidden" name="number" value="<?=$number?>">
                    <input type="submit" value="댓글등록" class="replyBtn">
                </div>
            </form>
        </div>
        <?php } ?>
    </section>
</body>

</html>