<?php
session_start();
$text = $_POST['text'];
$pdo = new PDO("mysql:host=localhost;dbname=newdb;", "root", "");

$sql = "SELECT * FROM my_table WHERE text=:text";
$statement = $pdo->prepare($sql);
$statement->execute(['text' => $text]);
$task = $statement->fetch(PDO::FETCH_ASSOC);

if(!empty($task))
{
    $message = "You should check in on some of those fields below.";
    $_SESSION['danger'] = $message;
    header("Location: /task/task_11.php");
    exit;
}

$sql = "INSERT INTO my_table (text) VALUES (:text)";
$statement = $pdo->prepare($sql);
$statement -> execute(['text' => $text]);

$message = "You should check in on some of those fields below.";
    $_SESSION['success'] = $message;

header("Location: /task/task_11.php");

?>

