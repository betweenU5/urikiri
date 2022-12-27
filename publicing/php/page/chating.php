<?php include "../inc/session.php"; ?>
<?php include "../inc/Dbcnt.php"; ?>
<?php
$user = $_SESSION["username"];
$to = $_POST["to"];
$room = null;

$sql = "SELECT * FROM chat_room WHERE (host_user_idx = (SELECT idx FROM users WHERE id = '" . $user . "') OR member_user_idx = (SELECT idx FROM users WHERE id = '" . $user . "')) AND (host_user_idx = (SELECT idx FROM users WHERE id = '" . $to . "') OR member_user_idx = (SELECT idx FROM users WHERE id = '" . $to . "'));";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$host_user_idx = null;
$member_user_idx = null;

if (isset($row)) {
    $room = $row["host_user_idx"] . "to" . $row["member_user_idx"];
    $host_user_idx = $row["host_user_idx"];
    $member_user_idx = $row["member_user_idx"];
} else {
    $sql = "INSERT INTO chat_room VALUES (NULL, (SELECT idx FROM users WHERE id = '" . $user . "'), (SELECT idx FROM users WHERE id = '" . $to . "'), '" . date("Y-m-d", time()) . "')";
    $conn->query($sql);
    $sql = "SELECT * FROM chat_room WHERE (host_user_idx = (SELECT idx FROM users WHERE id = '" . $user . "') OR member_user_idx = (SELECT idx FROM users WHERE id = '" . $user . "')) AND (host_user_idx = (SELECT idx FROM users WHERE id = '" . $to . "') OR member_user_idx = (SELECT idx FROM users WHERE id = '" . $to . "'));";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $room = $row["host_user_idx"] . "to" . $row["member_user_idx"];
    $host_user_idx = $row["host_user_idx"];
    $member_user_idx = $row["member_user_idx"];
}
/*
채팅 보내기

보낼 사람 선택

if 기존 채팅방 없을시
(채팅방 만듦) 
보낸 사람 id,
받는 사람 id,
방 id (생성)

else 있을시
방 id 가져오기
*/
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/Dstyle.css">
</head>
<style>
    .otherUserName {
        width: 70%;
        text-align: center;
        left: 17%;
    }
</style>

<body>
    <div class="header">
        <a href="chatList.php">
            <svg class="ss" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                <path d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 278.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z" />
            </svg>
        </a>
        <p class="otherUserName"><?= $to ?>님</p>
    </div>
    <div class="Boxbox">
        <div class="chatingViewBox" id="ColorGray">

            <?php
            // 이부분 
            $result = $conn->query("SELECT * FROM chat WHERE chat_idx = (SELECT idx FROM chat_room WHERE host_user_idx = '$host_user_idx' AND member_user_idx = '$member_user_idx')");
            $idx = $conn->query("SELECT idx FROM users WHERE id = '$user'")->fetch_row()[0];

            while ($row = $result->fetch_assoc()) {
            ?>
                <div class="TalkTextBox">
                    <div class="textBox <?= $idx == $row["user_idx"] ? "right" : "left" ?>">
                        <div class="dd">
                            <p><?= $row["text"] ?></p>
                        </div>
                    </div>
                </div>
            <?php
            }

            ?>

        </div>

        <div class="MassageInput">
            <form action="#" class="Massageform" autocomplete="off" method="post" onsubmit="return sendMessage(event)">
                <input type="text" id="content" name="content">
                <button class="btn btn-massage" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                        <path d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L277.3 424.9l-40.1 74.5c-5.2 9.7-16.3 14.6-27 11.9S192 499 192 488V392c0-5.3 1.8-10.5 5.1-14.7L362.4 164.7c2.5-7.1-6.5-14.3-13-8.4L170.4 318.2l-32 28.9 0 0c-9.2 8.3-22.3 10.6-33.8 5.8l-85-35.4C8.4 312.8 .8 302.2 .1 290s5.5-23.7 16.1-29.8l448-256c10.7-6.1 23.9-5.5 34 1.4z" />
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.socket.io/4.5.4/socket.io.min.js" integrity="sha384-/KNQL8Nu5gCHLqwqfQjA689Hhoqgi2S84SNUxC3roTe4EhJ9AfLkp8QiQcU8AMzI" crossorigin="anonymous"></script>
    <script type="module">
        import {
            initializeApp
        } from "https://www.gstatic.com/firebasejs/9.15.0/firebase-app.js";
        import {
            getMessaging,
            getToken,
            onMessage
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
        onMessage(messaging, (payload) => {
            console.log('Message received. ', payload);
        });
    </script>
    <script>
        function checkNotificationPromise() {
            try {
                Notification.requestPermission().then();
            } catch (e) {
                return false;
            }

            return true;
        }
        checkNotificationPromise();

        let ChatBoxx;
        window.onload = function() {
            ChatBoxx = document.querySelector(".chatingViewBox");
            ChatBoxx.scrollTop = ChatBoxx.scrollHeight;
        }

        // let conn = new WebSocket('wss://urikiri.gbsw.hs.kr/socket');
        const socket = io("https://urikiri.gbsw.hs.kr");
        let user = "<?= $user ?>";
        let to = "<?= $to ?>";

        socket.emit('data', {
            user: user,
            to: to
        });

        function sendMessage(e) {
            let msg = document.querySelector('#content').value;

            if (msg.length == 0) return false;

            socket.emit('chat', {
                chat: msg
            });

            document.querySelector('#content').value = "";

            return false;
        }

        function receiveMessage(e) {
            if (e.id !== user) {
                document.querySelector('#ColorGray').innerHTML += `<div class="TalkTextBox"> <div class="textBox left"> <div class="dd"> <p>${unescape(e.msg)}</p> </div> </div> </div>`
            } else {
                document.querySelector('#ColorGray').innerHTML += `<div class="TalkTextBox"> <div class="textBox right"> <div class="dd"> <p>${unescape(e.msg)}</p> </div> </div> </div>`
            }
            ChatBoxx.scrollTop = ChatBoxx.scrollHeight;
        }

        socket.on("chat", (msg) => {
            receiveMessage(msg);
        });
    </script>
</body>

</html>