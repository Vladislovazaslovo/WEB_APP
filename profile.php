<?php
$host = 'db';
$user = 'root';
$password = '1111';
$dbname = 'semykin_db';

if (!isset($_COOKIE['User'])) {
    header("Location: login.php");
    exit;
}
$username = $_COOKIE['User'];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); height: 100vh; }
        .profile-card { 
            background: white; 
            border-radius: 15px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.2); 
            margin-top: 100px; 
            max-width: 500px; 
            overflow: hidden;
        }
        .profile-header { 
            background: #0d6efd; 
            color: white; 
            padding: 30px 0; 
            text-align: center;
        }
        .avatar {
            width: 100px;
            height: 100px;
            background: white;
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: #0d6efd;
        }
        .profile-body { padding: 30px; }
        .logout-btn {
            display: block;
            width: 100%;
            padding: 10px;
            background: #f8f9fa;
            color: #dc3545;
            border: none;
            border-radius: 5px;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-card mx-auto">
            <div class="profile-header">
                <div class="avatar">
                    <span>👤</span>
                </div>
                <h2>Добро пожаловать!</h2>
            </div>
            <div class="profile-body text-center">
                <h1>Привет, <?= $username ?>!</h1>
                <p>Вы успешно авторизовались в системе</p>
                <a href="login.php?logout=1" class="logout-btn">Выйти из аккаунта</a>
            </div>
        </div>
    </div>
</body>
</html>