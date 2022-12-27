<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>우리끼리 | 랭킹</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/Main.css">
    <script src="../../js/main.js"></script>
</head>

<body>
    
    <?php 
    include '../inc/menu.php';
    $ShowLankSql = "SELECT * FROM users ORDER BY point DESC";
    $LankNum = 0;
    $ShowLankResult = mysqli_query($conn, $ShowLankSql);

    ?>

    

    

    <div class="SectionBox">
    
        <div class="langkingBox">
            <div class="SelectLankSentance">

            </div>


            <div class="LankItemBox">
                
               <?php while($rowss = mysqli_fetch_array($ShowLankResult)){
                $LankNum ++;
                ?>
                <a href="profile.php?id=<?php echo $rowss['id']; ?>">
                    <div class="LankItem">
                        <div><p class="LankNum"><?php echo $LankNum; ?></p></div>
                        <div><img class="ShowUserImgBoxx ShowUserImgBoxx2" src="../../../userFile/profile_img/<?php echo $rowss['ProfileImg']; ?>"></div>
                        <div><p class="LankTitleName"><?php echo $rowss['id']; ?></p></div>
                        <div><p class="lankPotin">point : <?php echo $rowss['point']; ?></p></div>
                    </div>
                </a>

                <?php } ?>
               
            </div>
        </div>
       
   
    </div>
        
    
</body>

</html>