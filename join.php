<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/join.css">
    <title>Document</title>
</head>

<body>
    <div class="bg-img">
        <div class="content">
            <header>회원가입</header>
            <form action="join_process.php" method="post">
                <div class="field">
                    <span class="fa fa-user"></span>
                    <input type="text" name="id" required placeholder="아이디" />
                </div>
                <div class="field space">
                    <span class="fa fa-lock"></span>
                    <input type="password" name="pw" required placeholder="비밀번호" />
                </div>
                <div class="field space">
                    <span class="fa fa-user"></span>
                    <input type="text" name="name" required placeholder="이름" />
                </div>
                <div class="field space">
                    <span class="fa fa-user"></span>
                    <input type="text" name="email" required placeholder="이메일" />
                </div>
                <div class="field">
                    <input type="submit" value="회원가입" />
                </div>
            </form>
            <div class="signup">
                <a href="login.php">로그인</a>
                <a href="board.php">게시판</a>
            </div>
        </div>
    </div>
</body>

</html>