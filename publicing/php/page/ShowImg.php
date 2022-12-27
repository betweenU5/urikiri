<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>

    *{
        margin: 0;
        padding: 0;
    }

    html {
        height: 100%;
    }

    body {
        min-height: 100%;
        height: 100%;
        background-color: #0e0e0e;
    }

    

    .BoxBody{
        width : 100%;
        
    }


   

    .MainImg{
        display: block;
        margin: auto;
        position: absolute;
        left: 10%;
        right: 10%;
        top: 10%;
        bottom: 10%;
        width: 80%;
        cursor: zoom-in;
        margin-top: auto !important;
    }


</style>
<body>
    <?php 
        $path = $_GET["path"];
    ?>

    <div class="BigBox">
        <div class="BoxHeader">

        </div>
        <div class="BoxBody">
            <img src="<?php echo $path ?>" class="MainImg">
        </div>
        <div class="BoxFooter">

        </div>
    </div>
</body>
</html>