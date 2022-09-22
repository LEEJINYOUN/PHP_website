<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/board.css">
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    require('navbar.php');
    require('conn.php');
    $query = "SELECT * FROM `board`";
    $result = $connnect->query($query);
    ?>

    <?php
    if(isset($_GET['page'])) {
    $page = $_GET['page'];
    } else {
    $page = 1;
    }
    if(isset($_GET['pagination'])){
        $pagination = $_GET['pagination'];
    }else{
        $pagination = 1;
    }
    $page_query = "SELECT * FROM `board`";
    $page_result = $connnect->query($page_query);
    $page_total_board_num = mysqli_num_rows($page_result);
    $page_total_page_num = ceil($page_total_board_num / 10);
    $page_total_block_num = ceil($page_total_page_num / 5);
    $page_current_page_num = (($page - 1) * 10);
    $page_board_num_query = "SELECT *FROM `board` ORDER BY number DESC LIMIT $page_current_page_num, 10";
    $page_board_num_result = $connnect->query($page_board_num_query);
    $page_order_num = (($page - 1) * 10) + 1;
    ?>

    <section class="container">
        <h1 class="title">자유게시판</h1>
        <h4>자유롭게 글을 쓰고 읽을 수 있는 공간입니다.</h4>
        <table class="table">
            <thead class="thead">
                <tr class="tr">
                    <td class="td_total">No</td>
                    <td class="td_title">제목</td>
                    <td class="td_id">글쓴이</td>
                    <td class="td_date">작성일</td>
                    <td class="td_hit">조회수</td>
                </tr>
            </thead>
            <tbody class="tbody">
                <?php
                while($page_rows = mysqli_fetch_array($page_board_num_result)){
                    ?>
                <tr class="tr">
                    <td class="td_total td_contents">
                        <?php echo
                         $page_order_num ?>
                    </td>
                    <td class="td_title view_title td_contents">
                        <?php
                        $lockImg = "<img src='./icon/lock.jpg' alt='lock' class='lock'>";
                        $long_title = str_replace($page_rows['title'], mb_substr($page_rows['title'], 0, 30, "utf-8" )."...", $page_rows['title']);
                        $short_title = $page_rows['title'];
                        if ($page_rows['lock_pw'] != '') { ?>
                        <a href="lock.php?number=<?php echo $page_rows['number']?>" class="view">
                            <?php
                        if(mb_strlen($page_rows['title']) > 30){
                            echo $long_title, $lockImg; ?>
                            <div class="reply_count">[<?= $page_rows['reply_count']?>]</div>
                            <?php } else {
                            echo $short_title, $lockImg; ?>
                            <div class="reply_count">[<?= $page_rows['reply_count']?>]</div>
                            <?php } ?>
                        </a>
                        <?php } else {?>
                        <a href="read.php?number=<?php echo $page_rows['number']?>" class="view">
                            <?php 
                        if(mb_strlen($page_rows['title']) > 30){
                            echo $long_title; ?>
                            <div class="reply_count">[<?= $page_rows['reply_count']?>]</div>
                            <?php
                        } else {
                            echo $short_title; ?>
                            <div class="reply_count">[<?= $page_rows['reply_count']?>]</div>
                            <?php
                        }
                        ?>
                        </a>
                        <?php } ?>
                    </td>
                    <td class="td_id td_contents">
                        <?= htmlspecialchars($page_rows['id']) ?></td>
                    <td class="td_date td_contents">
                        <?= mb_substr($page_rows['date'], 0 , 10, "utf-8"); ?></td>
                    <td class="td_hit td_contents">
                        <?= htmlspecialchars($page_rows['hit']) ?>
                    </td>
                </tr>
                <?php
                $page_order_num++;
            }
            ?>
            </tbody>
        </table>
        <div class="board_pagination">
            <?php 
                $page_before = $pagination - 1;
                $page_after = $pagination + 1;
                $page_prev = $page_before * 5;
                $page_next = $page_after * 5 - 4;
                if($pagination > 1)
                {
                    echo "<a class='page_before_btn' href='board.php?pagination=$page_before&page=$page_prev'>&laquo;</a>";
                }
                for($i = $pagination * 5 - 4; $i <= $pagination * 5; $i++)
                {
                    if($i <= $page_total_page_num) {
                    echo "<a class='board_pagination_number' href='board.php?pagination=$pagination&page=$i'>[$i]</a>";
                    } else {
                        break;
                    }
                }
                if($pagination < $page_total_block_num) {
                    echo "<a class='page_after_btn' href='board.php?pagination=$page_after&page=$page_next'>&raquo;</a>";
                }
                ?>
        </div>
        <?php
    if(isset($_SESSION['id'])){?>
        <div class="btn">
            <a class="writeBtn" href="write.php">글쓰기</a>
        </div>
        <?php } ?>
    </section>
</body>

</html>