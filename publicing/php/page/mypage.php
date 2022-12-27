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
    
    
    <?php include '../inc/menu.php';
    ?>

    

    <div class="SectionBox">
    
      <?php if($jb_login){
        $ShowProfileSql = "SELECT * FROM users WHERE id = '".$_SESSION['username']."'";
        $restt = mysqli_query($conn, $ShowProfileSql);
        $rows = mysqli_fetch_assoc($restt);
    
    ?>
        
        <div class="ProfileBox">
            <div class="ShowImgBoxx">
                
            <br>
                <img class="ShowUserImgBoxx" src="../../../userFile/profile_img/<?php echo $rows['ProfileImg'] ?>">
            
                <div class="profileTeextBox">
                <p class="ProfileUsername"><?php echo $rows['id'] ?>님</p>
                <p class="ProfileUserId">#<?php echo $rows['id'] ?></p>
               </div>
              
               <div class="hashTagBox">
                    <?php 
                        $FindTagSql = "SELECT * FROM users u LEFT JOIN user_interest ui ON u.idx = ui.user_idx WHERE u.id = '".$_SESSION['username']."';";
                        $FindSqlRs = mysqli_query($conn, $FindTagSql);
                        while($roeswd = mysqli_fetch_array($FindSqlRs)){
                    ?>
                        <span class="TagLabel"><?php echo $roeswd['interest_idx'] ?></span>

                    <?php } ?>
               </div>
            </div>
        </div>

        <div class="pointBox">
            <br>
            <div class="ProgressBar">
                <div class="YourPointBar" style="width:<?php echo $rows['point']*3/10 ?>px"></div>
            </div>
            
           <div class="progressTExtBox">
            <p class="ProgressText"><?php echo $rows['point'] ?>/1000</p>
            <p class="nextText">다음 칭호 : 고수</p>
           </div>

           <a href="lanking.php" class="LinkToLanking">내 순위 보기</a>
        </div>
        

        <div class="acodianBox">
            

            <div class="acodianItem">

               <div class="ShowMyListThisBox">
                <div class="acodianHeader" id="acoHead1" onclick="ShowAco1(1)">
                    <p class="acoTitle" id="acoTitle1">내 질문</p>
                </div>
                <div class="acodianHeader" id="acoHead2" onclick="ShowAco1(2)">
                    <p class="acoTitle"  id="acoTitle2">내 답변</p>
                </div>
               </div>


                <div class="acodianBody" id="aco1">

                <?php  
                $AcoSql1 = "SELECT * FROM question WHERE users_name = '".$_SESSION['username']."' ORDER BY idx DESC";
                $AcoSqlRes = mysqli_query($conn, $AcoSql1);
                while($roesw = mysqli_fetch_array($AcoSqlRes)){
                ?>
                    <a href="BoradReadmore.php?idx=<?php echo $roesw['idx'] ?>">
                        <div class="listItem">
                            <div class="ListItemHeader">
                                <span class="ItemTitle profileListItem"><?php echo $roesw['title'] ?></span>
                            </div>
        
                            <div class="ListItemBody">
                                <div class="ItemText">
                                <?php echo $roesw['context'] ?>
                                </div>
                            </div>
        
                            <div class="ListItemFooter">
                                <div id="footerItem1">조회수 <?php echo $roesw['view'] ?></div>
                             
                            </div>
                        </div>
                      </a>
                  <?php } ?>
                       

                </div>
                <div class="acodianBody" id="aco2">

                 <?php  
                $AcoSql1 = "SELECT * FROM answer WHERE users_name = '".$_SESSION['username']."' ORDER BY answer_idx DESC";
                $AcoSqlRes = mysqli_query($conn, $AcoSql1);
                while($roesw = mysqli_fetch_array($AcoSqlRes)){
                    $ShowListQls = "SELECT * FROM question WHERE idx = '".$roesw['question_idx']."'";
                    $ShowListRes = mysqli_query($conn, $ShowListQls);
                    $torw = mysqli_fetch_assoc($ShowListRes);
                ?>
                    <a href="BoradReadmore.php?idx=<?php echo $torw['idx'] ?>">
                        <div class="listItem">
                            <div class="ListItemHeader">
                                <span class="ItemTitle profileListItem"><?php echo $torw['title'] ?></span>
                            </div>
        
                            <div class="ListItemBody">
                                <div class="ItemText">
                                <?php echo $torw['context'] ?>
                                </div>
                            </div>
        
                            <div class="ListItemFooter">
                                <div id="footerItem1">조회수 <?php echo $torw['view'] ?></div>
                             
                            </div>
                        </div>
                      </a>
                  <?php } ?>
                </div>
            </div>

           
           
            
        </div>
        
        <div class="otherBox">
            <br>
            <a href="../action/logout_action.php" class="buttonA">
                <button type="button" class="LogoutButton">
                    로그아웃
                </button>
            </a>
        </div>
        
        <?php
      }else{
            echo "<script>
            alert('로그인이 필요한 기능입니다.');
            location.href = '../page/login.php';
            </script>";
      } ?>
    </div>
        
    
</body>

</html>