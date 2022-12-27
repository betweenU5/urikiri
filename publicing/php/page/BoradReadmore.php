<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>우리끼리 | 마이페이지</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/Main.css">
    <script src="../../js/mypage.js"></script>
</head>

<body>

    <?php
    include '../inc/menu.php';

    $board_idx = $_GET["idx"];

    $ViewSql = "UPDATE question  SET view = view + 1 WHERE idx = '" . $board_idx . "'";
    $rsrfe = mysqli_query($conn, $ViewSql);



    $ShowBoardSql = "SELECT * FROM question WHERE idx = '" . $board_idx . "'";
    $result = mysqli_query($conn, $ShowBoardSql);
    $rowss = mysqli_fetch_assoc($result);
    ?>





    <div class="SectionBox">


        <div class="boardBox">
            <div class="titleBox">
                <p class="BoradTitle"><?php echo $rowss['title'] ?></p>
                <p class="subInfoText"><?php echo $rowss['users_name'] ?>님</p>

            </div>
            <div class="MainTextBox">
                <?php
                $hoxyImg = "SELECT * FROM question_img WHERE question_idx = '" . $rowss['idx'] . "'";
                $DataREsult = mysqli_query($conn, $hoxyImg);
                $roes = mysqli_num_rows($DataREsult);
                if ($roes > 0) {

                    $restimg = mysqli_fetch_assoc($DataREsult);


                ?>

                    <img onclick="GoViewImgLink('../../../userFile/q_img/<?php echo $restimg['path'] ?>')" src="../../../userFile/q_img/<?php echo $restimg['path'] ?>" class="BoradShowImg">

                <?php
                }
                ?>
                <div disabled="true" class="BoardTextArea">
                    <?php echo $rowss['context'] ?>

                </div>
                <p class="subInfoText"><?php echo $rowss['create_date'] ?> <?php echo $rowss['create_time'] ?></p>
            </div>
        </div>

        <?php if ($jb_login) {

            $ShowProfileSql = "SELECT * FROM users where id = '" . $_SESSION['username'] . "'";
            $res1 = mysqli_query($conn, $ShowProfileSql);
            $ron = mysqli_fetch_assoc($res1);


        ?>
            <div class="DoYouAnswerMe">
                <div class="otherBoxx">
                    <img class="ShowUserImgBoxx" src="../../../userFile/profile_img/<?php echo $ron['ProfileImg'] ?>" onclick="ToGoLink(<?php echo $ron['ProfileImg'] ?>)">
                    <p class="DoYouAswText"><?php echo $ron['id'] ?>님</p>
                </div>
                <div class="ButtonBox">
                    <a href="AnswerWriteForm.php?idx=<?php echo $board_idx ?>"><button type="button" class="AnswerButton">답변하기</button></a>
                </div>

            </div>
        <?php
        } ?>

        <div class="SmallTitleBox">
            <?php
            $FindAnswerSql = "SELECT * FROM answer WHERE question_idx = '" . $board_idx . "'  ORDER BY is_check DESC";
            $FindAnswerRes = mysqli_query($conn, $FindAnswerSql);

            $FindAnswerNUm = mysqli_num_rows($FindAnswerRes);
            ?>
            <div class="SmallTitleItemBo">
                답변 <?php echo $FindAnswerNUm ?>개
            </div>
        </div>

        <?php

       
            while ($FindRows = mysqli_fetch_array($FindAnswerRes)) {
            $finfAnswUserSql = "SELECT * FROM users WHERE id = '" . $FindRows['users_name'] . "'";
            $findUserRes = mysqli_query($conn, $finfAnswUserSql);
            $findUserRows = mysqli_fetch_assoc($findUserRes);

            if (isset($findUserRows['ProfileImg'])) {
                $userImg = '../../../userFile/profile_img/' . $findUserRows['ProfileImg'];
            } else {

                $userImg = '../../../source/img/user.png';
            }
        ?>

            <div class="AnswerItem">
                <div class="Answertitle">
                    <div class="DoYouAnswerMe">
                        <div class="otherBoxx">
                            <img class="ShowUserImgBoxx" src="<?php echo $userImg ?>" onclick="ToGoLink('<?php echo $findUserRows['id'] ?>')">
                            <p class="DoYouAswText" id="DoYouAswText"><?php echo $findUserRows['id'] ?>님
                                <?php if ($FindRows['is_check'] == 1) {
                                    echo "<span style='color:#E84E4A; font-weight:bold'>[채택]</span";
                                } ?>
                            </p>
                        </div>

                        <?php
                        if ($jb_login) {

                            if ($_SESSION['username'] == $rowss['users_name'] && $rowss['users_name'] != $findUserRows['id']) {
                                if ($rowss['is_check'] == 0) {
                        ?>

                                    <div class="ButtonBox">
                                        <button class="ischeckButton" onclick="GotoCheck(<?php echo $FindRows['answer_idx'] ?>, 
                                 <?php echo $FindRows['question_idx'] ?>)">채택하기</button>
                                    </div>

                        <?php
                                }
                            }
                        } ?>


                    </div>

                </div>
                <div class="MainTextBox">
                    <div disabled="true" class="BoardTextArea">



                        <?php echo $FindRows['content'] ?>


                    </div>
                    <p class="TextDate"><?php echo $FindRows['create_date'] ?></p>
                </div>
            </div>

        <?php } ?>





    </div>


</body>
<script>
    function GotoCheck(bo_idx, qn_idx) {
        location.href = '../action/CheckAnswer.php?qn=' + qn_idx + '&&an=' + bo_idx;
    }

    function GoViewImgLink(path) {
        location.href = "../page/ShowImg.php?path=" + path;
    }
</script>

</html>