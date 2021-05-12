<?php
    session_start();
    require_once("dbconnect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ну привет</title>
    <meta charset="utf-8">
    <link href="style.css" rel="stylesheet"  type="text/css"/>
</head>
<body>
    <div id="auth_block" >
        <?php
        //Проверяем авторизован ли пользователь
        if(!isset($_SESSION['login']) && !isset($_SESSION['password'])){
            // если нет, то выводим блок с ссылками на страницу регистрации и авторизации
            ?>

            <div class="container">
                <div class="centered">
                    <h2 class="textStyle">Привет, друг! </h2>
                    <h4 class="textStyle2">Если у тебя уже есть аккаунт, нажми на кнопку аутентификации</h4>
                    <h4 class="textStyle2"> Если нет, то нажми на кнопку регистрации</h4>
                    <table class="centered_block">
                        <tr>
                            <td>
                                <div id="link_register">
                                    <a href="/form_register.php" class="butt">Регистрация</a>
                                </div>
                            </td>
                            <td>
                                <div id="link_auth">
                                    <a href="/form_auth.php" class="butt">Аутентификация</a>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <?php
        }else{
            //Если пользователь авторизован, то выводим ссылку Выход
            $query = ("select user_name from public.user where login ='".$_SESSION["login"]."'");
            $result = pg_query($query);
            $name = pg_fetch_row($result);
            ?>
            <div id="link_logout" class="centered9">
                <a href="/logout.php" class="butt">Выход</a>
            </div>

        <div class="container">
                <div class="centered">
                    <form method="post">
                        <h2 class="textStyle">Привет, <?php echo $name[0]?>!</h2>
                        <p class="textStyle">Оставь послание будущим посетителям сайта</p>
                        <button type="button" class="butt4" onClick='location.href="/form.php"'>Передай привет</button>
                    </form>
                </div>
            </div>


            <?php
        }
        $postgre = pg_close();
        ?>
    </div>






<!---->
<!---->
<!---->
<!---->
<!---->
<?php //if (empty($_POST['submit']) && (empty($_POST['name']) || empty($_POST['surname']))): ?>
<!--    <div class="container">-->
<!--        <div class="centered">-->
<!--            <form method="post">-->
<!--                <h2 class="textStyle">Привет! Как тебя зовут?</h2>-->
<!--                <table>-->
<!--                    <tr>-->
<!--                        <td class="textStyle2">Имя</td>-->
<!--                        <td class="content">-->
<!--                            <input type="text" name="name" placeholder="Введите имя">-->
<!--                        </td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td class="textStyle2">Фамилия</td>-->
<!--                        <td class="content">-->
<!--                            <input type="text" name="surname" placeholder="Введите фамилию">-->
<!--                        </td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td>-->
<!--                            <button type="submit" class="butt3" name="submit">Отправить</button>-->
<!--                        </td>-->
<!--                        <td>-->
<!--                            <button type="reset" class="butt3">Очистить</button>-->
<!--                        </td>-->
<!--                    </tr>-->
<!--                </table>-->
<!--            </form>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<?php ////else :
//        $file = ('HelloString.txt');
//        $file = fopen($file, "a");
//        $name = $_POST['name'];
//        $surname = $_POST['surname'];
//        $query = "insert into public.user (user_name, user_surname) values ('$_POST[name]', '$_POST[surname]')";
//        $result = pg_query($query);
//?>
<!--    <div class="container">-->
<!--        <div class="centered">-->
<!--            <form method="post">-->
<!--                <h2 class="textStyle">Привет, --><?php //echo $name?><!--!</h2>-->
<!--                <p class="textStyle">Оставь послание будущим посетителям сайта</p>-->
<!--                <button type="button" class="butt4" onClick='location.href="/form.php"'>Передай привет</button>-->
<!--            </form>-->
<!--        </div>-->
<!--    </div>-->
<?php //endif; ?>

</body>
</html>