<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>우리끼리 | 마이페이지</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/Main.css">
    <script src="../../js/mypage.js"></script>
   </head>

<body>
    
    <?php
    include '../inc/menu.php';
    if(isset($_POST['search'])){
        $SearchText = $_POST['search'];
    }else{
        $SearchText = null;
    }
    ?>
    

    

    <div class="SectionBox">
    
        <div class="SearchInputBox">
            <form action="../page/board.php" method="post" name="search" autocomplete="off">
            <input type="text" autocomplete="off" class="SearchInputTag" name="search" placeholder="검색어를 입력하세요" value="<?php if(isset($_POST['search'])){echo $SearchText;} ?>">
            <button type="submit" class="SearchPressButton">검색</button>
            </form>
            

        </div>
       
                                             
        <div class="boardListBox">
           <?php 

        


           if(isset($_POST['search'])){
             $sql = "SELECT * FROM question WHERE title LIKE '%".$SearchText."%' OR context LIKE '%".$SearchText."%' ORDER BY idx DESC;";

           }else{
            $sql = "SELECT * FROM question ORDER BY idx DESC";
           }
           $result2 = mysqli_query($conn, $sql);



           
           while($row = mysqli_fetch_array($result2)){
            $FindAnswerCnt = "SELECT * FROM answer WHERE question_idx = '".$row['idx']."'";
            $FindCntRes = mysqli_query($conn, $FindAnswerCnt);
            $roesrr = mysqli_num_rows($FindCntRes);
            ?>
            <a href="../page/BoradReadmore.php?idx=<?php echo $row['idx']?>">
                <div class="listItem">
                    <div class="ListItemHeader">
                        
                        <span class="ItemTitle profileListItem"><?php echo $row['title']?> 
                        <div class="pip"></div>
                        <!--<span class="BoardItemTime"><?php // echo $row['create_datetime']?></span> --> </span>
                    </div>

                    <div class="ListItemBody">
                        <div class="ItemText" >
                        <?php echo $row['context']?>
                        </div>
                    </div>

                    <div class="ListItemFooter">
                        <div id="footerItem1">조회수 <?php echo $row['view']?></div>
                        <p>|</p>
                        <div id="footerItem2">답변수 <?php echo $roesrr ?></div>
                    </div>
                </div>
              </a>


              
            <?php } ?>
        

        </div>
           
            
    
      
    </div>
        
    
</body>

</html>