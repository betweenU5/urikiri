<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>우리끼리 | 회원가입</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/Main.css">
    <script src="../../js/register.js"></script>
</head>

<body>

    <?php include '../inc/menu.php';
    
    $TagArray = $_POST['MySelectTag'];


    if($jb_login){
        echo "<script>
        alert('이미 로그인된 상태입니다.');
        location.href = 'main.php';
        </script>";
    }else{
    ?>

<div class="SectionBox">


<div class="loginFormBox" id="registerBox">
    <br>
    <p class="FormTItle">REGISTER</p>
    <form action="../action/register_action.php" enctype="multipart/form-data" method="post" autocomplete="off" class="FormBox" onsubmit="return CheckAllVal()">

        <?php

        for ($i = 0; $i < count($TagArray); $i++) {

            ?>
            
            <input type="text" name="tag[]" value="<?php echo $TagArray[$i]; ?>" class="hidden">
            
            <?php
            
        }

        ?>
        <label for="Userimage">
            <div class="ShowImgBoxx">
                <img class="ShowUserImgBox" src="../../../source/img/user.png">
            </div>
            <div class="SelectUserImg">사진 선택</div>
        </label>
        <input type="file" accept="image/*" name="UserFile" id="Userimage" class="hidden" onchange="setThumbnail(event)">

        <input type="text" id="UserId" name="UserId" placeholder="아이디">
        <input type="email" id="UserMail" name="UserMail" placeholder="이메일">
        <input type="password" id="Password" name="Password" placeholder="비밀번호">
        <input type="password" id="Passworck" placeholder="비밀번호 확인">
        
        <button class="SubmitButton" type="submit">회원가입</button>
    </form>

</div>

</div>
<?php } ?>




   


</body>

</html>