<?php

// $dsn = 'mysql:dbname=webapp;host=db';
// $user = 'root';
// $password = 'root';

// $dbh = new PDO($dsn, $user, $password);

// $sql = 'SELECT*FROM hours ORDER BY id';

// $today = date("Y-m-d");
// $hours_sum = "select hour from hours where date = '$today'";
// $today_hour = $dbh->query($hours_sum)->fetchAll(PDO::FETCH_COLUMN);
// $today_total = array_sum($today_hour);

// $today_month = date("Ym");
// // echo ($today_month);
// $today_month_total_a = "select sum(hour) from hours where date_format(date,'%Y%m')='$today_month'";
// $today_mo = $dbh->query($today_month_total_a)->fetchAll(PDO::FETCH_COLUMN);
// $today_month_total = array_sum($today_mo);

// $all_hours = "select sum(hour) from hours ";
// $total_hour = $dbh->query($all_hours)->fetchAll(PDO::FETCH_COLUMN);
// $all_hours = array_sum($total_hour);

// $each_day_hours = $dbh->query("select hour from hours where date_format(date, '%Y%m')=202302 order by date")->fetchAll(PDO::FETCH_COLUMN);
// $json_each_day_hours = json_encode($each_day_hours);

// $each_day_dates = $dbh->query("select date from hours where date_format(date, '%Y%m')=202302 order by date")->fetchAll(PDO::FETCH_COLUMN);
// $json_each_day_dates = json_encode($each_day_dates);

// // 連携用のid取得

// $common_id = $dbh->query("select id from hours where date_format(date, '%Y%m')=202302 order by date")->fetchAll(PDO::FETCH_COLUMN);
// // その月のデータがあるid名

// $formatted_common_id = implode(',',$common_id);

// // ここまで棒グラフの値

// $language_id= $dbh->query("select language_id from hours_languages where id in ($formatted_common_id)")->fetchAll(PDO::FETCH_COLUMN); //何のlanguageなのか
// $content_id= $dbh->query("select content_id from hours_contents where id in ($formatted_common_id)")->fetchAll(PDO::FETCH_COLUMN); //何のn予備なのか

// $learning_language = $dbh->query("SELECT languages.language ,ROUND(sum(hours.hour/count), 1) AS hours ,languages.color from hours_languages as origin1 INNER JOIN languages on origin1.language_id  = languages.id LEFT OUTER JOIN hours on hours.id = origin1.hour_id LEFT OUTER JOIN (SELECT origin2.hour_id, COUNT(hour_id) AS count from hours_languages as origin2 group by hour_id) as origin3 on origin3.hour_id = origin1.hour_id group by origin1.language_id")->fetchAll(PDO::FETCH_ASSOC);
// $json_learning_language = json_encode(array_column($learning_language, 'language'));
// $json_learning_language_color = json_encode(array_column($learning_language, 'color'));

// // 1.配列の合計をだす
// // 2.foreachで割算

// $learning_content = $dbh->query("SELECT contents.content ,ROUND(sum(hours.hour/count), 1) AS hours ,contents.color from hours_contents as origin1 INNER JOIN contents on origin1.content_id  = contents.id LEFT OUTER JOIN hours on hours.id = origin1.hour_id LEFT OUTER JOIN (SELECT origin2.hour_id, COUNT(hour_id) AS count from hours_contents as origin2 group by hour_id) as origin3 on origin3.hour_id = origin1.hour_id group by origin1.content_id")->fetchAll(PDO::FETCH_ASSOC);
// $json_learning_content = json_encode(array_column($learning_content, 'content'));
// $json_learning_content_color = json_encode(array_column($learning_content, 'color'));

// $language_sum = array_sum(array_column($learning_language, 'hours'));
// $content_sum = array_sum(array_column($learning_content, 'hours'));

// $per_language = array_map(function($hour){
//   global $language_sum;
//   return round($hour/$language_sum * 100,0);
// },array_column($learning_language, 'hours'));

// $per_content = array_map(function($hour){
//   global $content_sum;
//   return round($hour/$content_sum * 100,0);
// },array_column($learning_content, 'hours'));

