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
    $query ="SELECT * FROM board";
    $result = $connnect->query($query);
    $total = mysqli_num_rows($result);
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
    $sql = "select *from board";
    $res = $connnect->query($sql);
    $totalboardnum = mysqli_num_rows($res);
    $totalpagenum = ceil($totalboardnum/10);
    $totalblocknum = ceil($totalpagenum/5);
    $currentpagenum = (($page-1)*10);
    $sql2 = "select *from board order by number desc limit $currentpagenum,10";
    $res2 = $connnect->query($sql2);
    $num2=(($page-1)*10)+1;
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
                while($rows=mysqli_fetch_array($res2)){
                    ?>
                <tr class="tr">
                    <td class="td_total td_contents">
                        <?php echo
                         $num2 ?>
                    </td>
                    <td class="td_title view_title td_contents">
                        <?php
                        $lockImg = "<img src='./icon/lock.jpg' alt='lock' class='lock'>";
                        if ($rows['lock_pw'] != '') { ?>
                        <a href="lock.php?number=<?php echo $rows['number']?>" class="view">
                            <?php
                        if(mb_strlen($rows['title']) > 30){
                            echo $title = str_replace($rows['title'], mb_substr($rows['title'],0,30,"utf-8")."...",$rows['title']), $lockImg; ?>
                            <div class="reply_count">[<?= $rows['reply_count']?>]</div>
                            <?php } else {
                            echo $title2 = $rows['title'], $lockImg; ?>
                            <div class="reply_count">[<?= $rows['reply_count']?>]</div>
                            <?php } ?>
                        </a>
                        <?php } else {?>
                        <a href="read.php?number=<?php echo $rows['number']?>" class="view">
                            <?php 
                        if(mb_strlen($rows['title']) > 30){
                            echo $title = str_replace($rows['title'], mb_substr($rows['title'],0,30,"utf-8")."...",$rows['title']); ?>
                            <div class="reply_count">[<?= $rows['reply_count']?>]</div>
                            <?php
                        } else {
                            echo $title2 = $rows['title']; ?>
                            <div class="reply_count">[<?= $rows['reply_count']?>]</div>
                            <?php
                        }
                        ?>
                        </a>
                        <?php } ?>
                    </td>
                    <td class="td_id td_contents">
                        <?=htmlspecialchars($rows['id'])?></td>
                    <td class="td_date td_contents">
                        <?= mb_substr($rows['date'], 0 , 10, "utf-8");?></td>
                    <td class="td_hit td_contents">
                        <?=htmlspecialchars($rows['hit'])?>
                    </td>
                </tr>
                <?php
            $num2++;
            }
            ?>
            </tbody>
        </table>
        <div class="board_pagination">
            <?php 
                $before=$pagination-1;
                $after=$pagination+1;
                $before2=$before*5;
                $after2=$after*5-4;
                if($pagination>1)
                {
                    echo "<a class='page_before_btn' href='board.php?pagination=$before&page=$before2'>&laquo;</a>";
                }
                for($i=$pagination*5-4; $i<=$pagination*5; $i++)
                {
                    if($i<=$totalpagenum) {
                    echo "<a class='board_pagination_number' href='board.php?pagination=$pagination&page=$i'>[$i]</a>";
                    } else {
                        break;
                    }
                }
                if($pagination<$totalblocknum) {
                    echo "<a class='page_after_btn' href='board.php?pagination=$after&page=$after2'>&raquo;</a>";
                }
                ?>
        </div>
        <?php
    if(isset($_SESSION['id'])){?>
        <div class="btn">
            <a class="writeBtn" href="write.php">글쓰기</a>
        </div>

        <?php
        }
            ?>
    </section>


</body>

</html>