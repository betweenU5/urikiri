<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>우리끼리 | 글 작성</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/Main.css">
    <script src="../../js/WriteForm.js"></script>
</head>

<body>
   <?php 
   include '../inc/menu.php';


   if($jb_login){
    ?>
    
    <?php
   $id = $_GET['idx'];
   $FindQ = "SELECT * FROM question WHERE idx = '".$id."'";
   $restt = mysqli_query($conn, $FindQ);
   $tor = mysqli_fetch_assoc($restt);
   ?>

    

    

    <div class="SectionBox">
    

        <div class="loginFormBox" id="writeFormBox">
            <br><br><br>
            <form action="../action/WriteAnswer_action.php" method="post" autocomplete="off" class="FormBox" enctype="multipart/form-data">
                <p class="FormTitleP">질문</p>
                <input type="text" id="BoardName" name="BoardName" placeholder="제목" value="Q. <?php echo $tor['title'] ?>" disabled>
                <input type="text" class="hidden" name="Qidx" value="<?php echo $id ?>">
                <p class="FormTitleP">답변</p>
                <textarea name="content" id="content" class="codeTextArea"></textarea>
                
                <button class="SubmitButton" type="submit">답변 작성</button>
       
            </form>
        </div>
   
    </div>
    
    <?php
   }else{
    echo "<script>
    alert('로그인이 필요한 기능입니다.');
    location.href = 'main.php';
    </script>";
   }
   ?>
   
   
   
    
</body>

</html>