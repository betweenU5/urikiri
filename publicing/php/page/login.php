<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>우리끼리 | 로그인</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/Main.css">

</head>

<body>

    <?php
    include '../inc/menu.php';
    if ($jb_login) {

        echo "<script>
            alert('이미 로그인 되었습니다.');
            location.href = 'main.php';
            </script>";
    } else { ?>



        <div class="SectionBox">


            <div class="loginFormBox">
                <br><br><br>
                <p class="FormTItle">LOGIN</p>
                <form action="../action/login_action.php" method="post" autocomplete="off" class="FormBox" onsubmit="return LoginCheckForm()">
                    <input type="text" id="UserId" name="UserId" placeholder="이메일.com">
                    <input type="password" id="Password" name="Password" name="Password" placeholder="비밀번호">
                    <input type="hidden" id="token" name="token" value="">
                    <button class="SubmitButton" type="submit">Login</button>
                </form>
                <a class="subText" href="RegiSelectTag.php">아직 회원이 아닌가요?</a>
            </div>

        </div>

    <?php } ?>

</body>
<script type="module">
    import {
        initializeApp
    } from "https://www.gstatic.com/firebasejs/9.15.0/firebase-app.js";
    import {
        getMessaging,
        getToken
    } from "https://www.gstatic.com/firebasejs/9.15.0/firebase-messaging.js";

    const firebaseConfig = {
        apiKey: "AIzaSyDKJHLLFKYIcLW426HOGfS3DhMsuyV5PqY",
        authDomain: "propane-terra-321802.firebaseapp.com",
        projectId: "propane-terra-321802",
        storageBucket: "propane-terra-321802.appspot.com",
        messagingSenderId: "31702165816",
        appId: "1:31702165816:web:f0a4d6606a24660ec0b9cd",
        measurementId: "G-NXR693G2ED"
    };

    const app = initializeApp(firebaseConfig);
    const messaging = getMessaging(app);
    getToken(messaging, {
        vapidKey: "BPfcgnjBXu5BYm_rdTJ24-V0qEjrvIxqsCFxGt1dyFNA9GOGRwhNOl1ETybJ5RJLfh90UhVJW4kPTqBR0yLKaRg"
    }).then((currentToken) => {
        if (currentToken) {
            document.querySelector('#token').value = currentToken;
        } else {
            console.log("failed");
        }
    }).catch((error) => {
        console.log(error)
    });
</script>
<script>
    function LoginCheckForm() {
        let id = document.getElementById("UserId");
        let pw = document.getElementById("Password");

        if (id.value.trim().length > 0) {
            if (pw.value.trim().length > 0) {
                return true;
            } else {
                alert('비밀번호를 입력하세요');
                return false;
            }
        } else {
            alert('이메일을 입력하세요');
            return false;
        }
    }
</script>

</html>