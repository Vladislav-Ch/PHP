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

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>Товары</title>
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
                            <li class="active"><a href="#">Задача №2</a></li>
                            <li><a href="page3.php">Задача №3</a></li>
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
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Товар
                </div>
                <div class="panel-body">
                    <?php
                    require_once ("../class/Gods.php");

                    $goods = array(new Gods(1, "товар1", "02/12", 5000, 5, "№001"), new Gods(2, "товар2", "25/12", 2000, 5, "№002"), new Gods(3, "товар3", "01/12", 1000, 2, "№003"));

                    $fp = fopen('../file/file.csv', 'w');

                    //UTF-8
                    fprintf($fp, chr(0xEF).chr(0xBB).chr(0xBF));
                    //запись в файл
                    for($i=0;$i<count($goods); $i++){
                        fputcsv($fp, array($goods[$i]->id, $goods[$i]->name, $goods[$i]->date, $goods[$i]->price, $goods[$i]->count, $goods[$i]->number));
                    }

                    fclose($fp);

                    //вывод товаров в виде таблицы
                    echo "<table class='table table-striped'><tbody><tr><th>ID</th><th>Наименование</th><th>Дата</th><th>Цена</th><th>Кол-во</th><th>Номер накладной</th></tr>";
                    for($i=0;$i<count($goods); $i++){
                        echo "".$goods[$i]->show()."";
                    }
                    echo "</tbody></table>";

                    ?>
                </div>
                <div class="panel-footer">

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>