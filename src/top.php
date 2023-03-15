<?php

$dsn ='mysql:dbname=webapp;host=db';
$user='root';
$password = 'root';

$dbh = new PDO($dsn,$user,$password);


$sql = 'SELECT*FROM hours ORDER BY id';

$today = date("Y-m-d");
echo($today);
$hours_sum = "select hour from hours where date = '$today'";
$today_hour = $dbh->query($hours_sum)->fetchAll(PDO::FETCH_COLUMN);
$today_total = array_sum($today_hour);

$today_month = date("Ym");
echo($today_month);

$today_month_total_a = "select sum(hour) from hours where date_format(date,'%Y%m')='$today_month'";
$today_mo = $dbh->query($today_month_total_a)->fetchAll(PDO::FETCH_COLUMN);
$today_month_total = array_sum($today_mo);

$all_hours = "select sum(hour) from hours ";
$total_hour = $dbh->query($all_hours)->fetchAll(PDO::FETCH_COLUMN);
$all_hours = array_sum($total_hour);


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
  <link rel="stylesheet" href="../ph1-webapp-develop/.vscode/src/css/reset.css">
  <link rel="stylesheet" href="../ph1-webapp-develop/.vscode/src/css/top.css">
  <script src="../js/calender.js" defer></script>
  <script src="../js/jquery-3.6.1.min.js" defer></script>
  <script src="../js/top.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js" integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA==" crossorigin="anonymous" referrerpolicy="no-referrer" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0-rc.1/dist/chartjs-plugin-datalabels.min.js" integrity="sha256-Oq8QGQ+hs3Sw1AeP0WhZB7nkjx6F1LxsX6dCAsyAiA4=" crossorigin="anonymous" defer></script>

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
              <p class="counterValue"><?= $today_total; ?></p>
              <p class="counterUnit">hour</p>
            </div>
          </div>
          <div class="counter">
            <div>
              <p class="counterHeadline">Month</p>
              <p class="counterValue"><?= $today_month_total?></p>
              <p class="counterUnit">hour</p>
            </div>
          </div>
          <div class="counter">
            <div>
              <p class="counterHeadline">Total</p>
              <p class="counterValue"><?= $all_hours?></p>
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