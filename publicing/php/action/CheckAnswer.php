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
        $qn = $_GET['qn'];
        $an = $_GET['an'];

        $one = 1-0;

        $GoSql = "SELECT * FROM question WHERE idx = ".$qn."";
        $GosqlRes = mysqli_query($conn, $GoSql);
        $GoSqlRows = mysqli_fetch_assoc($GosqlRes);

        
        $GoSql2 = "SELECT users_name FROM answer WHERE answer_idx = ".$an."";
        $GosqlRes2 = mysqli_query($conn, $GoSql2);
        $GoSqlRows2 = mysqli_fetch_assoc($GosqlRes2);

        
        if($_SESSION['username'] == $GoSqlRows['users_name']){

            $CheckSql = "UPDATE question SET is_check = ".$one." WHERE idx = '".$qn."'";
            $CheckSql2 = "UPDATE answer SET is_check = ".$one." WHERE answer_idx = '".$an."'";
            $AddpointSql = "UPDATE users SET point = point + 50 WHERE id = '".$GoSqlRows2['users_name']."'";


            mysqli_query($conn, $AddpointSql);
            mysqli_query($conn, $CheckSql);
            mysqli_query($conn, $CheckSql2);


            echo "<script>
            alert('".$GoSqlRows2['users_name']."님의 답변이 채택되었습니다!');
            location.href = '../page/BoradReadmore.php?idx=".$qn."';

            </script>";










        }else{
            echo "<script>
            alert('접근 권한이 없습니다.');
            location.href = '../page/main.php';
            </script>";
        }
    ?>
</body>
</html>