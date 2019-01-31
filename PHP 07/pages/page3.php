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

    <title>Запрос №1</title>
    <link rel="stylesheet" href="../Bootstrap/styles/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../Bootstrap/js/jquery-3.2.1.min.js"></script>
    <script src="../Bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">PHP Занятие 07</a>
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
                            <li class="dropdown"><a href="" class="dropdown-toggle" data-toggle="dropdown">Запросы<span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="page1.php">Запрос №1</a></li>
									<li><a href="page2.php">Запрос №2</a></li>
									<li><a href="page3.php">Запрос №3</a></li>
									<li><a href="page4.php">Запрос №4</a></li>
									<li><a href="page5.php">Запрос №5</a></li>
									<li><a href="page6.php">Запрос №6</a></li>
									<li><a href="page7.php">Запрос №7</a></li>
									<li><a href="page8.php">Запрос №8</a></li>
									<li><a href="page9.php">Запрос №9</a></li>
									<li><a href="page10.php">Запрос №10</a></li>
									<li><a href="page11.php">Запрос №11</a></li>
									<li><a href="page12.php">Запрос №12</a></li>
								</ul>
							</li>
							<li><a href="https://test-sytecom.000webhostapp.com">Сайт</a></li>
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
            <p>Выбирает из таблиц АГЕНТЫ и ДОГОВОРЫ информацию о страховых агентах и договорах, для которых значение в поле Сумма страхования не меньше значение1 руб. Значение1 задается при выполнении запроса</p>
            <?php
            // получить данные подключения
            require_once "../connection.php";

            // подключаемся к серверу
            $link = mysqli_connect($host, $user, $password, $database)
            or die("Ошибка ".mysqli_error($link));

            //Покажем все данные
            // Запрос
            $query = "select
                        Contracts.id as 'id'
                         ,concat(Insurance_Agents.surname_agent, ' ', substring(Insurance_Agents.name_agent,1,1), '.', substring(Insurance_Agents.patronymic_agent,1,1), '.') as 'agent'
                         ,insurance_amount as 'summa'
                    from
                        Contracts join Insurance_Agents on Contracts.id_agent = Insurance_Agents.id";

            $result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));

            if($result) {
                // $rows = mysqli_num_rows($result);     // количество полученных строк

                // Доступ к данным, прочитанным из таблицы, как к объекту
                // Свойства объекта - поля запроса
                echo "<table class='table table-striped'><tr><th>№</th><th>Фамилия И. О.</th><th>Сумма</th></tr>";
                while($row = mysqli_fetch_object($result)) {
                    echo "<tr>";
                    echo "<td>".$row->id."</td>";
                    echo "<td>".$row->agent."</td>";
                    echo "<td>".$row->summa."</td>";
                    echo "</tr>";
                } // while
                echo "</table>";

                // очищаем результат после обработки запроса
                mysqli_free_result($result);
            } // if

            //покажем данные по нажатию кнопки
            if(isset($_POST["btn_ok"])){

                $summa = $_POST["summa"];

                // подключаемся к серверу
                $link = mysqli_connect($host, $user, $password, $database)
                or die("Ошибка ".mysqli_error($link));

                // Запрос
                $query = "select
                            Contracts.id as 'id'
                             ,concat(Insurance_Agents.surname_agent, ' ', substring(Insurance_Agents.name_agent,1,1), '.', substring(Insurance_Agents.patronymic_agent,1,1), '.') as 'agent'
                             ,insurance_amount as 'summa'
                        from
                            Contracts join Insurance_Agents on Contracts.id_agent = Insurance_Agents.id
                        where
                            Contracts.insurance_amount > $summa;";

                $result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));

                // $result - массив, выборка записей из БД
                if($result) {
                    // $rows = mysqli_num_rows($result);     // количество полученных строк

                    // Доступ к данным, прочитанным из таблицы, как к объекту
                    // Свойства объекта - поля запроса
                    echo "<table class='table table-striped'><tr><th>№</th><th>Фамилия И. О.</th><th>Сумма</th></tr>";
                    while($row = mysqli_fetch_object($result)) {
                        echo "<tr>";
                        echo "<td>".$row->id."</td>";
                        echo "<td>".$row->agent."</td>";
                        echo "<td>".$row->summa."</td>";
                        echo "</tr>";
                    } // while
                    echo "</table>";

                    // очищаем результат после обработки запроса
                   mysqli_free_result($result);
                } // if
            }
            ?>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Ввод данных
                </div>
                <div class="panel-body">
                    <form method="post">
                        <label>Сумма:</label>
                        <input type="text" class="form-control" name="summa" required>
                        <button class="btn" type="submit" name="btn_ok">ОК</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




</body>
</html>