// $json_learning_language_hours = json_encode($per_language);
// $json_learning_content_hours = json_encode($per_content);

// // $formatted_language_id = json_encode($dbh->query("select language_id from hours_languages where id in ($formatted_common_id) order by '$formatted_common_id'")->fetchAll(PDO::FETCH_COLUMN));
// // $formatted_hours = $dbh->query("select hour from hours where id in ($formatted_common_id)")->fetchAll(PDO::FETCH_COLUMN);

// // $formatted_language_id = json_encode($dbh->query("select ")->fetchAll(PDO::FETCH_COLUMN));

// // formatted_language_idとformatted_hoursを使って配列を作る→group byでまとめる
// // var_dump($formatted_language_id);

// // ここまで円グラフの値

// // 下から計算
// // $language_quantity = $dbh->query("select count(distinct language_id) from hours_languages")->fetchAll(PDO::FETCH_COLUMN); //6
// // $content_quantity = $dbh->query("select count(distinct content_id) from hours_contents")->fetchAll(PDO::FETCH_COLUMN); //6

// // $language_sum = $dbh->query("select count(distinct content_id) from hours_contents")->fetchAll(PDO::FETCH_COLUMN); //6
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="【アカウント名(例：@santmove_com)】" />
    <meta name="twitter:title" content="【シェアするページのタイトル】" />
    <meta name="twitter:description" content="【シェアするページの概要】" />
    <meta name="twitter:image" content="【シェアするページのアイコン画像(絶対パス)】" />
    <meta name="twitter:url" content="【シェアするページのURL】" />

    <title>トップページ</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/reset.css"">
    <link rel="stylesheet" href="../css/top.css">
    <script src="{{asset('/js/calendar.js')}}" defer></script>
    <script src="{{asset('/js/jquery-3.6.1.min.js')}}" defer></script>
    <script src="{{asset('/js/top.js')}}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"
        integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0-rc.1/dist/chartjs-plugin-datalabels.min.js"
        integrity="sha256-Oq8QGQ+hs3Sw1AeP0WhZB7nkjx6F1LxsX6dCAsyAiA4=" crossorigin="anonymous" defer></script>

</head>

