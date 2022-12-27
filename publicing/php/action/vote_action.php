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
    include '../inc/Dbcnt.php';
    include '../inc/session.php';

    $user = $_SESSION['username'];
    $VoteWhere = $_GET['id'];

    if($jb_login){
        
            if($VoteWhere == 1){    
                $voteSql = "UPDATE vote SET left_interest_idx = left_interest_idx+1";
            }else{
                $voteSql = "UPDATE vote SET right_interest_idx = right_interest_idx+1";
            }
                $VoteRes = mysqli_query($conn, $voteSql);
                if($VoteRes){
                    echo "<script>
                    
                    location.href = '../page/main.php';
                    </script>";
                }

    }else{
        echo "<script>
        alert('로그인이 필요한 기능입니다.');
        location.href = '../page/login.php';
        </script>";
    }

    ?>
</body>
</html>