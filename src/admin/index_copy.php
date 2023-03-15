<?php

$dsn ='mysql:dbname=posse;host=db';
$user ='root';
$password ='root';

$dbh = new PDO($dsn, $user, $password);

$sql = 'SELECT * FROM questions';

// foreach($dbh->query($sql) as $row){
//   print_r($row);

// }

$questions = $dbh->query("SELECT * FROM questions")->fetchAll(PDO::FETCH_ASSOC);
$choices = $dbh->query("SELECT * FROM choices")->fetchAll(PDO::FETCH_ASSOC);

foreach ($choices as $key => $choice) {
  
  $index = array_search($choice["question_id"], array_column($questions, 'id'));
  $questions[$index]["choices"][] = $choice;

}

// print_r($questions);


?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href="../admin/reset.css"> -->
  <link rel="stylesheet" href="../assets/styles/common.css">
  <link rel="stylesheet" href="../admin/admin.css">
  <title>Document</title>
</head>

<body>
<?php include(dirname(__FILE__) . '/../components/admin/header.php'); ?>
  <div class="wrapper">
  <?php include(dirname(__FILE__) . '/../components/admin/sidebar.php'); ?>
    <main>
      <div class="container">
        <h1 class="mb-4">問題一覧</h1>
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>問題</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($questions as $question){ ?>
            <tr id="question-<?= $question["id"]?>">
              <td>
                <a href="./questions/edit.php?id=<?= $question["id"]?>">
                  <?= $question["content"]; ?>
                </a>
              </td>
              <td onclick="deleteQuestion(<?= $question['id']?>)">削除</td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <script>
        const deleteQuestion = async (questionId) => {
          if (!confirm('削除してもいい？'))return
          const res = await fetch(`http://localhost:8080/services/delete_question.php?id=${questionId}` , {method: 'DELETE'});
          if(res.status === 200){
            alert('削除しました')
            document.getElementById(`question-${questionId}`).remove()
          }else{
            alert('できないッピ！')
          }
        }
      </script>
    </main>
  </div>
</body>
</html>