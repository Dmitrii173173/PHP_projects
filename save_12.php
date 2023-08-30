<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

$pdo = new PDO("mysql:host=localhost;dbname=newdb;", "root", "");

$sql = "SELECT * FROM my_table_email WHERE email=:email";
$statement = $pdo->prepare($sql);
$statement->execute(['email' => $email]);
$user = $statement->fetch(PDO::FETCH_ASSOC);

if(!empty($user))
{
    $_SESSION['error'] = "Этот эл адрес уже занят другим пользователем";
    header("Location: /task/task_12.php");
    exit;
}

$hasher_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO my_table_email (email, password) VALUES (:email, :password)";
$statement = $pdo->prepare($sql);
$statement->execute(['email'=>$email, 'password'=>$hasher_password]);
header("Location: /task/task_12.php");
?>



