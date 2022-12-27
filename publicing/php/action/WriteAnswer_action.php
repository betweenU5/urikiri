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

    date_default_timezone_set("Asia/Seoul");
    $date = date("Y-m-d h:i:s");

    $board_idx = $_POST['Qidx'];
    $content = $_POST['content'];

    $zero = 0-0;

    $stmt = $conn -> prepare("INSERT INTO answer (answer_idx, question_idx, users_name, content, is_check, create_date) VALUES (null, ?, ?, ?,? , ?)" );
    $stmt -> bind_Param("issis", $board_idx, $_SESSION['username'], htmlspecialchars($content), $zero, $date);
    $result = $stmt ->execute();

    if($result){
        echo "<script>
        alert('등록 완료');
        location.href = '../page/BoradReadmore.php?idx=".$board_idx."'
        </script>";
    }
    
    ?>
</body>
</html>