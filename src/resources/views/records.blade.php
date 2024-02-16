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

    <div class="contentsWrapper">
        <div class="contents">
            <div class="leftContents">
                <div class="counters">
                    <div class="counter">
                        <div>
                            <p class="counterHeadline">Today</p>
                            <p class="counterValue"> {{ $sumToday }}</p>
                            {{-- ↑ここには今日の学習時間の合計が表示されます。 --}}
                            <p class="counterUnit">hour</p>
                        </div>
                    </div>
                    <div class="counter">
                        <div>
                            <p class="counterHeadline">Month</p>
                            <p class="counterValue">{{ $sumMonth }}</p>
                            
                            {{-- ↑ここには今月の学習時間の合計が表示されます。 --}}
                            <p class="counterUnit">hour</p>
                        </div>
                    </div>
                    <div class="counter">
                        <div>
                            <p class="counterHeadline">Total</p>
                            <p class="counterValue">{{ $sumAll }}</p>
                            {{-- ↑ここにはこれまでの学習時間の合計が表示されます。 --}}
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

            window.onload = function() {

                // ******************棒グラフ***************
                // ここでは、今月の日付ごとの学習時間が棒グラフ上に表示されます。
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
                // ここでは、今月の学習時間が言語ごとに円グラフで表示されます、カラーコードはlanguagesテーブルのものを使用してください
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
               // ここでは、今月の学習時間がコンテンツごとに円グラフで表示されます、カラーコードはcontentテーブルのものを使用してください
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
                        }],
                    }
                })

            }
        }
    </script>