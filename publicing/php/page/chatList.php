<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>우리끼리 | 채팅목록</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/Main.css">
    <script src="../../js/main.js"></script>
</head>

<body>

    <?php include '../inc/menu.php' ?>
    <?php include '../inc/Dbcnt.php' ?>

    <?php
    $sql = "SELECT * FROM users WHERE id = '" . $_SESSION['username'] . "' LIMIT 1;";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $id = $row["idx"];
    $sql = "SELECT * FROM chat_room WHERE (host_user_idx = '" . $row["idx"] . "') OR (member_user_idx = '" . $row["idx"] . "') ORDER BY idx DESC";
    $result = $conn->query($sql);
    ?>


    <div class="SectionBox">

        <div class="ChatListBoxx">

            <!--
            <a href="chating.php">
                <div class="ChatListItem">
                    <div class="ChatListItemImgBox">
                        <img src="../../../source/img/user.png" class="ChatListItemImg">
                    </div>
                    <div class="ChatListItemOtherUserName">
                        <p class="OtherName">봉양면고릴라</p>
                        <div class="pip"></div>
                        <p class="OtherMess NewMess">새 메시지 2개</p>
                    </div>

                    <div class="ChatListItemdate">12:33</div>
                </div>
            </a>
-->

            <?php
            while ($row = $result->fetch_assoc()) {
                if ($row["host_user_idx"] == $id) {
                    $sql = "SELECT id FROM users WHERE idx = '" . $row["member_user_idx"] . "';";
                } else {
                    $sql = "SELECT id FROM users WHERE idx = '" . $row["host_user_idx"] . "';";
                }
                $lastText = $conn->query("SELECT text, datetime FROM chat WHERE chat_idx = '" . $row["idx"] . "' ORDER BY datetime DESC LIMIT 1")->fetch_row();

                $r = $conn->query($sql);

                $uid = $r->fetch_row()[0];
            ?>

                <a href="#" id="<?= $uid ?>" onclick="aTagClickEvent(event)">
                    <div class="ChatListItem">
                        <div class="ChatListItemImgBox">
                            <img src="../../../source/img/user.png" class="ChatListItemImg">
                        </div>
                        <div class="ChatListItemOtherUserName">
                            <p class="OtherName"><?= $uid ?></p>
                            <p class="OtherMess"><?= isset($lastText[0]) ? $lastText[0] : "" ?></p>
                        </div>

                        <div class="ChatListItemdate"><?= isset($lastText[0]) ? $lastText[1] : "" ?></div>
                    </div>
                </a>
            <?php
            }
            ?>

        </div>

    </div>
    <script>
        function aTagClickEvent(e) {
            e.preventDefault();
            console.log(e.currentTarget);
            document.querySelector('body').innerHTML += `<form method="POST" action="./chating.php"> <input type="hidden" name="to" value="${e.currentTarget.id}"> </form>`
            document.querySelector('form').submit();
        }
    </script>
</body>

</html>