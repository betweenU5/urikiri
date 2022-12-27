<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>우리끼리 | 프로필</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/Main.css">
    <script src="../../js/mypage.js"></script>
</head>

<body>

    <?php include '../inc/menu.php';
    $ProfileId = $_GET['id'];
    $ShowProfileSql = "SELECT * FROM users WHERE id = '" . $ProfileId . "'";

    $restt = mysqli_query($conn, $ShowProfileSql);
    $rows = mysqli_fetch_assoc($restt);
    ?>


    <div class="SectionBox">

        <div class="ProfileBox">
            <div class="ShowImgBoxx">
                <br>
                <img class="ShowUserImgBoxx" src="../../../userFile/profile_img/<?php echo $rows['ProfileImg'] ?>">
               
                <div class="profileTeextBox">
                    <p class="ProfileUsername"><?php echo $rows['id'] ?>님</p>
                    <p class="ProfileUserId">#<?php echo $rows['id'] ?></p>
                </div>

                <div class="hashTagBox">
                    <?php 
                        $FindTagSql = "SELECT * FROM users u LEFT JOIN user_interest ui ON u.idx = ui.user_idx WHERE u.id = '".$ProfileId."';";
                        $FindSqlRs = mysqli_query($conn, $FindTagSql);
                        while($roeswd = mysqli_fetch_array($FindSqlRs)){
                    ?>
                        <span class="TagLabel"><?php echo $roeswd['interest_idx'] ?></span>

                    <?php } ?>
               </div>
            </div>
        </div>
        <?php if ($jb_login && $_SESSION['username'] != $ProfileId) { ?>
            <a href="#" class="WantChatingButton" onclick="aTagClickEvent(event)">
                <div class="ButtonGoToDiv">
                    <img src="../../../source/img/live-chat.png" class="ButtonImg">
                    <p class="ButtonTExt">채팅하기</p>
                </div>
            </a>

        <?php } ?>
        
        <div class="pointBox BUtSure">
            <br>
            <div class="ProgressBar">
                <div class="YourPointBar" style="width:<?php echo $rows['point'] * 3 / 10 ?>px"></div>
            </div>

            <div class="progressTExtBox">
                <p class="ProgressText"><?php echo $rows['point'] ?>/1000</p>
                <p class="nextText">다음 칭호 : 고수</p>

            </div>


        </div>


        <div class="acodianBox">



            <div class="acodianItem">

                <div class="ShowMyListThisBox">
                    <div class="acodianHeader" id="acoHead1" onclick="ShowAco1(1)">
                        <p class="acoTitle" id="acoTitle1">작성한 질문</p>
                    </div>
                    <div class="acodianHeader" id="acoHead2" onclick="ShowAco1(2)">
                        <p class="acoTitle" id="acoTitle2">작성한 답변</p>
                    </div>
                </div>





                <div class="acodianBody" id="aco1">

                    <?php
                    $AcoSql1 = "SELECT * FROM question WHERE users_name = '" . $ProfileId . "' ORDER BY idx DESC";
                    $AcoSqlRes = mysqli_query($conn, $AcoSql1);
                    while ($roesw = mysqli_fetch_array($AcoSqlRes)) {
                    ?>
                        <a href="BoradReadmore.php?idx=<?php echo $roesw['idx'] ?>">
                            <div class="listItem">
                                <div class="ListItemHeader">
                                    <span class="ItemTitle profileListItem"><?php echo $roesw['title'] ?></span>
                                </div>

                                <div class="ListItemBody">
                                    <div class="ItemText">
                                        <?php echo $roesw['context'] ?>
                                    </div>
                                </div>

                                <div class="ListItemFooter">
                                    <div id="footerItem1">조회수 <?php echo $roesw['view'] ?></div>

                                </div>
                            </div>
                        </a>
                    <?php } ?>


                </div>
                <div class="acodianBody" id="aco2">

                    <?php
                    $AcoSql1 = "SELECT * FROM answer WHERE users_name = '" . $ProfileId . "' ORDER BY answer_idx DESC";
                    $AcoSqlRes = mysqli_query($conn, $AcoSql1);
                    while ($roesw = mysqli_fetch_array($AcoSqlRes)) {
                        $ShowListQls = "SELECT * FROM question WHERE idx = '" . $roesw['question_idx'] . "'";
                        $ShowListRes = mysqli_query($conn, $ShowListQls);
                        $torw = mysqli_fetch_assoc($ShowListRes);
                    ?>
                        <a href="BoradReadmore.php?idx=<?php echo $torw['idx'] ?>">
                            <div class="listItem">
                                <div class="ListItemHeader">
                                    <span class="ItemTitle profileListItem"><?php echo $torw['title'] ?></span>
                                </div>

                                <div class="ListItemBody">
                                    <div class="ItemText">
                                        <?php echo $torw['context'] ?>
                                    </div>
                                </div>

                                <div class="ListItemFooter">
                                    <div id="footerItem1">조회수 <?php echo $torw['view'] ?></div>

                                </div>
                            </div>
                        </a>
                    <?php } ?>
                </div>
            </div>

           




        </div>


    </div>


    <script>
        function aTagClickEvent(e) {
            e.preventDefault();
            console.log(e.currentTarget);
            document.querySelector('body').innerHTML += `<form method="POST" action="./chating.php"> <input type="hidden" name="to" value="<?= $_GET["id"] ?>"> </form>`
            document.querySelector('form').submit();
        }
    </script>
</body>

</html>