<body>
    <navbar>
        <div class="navbarTitle">
            <div class="navbarLogo">
                <img src="../img/top/logo.svg" alt="">
            </div>
            <div>
                <p class="navbarSubtitle">4th week</p>
            </div>
        </div>
        <button class="navbarButton modalOpen buttonOpen">
            記録・投稿
        </button>
    </navbar>
    <div class="modalWindow">
        <div class="modalContentsWrapper">
            <div class="modalNav">
                <button class="modalClose modalButton">✕<button>
            </div>
            <div class="modalContents">
                <div class="modalLeft">
                    <div class="modalDate">
                        <p>学習日</p>
                        <div class="modalInput">
                            <input id="modalInput">
                        </div>
                    </div>
                    <div class="modalContent">
                        <p>学習コンテンツ(複数選択可)</p>
                        <div class="choices">
                            <div>
                                <label class="modalCheckbox">
                                    <input type="checkbox">N予備校
                                </label>
                            </div>
                            <div>
                                <label class="modalCheckbox">
                                    <input type="checkbox">ドットインストール
                                </label>
                            </div>
                            <div>
                                <label class="modalCheckbox">
                                    <input type="checkbox">POSSE課題
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modalLanguage">
                        <p>学習言語(複数選択可)</p>
                        <div class="choices">
                            <div class="labels">
                                <label class="modalCheckbox">
                                    <input type="checkbox">HTML
                                </label>
                            </div>
                            <div class="labels">
                                <label class="modalCheckbox">
                                    <input type="checkbox">CSS
                                </label>
                            </div>
                            <div class="labels">
                                <label class="modalCheckbox">
                                    <input type="checkbox">JavaScript
                                </label>
                            </div>
                            <div class="labels">
                                <label class="modalCheckbox">
                                    <input type="checkbox">PHP
                                </label>
                            </div>
                            <div class="labels">
                                <label class="modalCheckbox">
                                    <input type="checkbox">Laravel
                                </label>
                            </div>
                            <div class="labels">
                                <label class="modalCheckbox">
                                    <input type="checkbox">SQL
                                </label>
                            </div>
                            <div class="labels">
                                <label class="modalCheckbox">
                                    <input type="checkbox">SHELL
                                </label>
                            </div>
                            <div class="labels">
                                <label class="modalCheckbox">
                                    <input type="checkbox">情報システム基礎知識(その他)
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modalRight">
                    <div class="modalHour">
                        <p>学習時間</p>
                        <div class="modalHourInput">
                            <input type="text">
                        </div>
                    </div>
                    <div class="modalTwitter">
                        <p>Twitter用コメント</p>
                        <div class="modalCommentInput">
                            <input type="text" id="postText">
                        </div>
                        <input type="checkbox" id="shareTwitter">Twitterにシェアする
                    </div>
                </div>
            </div>
            <div class="modalFooterWrapper">
                <div class="modalFooter modalPost loadingOpen">
                    <button>記録・投稿</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ******************以下ローディング画面************************************ -->
    <div class="modalLoading">
        <div class="loaderWrapper">
            <div class="loader"></div>
        </div>
    </div>

    <!-- ******************完了画面*************************************: -->

    <div class="modalPosted">
        <div class="modalPostedNav">
            <button class="modalClose modalButton">✕<button>
        </div>
        <div class="modalPostImgWrapper">
            <img src="../img/top/postdone.png" alt="" class="modalPostImg">
        </div>
    </div>

    <!-- *****************カレンダー**********************: -->

    <div class="modalCalender">
        <div class="modalNav">
            <button class="modalBack">←<button>
        </div>
        <div class="modalCalenderWrapper ">
            <div class="tableWrapper">

                <table>
                    <thead>
                        <tr>
                            <th id="prev">&laquo;</th>
                            <th id="title" colspan="5" class="title"></th>
                            <th id="next">&raquo;</th>
                        </tr>
                        <tr>
                            <th class="day">Sun</th>
                            <th class="day">Mon</th>
                            <th class="day">Tue</th>
                            <th class="day">Wed</th>
                            <th class="day">Thu</th>
                            <th class="day">Fri</th>
                            <th class="day">Sat</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td id="select" class="select" colspan="7">決定</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


    <!-- ***************************************************************** -->
    <div id="overLay" class="overLay">
    </div>

    <div class="contentsWrapper">
        <div class="contents">
            <div class="leftContents">
                <div class="counters">
                    <div class="counter">
                        <div>
                            <p class="counterHeadline">Today</p>
                            <p class="counterValue"> {{ $sumToday }}</p>
                            <p class="counterUnit">hour</p>
                        </div>
                    </div>
                    <div class="counter">
                        <div>
                            <p class="counterHeadline">Month</p>
                            <p class="counterValue">{{ $sumMonth }}</p>
                            <p class="counterUnit">hour</p>
                        </div>
                    </div>
                    <div class="counter">
                        <div>
                            <p class="counterHeadline">Total</p>
                            <p class="counterValue">{{ $sumAll }}</p>
                            <p class="counterUnit">hour</p>
                        </div>
                    </div>
                </div>
                <canvas class="leftGraph" id="leftGraph">
                    グラフ
                </canvas>
            </div>
            <div class="rightContents">
                <div class="learningLanguage">
                    <div class="pieChartHeadline">
                        <div>
                            <p>学習言語</p>
                        </div>
                        <div class="graphWrapper">
                            <canvas id="learningLanguageGraph" class="rightGraph">

                            </canvas>
                        </div>
                    </div>
                </div>
                <div class="learningContents">
                    <div class="pieChartHeadline">
                        <div>
                            <p>学習コンテンツ</p>
                        </div>
                        <div class="graphWrapper">
                            <canvas id="learningContentsGraph" class="rightGraph">
                            </canvas>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="datePage">
        <div class="dateWrapper">
            <div class="leftTriangle"></div>
            <p>2020年10月</p>
            <div class="rightTriangle"></div>
        </div>
    </div>
    <div class="phoneFooterButtonWrapper">
        <button class="navbarButton modalOpen buttonOpen phoneFooterButton">
            記録・投稿
        </button>
    </div>
