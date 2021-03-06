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

    <title>Запрос №6</title>
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
        <div class="col-md-12">
            <p>Вычисляет для каждого договора размер страховой премии. Включает поля Дата заключения договора, Фамилия клиента, Имя клиента, Отчество клиента, Сумма страхования, Страховая премия. Сортировка по полю Дата заключения договора.</p>
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
                        ,Contracts.date as 'date'
                        ,Customers.surname_customers as 'surname'
                        ,Customers.name_customers as 'name'
                        ,Customers.patronymic_customers as 'patronymic'
                        ,Contracts.insurance_amount as 'summa'
                        ,Contracts.insurance_amount * (Insurance_type.rate - Customers.customer_discount) as 'prem'
                    from
                        Contracts join Customers on Contracts.id_customers = Customers.id
                                  join Insurance_type on Contracts.id_insurance_type = Insurance_type.id
                    order by Contracts.date;";

            $result = mysqli_query($link, $query) or die("Ошибка ".mysqli_error($link));

            if($result) {
                // $rows = mysqli_num_rows($result);     // количество полученных строк

                // Доступ к данным, прочитанным из таблицы, как к объекту
                // Свойства объекта - поля запроса
                echo "<table class='table table-striped'><tr><th>№</th><th>Дата</th><th>Фамилия</th><th>Имя</th><th>Отчество</th><th>Сумма страхования</th><th>Страховая премия</th></tr>";
                while($row = mysqli_fetch_object($result)) {
                    echo "<tr>";
                    echo "<td>".$row->id."</td>";
                    echo "<td>".$row->date."</td>";
                    echo "<td>".$row->surname."</td>";
                    echo "<td>".$row->name."</td>";
                    echo "<td>".$row->patronymic."</td>";
                    echo "<td>".$row->summa."</td>";
                    echo "<td>".$row->prem."</td>";
                    echo "</tr>";
                } // while
                echo "</table>";

                // очищаем результат после обработки запроса
                mysqli_free_result($result);
            } // if
            ?>
        </div>
    </div>
</div>




</body>
</html>