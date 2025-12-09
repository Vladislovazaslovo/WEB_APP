<?php
$host = 'db';
$user = 'root';
$password = '1111';
$dbname = 'semykin_db';

$link = mysqli_connect($host, $user, $password, $dbname);
if ($link) {
    mysqli_query($link, "CREATE DATABASE IF NOT EXISTS $dbname");
    mysqli_select_db($link, $dbname);
    mysqli_query($link, "CREATE TABLE IF NOT EXISTS users(
        id INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(255) NOT NULL,
        username VARCHAR(15) NOT NULL,
        pass VARCHAR(255) NOT NULL
    )");
}

if (isset($_COOKIE['User'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $username = $_POST['login'];
    $pass = $_POST['password'];
    
    if (!$email || !$username || !$pass) die('Пожалуйста введите все значения!');
    
    $link = mysqli_connect($host, $user, $password, $dbname);
    $sql = "INSERT INTO users (email, username, pass) VALUES ('$email', '$username', '$pass')";

    if(mysqli_query($link, $sql)){
        setcookie("User", $username, time() + 7200, "/");
        header('Location: profile.php');
        exit;
    } else {
        echo "Не удалось добавить пользователя: " . mysqli_error($link);
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .container { margin-top: 50px; max-width: 500px; }
        .card { border: none; box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15); }
        .card-header { background: #0d6efd; color: white; font-weight: bold; }
        .btn-primary { background: #0d6efd; border: none; }
        .form-control:focus { border-color: #86b7fe; box-shadow: 0 0 0 0.25rem rgba(13,110,253,.25); }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header text-center py-3">
                <h4>Регистрация</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="registration.php">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="example@mail.ru" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Логин</label>
                        <input type="text" name="login" class="form-control" placeholder="Придумайте логин" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Пароль</label>
                        <input type="password" name="password" class="form-control" placeholder="Не менее 6 символов" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2" name="submit">Зарегистрироваться</button>
                </form>
            </div>
            <div class="card-footer text-center py-3">
                <small>Уже есть аккаунт? <a href="login.php">Войти</a></small>
            </div>
        </div>
    </div>
</body>
</html>