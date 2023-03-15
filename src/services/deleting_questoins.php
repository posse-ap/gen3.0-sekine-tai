<?php

$dsn = 'mysql:dbname=posse;host=db';
$user = 'root';
$password = 'root';

$dbh = new PDO($dsn, $user, $password);

$question = $dbh->query("SELECT * from questions")->fetchAll(PDO::FETCH_ASSOC);
$choices = $dbh->query("SELECT * from choices")->fetchAll(PDO::FETCH_ASSOC);

$id = $_GET["id"];

$stmt = $dbh->prepare("DELETE from questions where id = :id");
$stmt -> bindParam(':id', $id, PDO::PARAM_INT);
$res = $stmt -> execute();

$dbh = null;

header('Location: http://localhost:8080/admin/index.php');

exit();
?>