<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include '../inc/session.php';
    include '../inc/Dbcnt.php';

    if($jb_login){
        mysqli_query($conn, "UPDATE users SET token = NULL WHERE email = '{$_SESSION['id']}'");
        $_SESSION['username'] = null;
        $_SESSION['id'] = null;
        $jb_login = false;
    
        echo "<script>
        alert('로그아웃 되었습니다.');
        location.href = '../page/main.php';
        </script>";
    }else{
    echo "<script>
    alert('로그아웃된 상태입니다.');
    location.href = '../page/main.php';
    </script>";
    }
    



    
    ?>
</body>
</html>