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




    $TagArray = $_POST['tag'];
    date_default_timezone_set("Asia/Seoul");

    $UserId = $_POST['UserId'];
    $UserMail = $_POST['UserMail'];
    $Password = $_POST['Password'];

    $mpw = md5($Password);


    $FindEmailSql = "SELECT COUNT(*) FROM users WHERE email = '".$UserMail."'";
    $FindSqlRes = mysqli_query($conn, $FindEmailSql);

    $FindEmRess = mysqli_fetch_assoc($FindSqlRes);
    $zero = 0;

    if($FindEmRess['COUNT(*)'] > 0){
        echo "
        <script>
        alert('이미 사용중인 이메일입니다. 로그인 페이지로 이동합니다.');
        location.href = '../page/login.php';
        </script>
        ";
    }else{
        $FindIdSql = "SELECT COUNT(*) FROM users WHERE id = '".$UserId."'";
        $FindIdSqlres = mysqli_query($conn, $FindIdSql);
        $FindIdSqlRows = mysqli_fetch_assoc($FindIdSqlres);

        if($FindIdSqlRows['COUNT(*)'] > 0){
            echo "
            <script>
            alert('이미 사용중인 아이디입니다. 회원가입 페이지로 이동합니다.');
            location.href = '../page/RegiSelectTag.php';
            </script>
            ";
        }else{

            $stmt = $conn -> prepare("INSERT INTO users (idx, id, password, email, ProfileImg, last_login_datetime, point, profile) VALUES (null, ?, ?, ?, null, null, ?, null)");
            $stmt->bind_param("sssi", $UserId, $mpw, $UserMail, $zero);
            $result = $stmt->execute();

            $upload_url = '../../../userFile/profile_img/';

            $board_no = mysqli_insert_id($conn);

            if (isset($_FILES['UserFile']) && $_FILES['UserFile']['name'] != "") {
                $name = $UserId.$_FILES['UserFile']['name'];
                
        
                //파일 저장
                $MoveFIleRs = move_uploaded_file( $_FILES['UserFile']['tmp_name'], "$upload_url/$name");
                if($MoveFIleRs){
                    $stmt2 = "UPDATE users SET ProfileImg = '".$name."' WHERE idx = '".$board_no."'";
                    $result2 = mysqli_query($conn, $stmt2);
                    
                }else{
                    echo "<script>
                        alert('파일 용량이 너무 큽니다.');
                    </script>";
                    $User_url = 'user.png';
                    $stmt2 = "UPDATE users SET ProfileImg = '".$User_url."' WHERE idx = '".$board_no."'";
                    $result2 = mysqli_query($conn, $stmt2);   
                }

                
            }else{
                $User_url = 'user.png';
                $stmt2 = "UPDATE users SET ProfileImg = '".$User_url."' WHERE idx = '".$board_no."'";
                $result2 = mysqli_query($conn, $stmt2);   
            }

            if(isset($TagArray)){
                for($i = 0; $i < count($TagArray); $i++){
                    $stmt3 = $conn -> prepare("INSERT INTO user_interest (idx, user_idx, interest_idx) VALUES (null, ?, ?)");
                    $stmt3 -> bind_param("ss", $board_no, $TagArray[$i]);
                    $resss = $stmt3 -> execute();
                }
            }

            echo 
            "
            <script>
            alert('회원가입 완료');
            location.href = '../page/main.php';
            </script>
            ";

            
            
        }

    }


    
    
    
    
    
    
    ?>
</body>
</html>