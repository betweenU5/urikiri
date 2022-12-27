<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>우리끼리 | 함께하는 공부</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/Main.css">
    <script src="../../js/main.js"></script>
    <style>
        .votebutton {
            border: none;
        }

        .cnt {
            font-size: 0.5rem;
            color: #ccc;
            position: absolute;
        }

        .ItemHeader {
            padding-top: 30px;
        }

        .otherItemBox {
            border-radius: 34px 34px 0px 0px;
        }

        #VoteItem {
            padding-top: 40px;
        }
    </style>
</head>

<body>

    <?php
    include '../inc/menu.php';
    ?>

    <div class="SectionBox">

        <div class="SlideBox">
            <ul class="SlideUl">
                <li class="SlieLi">
                    <img src="../../../source/img/Slide01.png" class="SlideImg">
                </li>
                <li class="SlieLi">
                    <img src="../../../source/img/Slide02.png" class="SlideImg">
                </li>
                <li class="SlieLi">
                    <img src="../../../source/img/Slide03.png" class="SlideImg">
                </li>
                <li class="SlieLi">
                    <img src="../../../source/img/Slide04.png" class="SlideImg">
                </li>
                <li class="SlieLi">
                    <img src="../../../source/img/Slide05.png" class="SlideImg">
                </li>
            </ul>
        </div>

        <div class="QuestionSelectBox">
            <a href="../page/WriteBoardForm.php">
                <div class="SelectBox">
                    <img src="../../../source/img/pencil.png" class="SelectQImg">
                    <p class="ButtonText">질문글 작성</p>
                </div>
            </a>
            <a href="../page/MatchingSelectTag.php">
                <div class="SelectBox">
                    <img src="../../../source/img/live-chat.png" class="SelectQImg">
                    <p class="ButtonText">고수 매칭</p>
                </div>
            </a>
            <p class="normalText" onclick="//location.href = '../page/VoteList.php'">
                현재 진행중인 투표
            </p>


            <?php
            $SelectVoteSql = "SELECT * FROM vote";
            $SelectVoteSqlRes = mysqli_query($conn, $SelectVoteSql);
            $torrws = mysqli_fetch_assoc($SelectVoteSqlRes);

            $Sum = $torrws['left_interest_idx'] + $torrws['right_interest_idx'];

            $FstPercent = sprintf('%0.2f', $torrws['left_interest_idx'] / $Sum) * 100;

            $SndPercent = sprintf('%0.2f', $torrws['right_interest_idx'] / $Sum) * 100;
            ?>
            <div class="SelectOneBox">



                <div class="ItemBox" id="VoteItem">
                    <div class="VoteItem">
                        <?php echo $torrws['left_title'] ?>
                        <span class="cnt"><?php echo $torrws['left_interest_idx'] ?></span>
                    </div>
                    <div class="VoteItem">
                        <?php echo $torrws['right_title'] ?>
                        <span class="cnt"><?php echo $torrws['right_interest_idx'] ?></span>
                    </div>
                </div>

                <div class="VsBar">
                    <div class="barItem" style="width: <?php echo $FstPercent ?>%;" id="Voteitem1"><?php echo $FstPercent ?>%</div>
                    <div class="barItem" style="width: <?php echo $SndPercent ?>%;" id="Voteitem2"><?php echo $SndPercent ?>%</div>
                </div>

                <div class="ItemBox">
                    <div class="VoteItem">
                        <a href="../action/vote_action.php?id=1">
                            <div class="votebutton">투표</div>
                        </a>
                    </div>
                    <div class="VoteItem">
                        <a href="../action/vote_action.php?id=2">
                            <div class="votebutton">투표</div>
                        </a>
                    </div>
                </div>

            </div>

        </div>

        <div class="otherItemBox">

            <div class="ItemHeader">
                <div id="Text1">많이 본 질문</div>
                <div id="Text2"><a href="../page/board.php">더보기</a></div>
            </div>

            <div class="ListBox">
                <?php

                $ShowAllSql = "SELECT * FROM question ORDER BY View DESC";
                $ShowAllRes = mysqli_query($conn, $ShowAllSql);
                $i = 0;


                while ($resss = mysqli_fetch_array($ShowAllRes)) {

                    $FindAnswerCnt = "SELECT * FROM answer WHERE question_idx = '" . $resss['idx'] . "'";
                    $FindCntRes = mysqli_query($conn, $FindAnswerCnt);
                    $roesrr = mysqli_num_rows($FindCntRes);

                    $i++;
                    if ($i > 5) {
                        break;
                    }
                ?>
                    <a href="BoradReadmore.php?idx=<?php echo $resss['idx'] ?>">
                        <div class="listItem">
                            <div class="ListItemHeader">
                                <div class="ItemNum"><?php echo $i ?></div>
                                <span class="ItemTitle"><?php echo $resss['title'] ?></span>
                            </div>

                            <div class="ListItemBody">
                                <div class="ItemText">
                                    <?php echo $resss['context'] ?>
                                </div>
                            </div>

                            <div class="ListItemFooter">
                                <div id="footerItem1">조회수 <?php echo $resss['view'] ?></div>
                                <p>|</p>
                                <div id="footerItem2">답변수 <?php echo $roesrr ?></div>
                            </div>
                        </div>
                    </a>

                <?php

                } ?>

            </div>
        </div>

        <div class="TotalBox">
            <div class="TotalBoxHeader">
                <br>
                <p class="TotalBoxHeaderTitle">TOTAL</p>
            </div>
            <br>
            <div class="TotalValueBox">
                <?php
                date_default_timezone_set("Asia/Seoul");
                $TodayDate = explode(" ", date("Y-m-d H:i:s"));
                $date = $TodayDate[0];
                $time = $TodayDate[1];
                $FindTodayQSql = "SELECT COUNT(*) FROM question WHERE create_date = '" . $date . "';";
                $FindTodayQRes = mysqli_query($conn, $FindTodayQSql);
                $findTodayQrows = mysqli_fetch_assoc($FindTodayQRes);

                $FindTodayASql = "SELECT COUNT(*) FROM answer WHERE create_date LIKE '" . $date . "%';";
                $FindTodayARes = mysqli_query($conn, $FindTodayASql);
                $findTodayArows = mysqli_fetch_assoc($FindTodayARes);

                $FindTodayMatchSql = "SELECT COUNT(*) FROM chat_room WHERE create_date LIKE '" . $date . "%';";
                $FindTodayMatchRes = mysqli_query($conn, $FindTodayMatchSql);
                $findTodayMatchrows = mysqli_fetch_assoc($FindTodayMatchRes);

                ?>
                <div id="Check1">
                    <p>오늘의 질문 수</p>
                    <span><?php echo $findTodayQrows['COUNT(*)'] ?></span>
                </div>
                <div id="Check2">
                    <p>오늘의 답변 수</p>
                    <span><?php echo $findTodayArows['COUNT(*)'] ?></span>
                </div>
                <div id="Check3">

                    <p>오늘의 매칭 수</p>
                    <span><?php echo $findTodayMatchrows['COUNT(*)'] ?></span>
                </div>
            </div>
        </div>

    </div>
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
                console.log(currentToken);
            } else {
                console.log("failed");
            }
        }).catch((error) => {
            console.log(error)
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
    </script>
</body>

</html>