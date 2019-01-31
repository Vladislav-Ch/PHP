<?php

if(isset($_COOKIE[session_name()]))
    session_start();

if(isset($_POST["enter-btn"])){
    session_start();

    $login = $_POST["login"];
    $password = $_POST["password"];

    session_name($login);
    $_SESSION["login"] = $login;
    $_SESSION["password"] = $password;

}

if(isset($_POST["exit-btn"])){
    //$_SESSION["login"] = "";
    //$_SESSION["password"] = "";

    session_destroy();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>PHP Занятие 01</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="Bootstrap/styles/bootstrap.min.css">
    <link rel="stylesheet" href="Bootstrap/styles/style.css">
    <link rel="stylesheet" href="Bootstrap/styles/bootstrap-theme.min.css">
    <script src="Bootstrap/js/jquery-3.2.1.min.js"></script>
    <script src="Bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">PHP Занятие 02</a>
        </div>

        <div class="collapse navbar-collapse">
            <?php
            if(!isset($_SESSION["login"]) && !isset($_SESSION["password"])){
                echo <<< END
                <ul class="nav navbar-nav">
                    <li><h3>Войдите в приложение</h3></li>
                </ul>
                <form class="form-inline" method="post">
                <input class="form-control" type="text" name="login" placeholder="Введите логин">
                <input class="form-control" type="password" name="password" placeholder="Введите пароль">
                <button class="btn btn-default" id="enter-btn" type="submit" name="enter-btn">Вход</button>
                </form>
END;
            }
            else{
                $login = $_SESSION["login"];
                echo <<< END
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Главная</a></li>
                    <li><a href="pages/page1.php">Задача №1</a></li>
                    <li><a href="pages/page2.php">Задача №2</a></li>
                </ul>
                <div class="form-inline">
                <p style="float: left; margin-right: 10px;">Добро пожаловать $login</p>
                <form method="post" style="float: left; margin-right: 10px;">
                <button class="btn btn-default" id="exit-btn" type="submit" name="exit-btn">Выход</button>
                </form>
                </div>
END;
            }
            ?>
        </div>
    </div>
</nav>

<div class="task_page">
    <div class="container">
        <div class="col-md-offset-2 col-md-8">
            <h3>Теоретическая часть</h3>
            <ul>
                <li>Куки в PHP. Создание, изменение, удаление.</li>
                <li>Сессии в PHP. Понятия, запись и чтение данных сессии. Удаление данных сессии. Создание и удаление сессии. </li>
                <li>Работа с файлами в PHP. Настройка каталога загрузки файлов в php.ini. Загрузка файлов на сервер. Открытие, чтение и запись файлов. Перемещение указателя файловой операции. Закрытие файла.</li>
            </ul>
            <h3>Практическая часть</h3>
            <p>Разработайте веб-приложение по следующей спецификации – главная страница с меню для перехода на страницы решения задач – <strong>варианты 19 ЛР 5 и 19 ЛР 6</strong> из учебника Павловской Т.А. по C#.</p>
            <img src="img/var_19_lr_5.png" alt="">
            <img src="img/var_19_lr_6.png" alt="">
            <ul>
                <li>В куки хранить посещенные формы/страницы. </li>
                <li>Выводить на странице количество посещений</li>
                <li>При посещении всех страниц - выводить сообщение, делать невозможным переход на эти страницы. </li>
                <li>Предусмотреть кнопку удаления куки</li>
                <li>Добавить сессию в работу приложения – пользователь должен войти в приложение, имя и пароль храним в данных сессии, без входа не допускать на страницы вариантов, предусмотреть ссылку для выхода из приложения (завершение сессии)</li>
            </ul>
            <p>На странице задачи отображать условие задачи, выводить результаты работы задачи, должна быть ссылка для возврата на главную страницу. </p>
            <p>Выполнить стилизацию приложения при помощи Bootstrap или другими наборами стилей.</p>
            <p>Материалы занятия – в этом же архиве. Запись занятия можно скачать по  <a href="https://cloud.mail.ru/public/14Qb/pfof836UV">тут</a>.</p>
        </div>
    </div>
</div>

</body>
</html>