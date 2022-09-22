<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/write.css">
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    require('conn.php');
    $modify_number = $_GET['number'];
    $modify_query = "SELECT `title`, `content`, `id`, `date`, `lock_pw` FROM `board` WHERE number = $modify_number";
    $modify_result = $connnect->query($modify_query);
    $modify_rows = mysqli_fetch_assoc($modify_result);
    
    $modify_title = $modify_rows['title'];
    $modify_content = $modify_rows['content'];
    $modify_userid = $modify_rows['id'];
    ?>

    <section class="modify_container">
        <form class="modify_form" action="modify_process.php" method="post">
            <table class="write_table_one" border="0" cellspacing="2">
                <tr>
                    <td class="write_td_one">
                        <span>글수정</span>
                    </td>
                </tr>
                <tr>
                    <td class="write_td_two">
                        <table class="write_table_two">
                            <tr class="write_tr_two">
                                <td class="write_tr_td_one">작성자</td>
                                <td class="write_tr_td_two">
                                    <input type="hidden" name="name" value="<?=$_SESSION['id']?>"><?=$_SESSION['id']?>
                                </td>
                            </tr>
                            <tr>
                                <td class="write_tr_td_one">제목</td>
                                <td class="write_tr_td_two"><input type="text" name="title" size="60"
                                        value="<?=$modify_title?>"></td>
                            </tr>
                            <tr>
                                <td class="write_tr_td_one">내용</td>
                                <td class="write_tr_td_two"><textarea name="content" cols="85"
                                        rows="15"><?=$modify_content?></textarea></td>
                            </tr>
                            <tr>
                                <td class="write_tr_td_one">잠금 비밀번호</td>
                                <td class="write_tr_td_two"><input type="text" name="lock_pw" size="10"></td>
                            </tr>
                        </table>
                        <div class="btns">
                            <input type="hidden" name="number" value="<?=$modify_number?>">
                            <input type="submit" value="작성" class="modifyBtn">
                            <a href="read.php?number=<?=$modify_number?>" class="cancelBtn">취소</a>
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </section>


</body>

</html>