</body>
</html>
    <script>
        {
            function openTwitter(text, url, hash, account) {
                var turl = "https://twitter.com/intent/tweet?text=" + text + "&url=" + url + "&hashtags=" + hash + "&via=" +
                    account;
                window.open(turl, '_blank');
            }

            // $(function(){

            //   $('.modalOpen').click(function(){
            //     $('#overLay, .modalWindow').fadeIn();
            //   });

            //   $('.modalInput').click(function(){
            //     $('#overLay, .modalCalender').fadeIn();
            //     // $('.modalWindow').fadeOut();
            //   })

            //   $('.modalClose').click(function(){
            //     $('#overLay, .modalWindow').fadeOut();
            //   })

            //   $('.modalBack').click(function(){
            //     $('#overLay, .modalWindow').fadeIn();
            //     $('.modalCalender').fadeOut();
            //   })

            //   $('.select').click(function(){
            //     $('.modalCalender').fadeOut();
            //   })

            //   $('.modalPost').click(function(){

            //     $('.modalWindow').fadeOut();
            //     $('.modalLoading').fadeIn();

            //     const share = document.getElementById('shareTwitter').checked;

            //     console.log(share);

            //     if(share == true){

            //     const postText = document.getElementById('postText');


            //     const text = postText.value;

            //     openTwitter(text,"","","");

            //     }

            //     setTimeout(function(){
            //       $('.modalLoading').fadeOut();
            //       $('.modalPosted').fadeIn();
            //     },3000);

            //   })

            //   $('.modalPostedNav').click(function(){
            //     $('.modalPosted').fadeOut();
            //   })

            // });

            // **********leftgraph*******************


            window.onload = function() {

                // ******************棒グラフ***************

                let context = document.getElementById('leftGraph').getContext('2d');

                new Chart(context, {
                    type: 'bar',
                    data: {
                        labels: <?php echo json_encode($json_each_day_dates); ?>,
                        // ↑日付の配列をぶち込む

                        // x軸の中身を記述

                        datasets: [{
                            backgroundColor: "#017AC5",
                            // ここにhoursが入る
                            data: <?php echo json_encode($json_each_day_hours); ?>,
                        }],
                    },
                    options: {
                        scales: {
                            y: {
                                ticks: {
                                    callback: function(value, index, values) {
                                        return value + 'h';
                                    },
                                    stepSize: 2,
                                },
                                grid: {
                                    display: false,
                                },
                            },
                            x: {
                                ticks: {
                                    display: true,
                                    drawTicks: false,
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false,
                            }
                        },
                        responsive: true,
                    }
                })

                // ************円グラフ*********************

                let contextTwo = document.getElementById('learningLanguageGraph').getContext('2d');

                new Chart(contextTwo, {
                    type: 'doughnut',
                    options: {
                        plugins: {
                            legend: {
                                position: "bottom",
                            },
                            datalabels: {
                                color: "white",
                                formatter: function(value, context) {
                                    return value.toString() + '%';
                                }
                            }
                        },
                        responsive: true,
                    },
                    plugins: [ChartDataLabels],
                    data: {
                        labels: <?php echo $json_learning_language; ?>,
                        render: "percentage",
                        datasets: [{
                            backgroundColor: <?php echo $json_learning_language_color; ?>,
                            data:<?php echo ($json_learning_language_hours);?>,
                            // ↑コメントアウト戻す
                            
                        }]
                    },
                })

                // ***********円グラフ２**************

                let contextThree = document.getElementById('learningContentsGraph').getContext('2d');

                new Chart(contextThree, {
                    type: 'doughnut',
                    options: {
                        plugins: {
                            legend: {
                                position: "bottom",
                            },
                            datalabels: {
                                color: "white",
                                formatter: function(value, context) {
                                    return value.toString() + '%';
                                }
                            }
                        },
                        responsive: true,
                    },
                    plugins: [ChartDataLabels],
                    data: {
                        labels: <?php echo $json_learning_content; ?>,
                        datasets: [{
                            backgroundColor: <?php echo $json_learning_content_color; ?>,
                            data:<?php echo ($json_learning_content_hours);?>,
                            // ↑コメントアウト戻す
                        }],
                    }
                })

            }
        }
    </script>