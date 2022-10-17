<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/navbar.css">
    <title>Document</title>
</head>

<body>
    <?php
    if( (!isset($_SESSION['id']))){  ?>
    <section class="navbar">
        <a href="board.php" class="brand-title">웹 게시판</a>
        <div class="navbar-links">
            <ul>
                <li><a href="login.php" class="move">로그인</a></li>
                <li><a href="join.php" class="move">회원가입</a></li>
            </ul>
        </div>
    </section>
    <?php } else { ?>
    <section class="navbar">
        <a href="board.php" class="brand-title">웹 게시판</a>
        <div class="navbar-links">
            <ul>
                <li><a class="id_mark"><?php echo $_SESSION['id'].'님 환영합니다'?></a></li>
                <li><a href="note.php" class="note">쪽지함</a></li>
                <li><a href="logout.php" class="move">로그아웃</a></li>
            </ul>
        </div>
    </section>
    <?php } ?>
</body>

</html>