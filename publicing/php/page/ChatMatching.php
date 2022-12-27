<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/Main.css">
</head>
<style>

html {
        height: 100%;
    }

    body {
        min-height: 100%;
    }

.MessageBox{
    width: 90%;
    height: 150px;
    text-align: center;
    margin: auto;
    margin-top: 200px;
    font-family: IBMPlexSansKR-Regular;
    font-weight: lighter;

}

.MessageBox a{
    margin-top: 20px;
    font-family: IBMPlexSansKR-Regular;
}

</style>
<script>
    let UserArray = [];
</script>

<body>

    <div class="loadingPage">
        <div class="square">
            <div class="spin"></div>
        </div>
    </div>

    <?php
    include '../inc/Dbcnt.php';
    include '../inc/menu.php';

    if ($jb_login) {
        $SelectedTag = $_POST['SelectedTag'];
        $FindUserByTag = "SELECT * FROM user_interest WHERE interest_idx = '" . $SelectedTag . "'";
        $FindUserRes = mysqli_query($conn, $FindUserByTag);
        $NumRows = mysqli_num_rows($FindUserRes);
        if ($NumRows == 0) {
            ?>
            
            <div class="MessageBox">
                <h4>답변이 가능한 유저가 없습니다</h4>
                <a href="../page/MatchingSelectTag.php">돌아가기</a>
            </div>
            
            <?php
        } else {
            while ($rows = mysqli_fetch_array($FindUserRes)) {
                $UserInfoSql = "SELECT * FROM users WHERE idx = '" . $rows['user_idx'] . "'";
                $userInfoRes = mysqli_query($conn, $UserInfoSql);
                $teerew = mysqli_fetch_assoc($userInfoRes);
                if($teerew['id'] != $_SESSION['username']){

                    echo "<script>
                    UserArray.push('" . $teerew['id'] . "')
                    </script>";
                }
            }
            echo "<script>
        location.href = '../page/profile.php?id=' + UserArray[Math.floor(Math.random() * UserArray.length)];
        </script>";
        ?>
        

        
        <?php
        }
    }else{
        echo "<script>
        alert('로그인이 필요한 기능입니다.');
        location.href = '../page/login.php';
        </script>";
    }

    ?>

</body>
<script>

    window.onload = function(){
        
        let st = setTimeout(() => {
            CloseLoading()    
        }, 3000);
        
    }

    function CloseLoading(){
        let loadingPage = document.querySelector(".loadingPage");
        loadingPage.style.opacity = 0;
        loadingPage.style.zIndex = -999;
    }





</script>

</html>