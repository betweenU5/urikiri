<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../../js/menu.js"></script>
    <link rel="icon" href="../../../source/img/logo.png">
</head>

<body>
    <?php include '../inc/session.php';
    include '../inc/Dbcnt.php';
    ?>
    <input type="checkbox" id="IfFocus" onchange="ShowMenu()">
    <header id="headerArea" class="header">
        <div class="FirstHeaderElement">
            <div class="LeftBox">
                <a href="../page/main.php">
                    <img src="../../../source/img/logo.png" class="HeaderLogoIcon">
                    <p class="HeaderSiteName">우리끼리</p>
                </a>
            </div>
            <div class="RightBox">
                
                <a href="../page/mypage.php" id="User">
                    <?php
                    if($jb_login){
                        $sql = "SELECT ProfileImg FROM users WHERE id = '".$_SESSION['username']."'";
                        $sqlRes = mysqli_query($conn, $sql);
                        $rows = mysqli_fetch_assoc($sqlRes);
                        ?>
                    <img src="../../../userFile/profile_img/<?php echo $rows['ProfileImg']?>" class="HeaderLogoIcon">    
                        <?php
                    }else{
                        ?>
                    <img src="../../../source/img/user.png" class="HeaderLogoIcon">    
                        <?php
                    }
                    ?>
                    
                </a>
                <label id="menu" for="IfFocus" class="ShowmenuButton">
                    <img src="../../../source/img/menu.png" class="HeaderLogoIcon">
                </label>
            </div>


        </div>

    </header>
    <div class="body">

    </div>


    <div class="ThisIsMenuBox">
        <a href="../page/WriteBoardForm.php" class="MenuItem">글쓰기</a>
        <a href="../page/board.php" class="MenuItem">글보기</a>
        <a href="../page/MatchingSelectTag.php" class="MenuItem"> 멘토 매칭</a>
        <!-- <a href="../page/VoteList.php" class="MenuItem">투표 목록</a> -->
        <a href="../page/chatList.php" class="MenuItem"> 내 채팅방</a>
        <a href="../page/lanking.php" class="MenuItem"> 랭킹</a>
        <a href="../page/mypage.php" class="MenuItem"> 내 정보</a>




        <div class="footer">
            <p class="footerP">
                Team. BetweenUs<br />
                GBSW Capstone project
            </p>
            <?php
            if ($jb_login) {
            ?>
                <a href="../action/logout_action.php">로그아웃</a>
            <?php
            } else {
            ?>
                <a href="../page/login.php">로그인</a>
                <a href="../page/RegiSelectTag.php">회원가입</a>
            <?php
            }
            ?>


        </div>
    </div>



</body>

</html>