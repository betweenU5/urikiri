<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!--유저 세션 코드-->
    <?php 
    session_start();
    if(isset($_SESSION['username'])){
        $jb_login = true;
    }else{
        $jb_login = false;
    }
    ?>
</body>
</html>