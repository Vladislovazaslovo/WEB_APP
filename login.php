<?php
$host = 'db';
$user = 'root';
$password = '1111';
$dbname = 'semykin_db';

if (isset($_COOKIE['User'])) {
    header("Location: profile.php");
    exit;
}

if (isset($_POST['submit'])) {
    $username = $_POST['login'];
    $pass = $_POST['password'];
    
    if (!$username || !$pass) die('Пожалуйста введите все значения!');
    
    $link = mysqli_connect($host, $user, $password, $dbname);
    $sql = "SELECT * FROM users WHERE username='$username' AND pass='$pass'";
    $result = mysqli_query($link, $sql) or die("Ошибка в SQL запросе: " . mysqli_error($link));

    if (mysqli_num_rows($result) >= 1) {
        $row = mysqli_fetch_assoc($result);
        setcookie("User", $row['username'], time() + 7200, "/");
        header('Location: profile.php');
        exit;
    } 
    else {
        $error = "Неверное имя пользователя или пароль";
    }
}
?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
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
                <h4>Авторизация</h4>
            </div>
            <div class="card-body">
                <?php if(isset($error)): ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
                <form method="POST" action="login.php">
                    <div class="mb-3">
                        <label class="form-label">Логин</label>
                        <input type="text" name="login" class="form-control" placeholder="Ваш логин" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Пароль</label>
                        <input type="password" name="password" class="form-control" placeholder="Ваш пароль" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2" name="submit">Войти</button>
                </form>
            </div>
            <div class="card-footer text-center py-3">
                <small>Нет аккаунта? <a href="registration.php">Зарегистрироваться</a></small>
            </div>
        </div>
    </div>
</body>
</html>