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
<style>
    .ShowUserImgBox2{
        margin-top: 12px;
        height: 200px;
    }
</style>
<body>
    <?php
    include '../inc/menu.php';
    if($jb_login){
    ?> 

    <div class="SectionBox">
    

        <div class="loginFormBox" id="writeFormBox">
            <br><br><br>
            <form action="../action/Write_board.php" method="post" autocomplete="off" class="FormBox" enctype="multipart/form-data">
                <p class="FormTitleP">제목</p>
                <input type="text" id="BoardName" name="BoardName" placeholder="제목">
                <p class="FormTitleP">첨부파일</p>
                <label for="UserFile" class="InputLabelFile">파일 첨부하기</label>
                <div class="ShowImgBoxx"></div>
                <input type="file" accept="image/*" class="hidden" id="UserFile" name="UserFile" name="UserFile" placeholder="파일" onchange="setThumbnail(event)">
                <p class="FormTitleP">내용</p>
                <textarea name="content" id="content" class="codeTextArea"></textarea>
                
                <button class="SubmitButton" type="submit">글 작성</button>
       
            </form>
        </div>
   
    </div>
    <?php }else{
        echo "<script>
        alert('로그인이 필요한 기능입니다.');
        location.href = './main.php';
        </script>";
    } ?>
    
</body>

</html>