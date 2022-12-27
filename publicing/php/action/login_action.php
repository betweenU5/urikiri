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
    
    $id = $_POST['UserId'];
    $pw = $_POST['Password'];
    $token = $_POST['token'];
    $mpw = md5($pw);

    $sql = "SELECT * FROM users WHERE email = '".$id."'";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($result);
   
    if(mysqli_num_rows($result) == 0){
        echo 
        "<script>
        alert('해당 아이디가 존재하지 않습니다.');
        location.href = '../page/login.php';
        </script>";
    }else{
        if($rows['password'] == $mpw){
            mysqli_query($conn, "UPDATE users SET token = '{$token}' WHERE email = '{$id}'");
            $_SESSION['username'] = $rows['id'];
            $_SESSION['id'] = $id;
            echo 
            "<script>
            alert('로그인 완료');
            location.href = '../page/main.php';
            </script>";
        }else{
            echo 
        "<script>
        alert('비밀번호가 틀렸습니다.');
        location.href = '../page/login.php';
        </script>";
        }
    }
    
    ?>
</body>
</html>