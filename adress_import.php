<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/adress_import.css">
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    require('conn.php');
    ?>
    <h2>쪽지 주소록 추가</h2>
    <div id="add_line"></div>
    <div id="add_list">
        <form action="note_write.php" method="post" target="adrload">
            <table class="list-table" id="add_table">
                <thead>
                    <tr>
                        <th width="100">선택</th>
                        <th width="200">아이디</th>
                        <th width="300">이름</th>
                    </tr>
                </thead>
                <?php
                $query = "SELECT * FROM `friends` WHERE `user`= '$_SESSION[id]' ORDER BY idx DESC";
                $result = $connnect->query($query);
                while($rows = $result->fetch_array()){
                ?>
                <tbody>
                    <tr class="tc">
                        <td><input type="radio" name="addck" value="<?php echo $rows['fri_id']; ?>" ;" /></td>
                        <td><?php echo $rows['fri_id']; ?></td>
                        <td><?php echo $rows['fri_name']; ?></td>
                    </tr>
                </tbody>
                <?php } ?>
            </table>
            <div class="AddBtn">
                <button onclick="close_wri();" id="ad_bt">추가하기</button>
            </div>

        </form>
    </div>
    <script type="text/javascript">
    function close_wri() {
        self.close();
    }
    </script>
</body>

</html>