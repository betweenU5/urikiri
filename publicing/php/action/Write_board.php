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

    date_default_timezone_set("Asia/Seoul");

    include "../inc/Dbcnt.php";
    include "../inc/session.php";

    
    if($jb_login){
        $upload_url = '/var/www/html/userFile/q_img';
        
    $TodayDate = explode(" ", date("Y-m-d H:i:s"));
    $date = $TodayDate[0];
    $time = $TodayDate[1];
    
    $title = $_POST['BoardName'];
    $content = $_POST['content'];
    $zero = 0-0;
    

    $stmt = $conn->prepare('INSERT INTO 
    question (idx, title, users_name, interest_idx, context, create_date, create_time, update_datetime, is_check, view) 
    VALUES (null, ?, ?, null, ?, ?, ?, null, ?, ?)');
    
    $stmt -> bind_Param('sssssii', $title, $_SESSION['username'], htmlspecialchars($content), $date, $time, $zero, $zero);
    $result = $stmt->execute();
    
    $board_no = mysqli_insert_id($conn);

    //파일이 있는지 확인한 후, 파일 저장;
    if (isset($_FILES['UserFile']) && $_FILES['UserFile']['name'] != "") {

        
        $name = date("Y-m-d H:i:s").$_SESSION['username'].$_FILES['UserFile']['name'];
        

        //파일 저장
        $MoveFileRs = move_uploaded_file( $_FILES['UserFile']['tmp_name'], "$upload_url/$name");
        if($MoveFileRs){
            $stmt2 = $conn -> Prepare('INSERT INTO question_img (idx, question_idx, path) VALUES (null, ?, ?)');
            $stmt2 -> bind_Param("ss", $board_no, $name);
            $result2 = $stmt2 -> Execute();    
        }else{
            
    echo "
    <script>
    alert('이미지 용량이 너무 큽니다. 다시 시도해주세요');
    location.href = '../page/board.php';
    </script>
    ";
        }
        
    }

    echo "
    <script>
    alert('등록 완료');
    location.href = '../page/board.php';
    </script>
    ";

 
    }else{
        echo "<script>
        alert('로그인이 필요한 기능입니다.');
        location.href = '../page/login.php';
        </script>";
    }


    ?>
</body>

</html>
