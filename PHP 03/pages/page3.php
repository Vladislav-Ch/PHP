<?php
if(isset($_COOKIE[session_name()]))
    session_start();

if(isset($_POST["exit-btn"])){
    $_SESSION = [];
    if (isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time()-1000, '/');
    session_destroy();
    header('Location: ../index.php');
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">

    <title>Абстрактный класс</title>
    <link rel="stylesheet" href="../Bootstrap/styles/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../Bootstrap/js/bootstrap.min.js"></script>
    <script src="../Bootstrap/js/jquery-3.2.1.min.js"></script>
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
                            <li><p>Войдите в приложение</p></li>
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
                            <li><a href="../index.php">Главная</a></li>
                            <li><a href="page1.php">Задача №1</a></li>
                            <li><a href="page2.php">Задача №2</a></li>
                            <li class="active"><a href="#">Задача №3</a></li>
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

<div class="task_page1">
    <div class="container">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Параллелепипед и Шар
                </div>
                <div class="panel-body">
                    <?php
                    require_once ("../class/Body.php");
                    if(isset($_POST["ok-btn"])){
                        $ball = new Ball($_POST["radius"]);
                        echo "<h3 style='text-align: center'>Шар</h3>";
                        $ball->toString();


                        $parallelepiped = new Parallelepiped($_POST["sideA"], $_POST["sideB"], $_POST["sideC"]);
                        echo "<h3 style='text-align: center'>Параллелепипед</h3>";
                        $parallelepiped->toString();
                    }
                    else{
                        echo "<h4>Введите данные</h4>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Ввод данных
                </div>
                <div class="panel-body">
                    <form method="post">
                        <label>Радиус</label>
                        <input class="form-control" required min="1" type="number" placeholder="Радиус" name="radius">
                        <hr>
                        <label>Сторона А</label>
                        <input class="form-control" required min="1" type="number" placeholder="Сторона А" name="sideA">
                        <label>Сторона B</label>
                        <input class="form-control" required min="1" type="number" placeholder="Сторона B" name="sideB">
                        <label>Сторона C</label>
                        <input class="form-control" required min="1" type="number" placeholder="Сторона C" name="sideC">
                        <hr>
                        <button class="btn btn-default" type="submit" name="ok-btn">OK</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




</body>
</html>