<?php
//случайные вещественные числа
function random_float ($min,$max) {
    return ($min+lcg_value()*(abs($max-$min)));
}

if(isset($_COOKIE[session_name()]))
    session_start();

if(isset($_POST["exit-btn"])){
    //$_SESSION["login"] = "";
    //$_SESSION["password"] = "";

    session_destroy();

    header('Location: ../index.php');
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">

    <title>Задача</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../Bootstrap/styles/bootstrap.min.css">
    <link rel="stylesheet" href="../Bootstrap/styles/style.css">
    <link rel="stylesheet" href="../Bootstrap/styles/bootstrap-theme.min.css">
    <script src="../Bootstrap/js/jquery-3.2.1.min.js"></script>
    <script src="../Bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/jquery-3.2.1.min.js"></script>
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
                <button class="btn btn-default" id="enter-btn" type="submit">Вход</button>
                </form>
END;
            }
            else{
                $login = $_SESSION["login"];
                echo <<< END
                <ul class="nav navbar-nav">
                    <li><a href="../index.php">Главная</a></li>
                    <li class="active"><a href="page1.php">Задача №1</a></li>
                    <li><a href="page2.php">Задача №2</a></li>
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

<div class="task_1_page">
    <div class="container">
        <div class="col-md-9">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4>Вариант 19 ЛР 6</h4>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="img">
                        <img src="../img/var_19_lr_6.png" alt="">
                    </div>
                    <h3>Решение задачи</h3>
                    <?php
                    if (isset($_POST['ok_btn'])){

                        $min_value = $_POST['min_value'];
                        $max_value = $_POST['max_value'];

                        if($min_value >= $max_value){
                            echo '<script language="javascript">';
                            echo 'alert("Ошибка! min > max")';
                            echo '</script>';
                        }
                        else{
                            $squareMatrix = array();
                            for($i = 0; $i < $_POST['array_count_i']; $i++) {
                                for($j = 0; $j < $_POST['array_count_j']; $j++) {
                                    $squareMatrix[$i][$j] = rand($min_value, $max_value);
                                }
                            }

                            $sum=0;
                            echo "<table class='table table-bordered'>";
                            for($i = 0; $i < $_POST['array_count_i']; $i++){
                                echo "<tr>";
                                for($j = 0; $j < $_POST['array_count_j']; $j++) {
                                    echo "<td>", $squareMatrix[$i][$j], "</td>";
                                }
                                echo "</tr>";
                            }
                            echo "</table>";


                            for($i = 0; $i < $_POST['array_count_i']; $i++) {

                                for($j = 0; $j < $_POST['array_count_j']; $j++) {
                                    if($squareMatrix[$i][$j] >= 0){
                                        $sum += $squareMatrix[$i][$j];
                                    }
                                    else{
                                        $sum=0;
                                        break;
                                    }
                                }


                                echo "<p>Сумма строки $i равна $sum</p>";

                            }
                        }
                    }
                    else{
                        echo "<h3>Массив пуст, введите размер массива и диапазон значений для элементов массива</h3>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-primary" style="position: fixed";>
                <div class="panel-heading" style="text-align: center";>
                    <h4>Настройка массивов</h4>
                </div>
                <div class="panel-body">
                    <form method="post">
                        <label>Диапазон значений:</label>
                        <input class="form-control" type="number" name="min_value" placeholder="min">
                        <input class="form-control" type="number" name="max_value" placeholder="max">
                        <label>Размер массива:</label>
                        <input class="form-control" type="number" min="1" name="array_count_i" placeholder="i">
                        <input class="form-control" type="number" min="1" name="array_count_j" placeholder="j">
                        <button class="btn" name="ok_btn" type="submit" style="width: 100%; margin-top: 10px;">ОК</button>
                    </form>
                </div>
            </div>
            <div class="panel panel-primary" style="position: fixed; top: 43%;">
                <div class="panel-heading" style="text-align: center";>
                    <h4>Информация о массиве</h4>
                </div>
                <div class="panel-body">
                    <label>Диапазон:</label>
                    <?php
                    echo "<p>от: ", $_POST['min_value'], " до: ", $_POST['max_value'], "</p>";
                    echo "<label>Размер:</label>";
                    echo  "<p>", $_POST['array_count_i'], " на ", $_POST['array_count_j'], "</p>";
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>