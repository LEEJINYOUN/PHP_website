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
    require('navbar.php');
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
    $number = $_GET['number'];
    $reply_page = $_GET['page'];
    } else {
    $reply_page = 1;
    }
    if(isset($_GET['pagination'])){
        $reply_pagination = $_GET['pagination'];
    }else{
        $reply_pagination = 1;
    }
    $reply_query = "SELECT * FROM `reply`";
    $reply_result = $connnect->query($reply_query);
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
        ?>
        <div class="reply_post">
            <?php
        while($rows = mysqli_fetch_array($reply_result)) {
            if ($rows['board_num'] == $number) {?>
            <div class="reply_post_card">
                <div class="reply_post_card_top">
                    <div class="reply_post_card_top_NameDate">
                        <span class="reply_post_card_top_name"><?= $rows['name']?></span>
                        <span class="reply_post_card_top_date"><?= $rows['date']?></span>
                    </div>
                    <?php
                if(isset($_SESSION['id'])) {
                    if($_SESSION['id'] == $rows['name']) {
                        echo
                        "<div class='reply_post_card_top_btn'>
                            <a class='reply_delete_btn' href='reply_delete_process.php?number=".$rows['number']."&board_num=".$rows['board_num']."'>삭제</a>
                        </div>";
                    }
                }
                ?>
                </div>
                <div class="reply_post_card_botton">
                    <?= $rows['content']?>
                </div>
            </div>
            <?php } } ?>
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