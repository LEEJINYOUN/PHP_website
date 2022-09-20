<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="readport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/lock.css">
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    require('conn.php');
    $number = $_GET['number'];
    $query = "SELECT `lock_pw` FROM `board` WHERE number = $number";
    $result = $connnect->query($query);
    $rows = mysqli_fetch_assoc($result);
    ?>

    <section class="lock_container">
        <form action="lock_process.php" method="post">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="lock_th" colspan="3">비밀글입니다</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="lock_tr_title">
                        <td class="lock_tr_td_one">비밀번호
                            <input type="hidden" name="number" value="<?=$number?>">
                            <input type="text" name="lock_password" size="10">
                            <input type="submit" value="확인">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </section>

</body>

</html>