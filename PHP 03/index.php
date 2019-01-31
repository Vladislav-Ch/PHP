<?php
if(isset($_COOKIE[session_name()]))
    session_start();

if(isset($_POST["enter-btn"])){
    session_start();
    session_name("PHP-03");
}
if(isset($_POST["exit-btn"])){
    //$_SESSION = [];
    /*if (isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time()-10, '/');*/
    //session_unset();
    session_destroy();
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>PHP 03</title>

    <link rel="stylesheet" href="Bootstrap/styles/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="Bootstrap/js/bootstrap.min.js"></script>
    <script src="Bootstrap/js/jquery-3.2.1.min.js"></script>
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">PHP Занятие 03</a>
        </div>
        <?php
            if(session_id() == null){
                echo <<<END
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li><h4>Войдите в приложение</h4></li>
                        </ul>
                        <div class="nav-btn">
                        <form method="post">
                            <button class="btn btn-default" type="submit" name="enter-btn">Войти</button>
                        </form>
                        </div>
                    </div>
END;
            }
            else{
                echo <<<END
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="#">Главная</a></li>
                            <li><a href="pages/page1.php">Задача №1</a></li>
                            <li><a href="pages/page2.php">Задача №2</a></li>
                            <li><a href="pages/page3.php">Задача №3</a></li>
                        </ul>
                        <div class="nav-btn">
                        <form method="post">
                            <button class="btn btn-default" name="exit-btn">Выйти</button>
                        </form>
                        </div>
                    </div>
END;
            }
        ?>
    </div>
</nav>

<div class="task_page">
    <div class="container">
        <div class="col-md-offset-2 col-md-8">
            <h3>Теоретическая часть</h3>
            <ul>
                <li>Объектно-ориентированное программирование в PHP</li>
                <li>Конструктор и деструктор</li>
                <li>Свойства класса</li>
                <li>Методы класса</li>
                <li>Статические свойства и константы</li>
                <li>Статические методы класса</li>
                <li>Создание объектов классов</li>
                <li>Работа с массивами объектов</li>
            </ul>
            <h3>Практическая часть</h3>
            <p>Создайте веб-приложение для решения задач из сборника Лаптева В.В. (страница 23 – вариант 25, страница 25 – вариант 36, страница 66 – вариант 64):</p>
            <img src="img/task_25.jpg" alt="">
            <img src="img/task_36.png" alt="">
            <img src="img/task_64.jpg" alt="">
            <p>Данные вводим в формах, каждой задаче отведена своя страница, на главной странице разместить условия задач и навигацию для переходов по страницам.</p>
            <p>Для треугольника – длины сторон задаются параметрами конструктора, углы вычисляются по сторонам в конструкторе – покажем, что не все свойства задаются начальными значениями, некоторые могут вычисляться.</p>
            <p>Данные по товарам сохранять в файле в формате CSV, выводить таблицу товаров, итоговую сумму хранимых товаров.</p>
            <p>Для задачи 64: создавать абстрактный класс Body с одним защищенным свойством, абстрактный методы в классе не создавать, вместо этого – интерфейс IShape с методами расчета площади поверхности и объема. Производные классы расширяют класс Body, реализуют интерфейс IShape. </p>
            <p>Работа с приложением должна быть организована в виде сессии, хранить данные о моменте начала и завершения сессии. Начало сессии – момент нажатия кнопки «Вход», окончание сессии – момент нажатия кнопки «Выход». Логин и пароль не использовать. Переходы на решения задач – только после начала сессии.</p>
            <p>Записи занятия в формате TeamViewer14 нет из-за сбоя. Материалы занятия в этом же архиве.</p>
        </div>
    </div>
</div>
</body>
</html>