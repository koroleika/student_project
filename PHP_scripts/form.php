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

<?php if(empty($_POST['submit']) && (empty($_POST['text']))):?>
    <?php
    $query = ("select login,user_name, user_surname from public.user");
    $result = pg_query($query);
    ?>
    <div class="container">
        <div class="centered">
            <?php
            if(isset($_POST['submit2'])) {
                foreach ($_POST['login_name'] as $select)
                {
                    $_SESSION['to_login'] = $select;
                    if ($_SESSION['to_login'] == 1){
                        $_SESSION['to_login'] = "Всем";
                    }
                }
                echo '<h2 class="textStyle">Отлично! Ты хочешь оставить послание '; echo $_SESSION['to_login']; echo '!<br> Теперь напиши его</h2>
                        <div class="centered8">
                            <form method="post">
                                <table>
                                    <tr>
                                        <td colspan="2" class="content">
                                            <input type="text" class="inputForm" name="text" placeholder="Введите текст">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td >
                                            <button type="submit" class="butt3" name="submit" value="submit">Отправить</button>
                                        </td>
                                        <td >
                                            <button type="reset" class="butt3">Очистить</button>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>';
            }
            else{
                echo '<h2 class="textStyle">Для начала выбери, кому ты хочешь оставить послание</h2>
                        <div class="centered6">
                            <form method="post">
                                <table>
                                    <tr>
                                        <td colspan="2" class="content">
                                            <input disabled type="text" class="inputForm" name="text" placeholder="Введите текст">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td >
                                            <button disabled type="submit" class="butt3" name="submit" value="submit">Отправить</button>
                                        </td>
                                        <td >
                                            <button disabled type="reset" class="butt3">Очистить</button>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>';
            }
            ?>
            <div class="centered7">
                <form  method="post">
                    <select name="login_name[]" >
                        <option value="1">Всем</option>
                        <?php
                        while($row = pg_fetch_assoc($result)){
                            if ($row['login']=="Всем"){}
                            elseif ($row['login']==$_SESSION["login"]){}
                            else{
                                echo '<option value="'. $row['login'] .'">'. $row['login'] .' - '. $row['user_name'] .'  '. $row['user_surname'].'</option>';
                            }
                        }
                        ?>
                    </select>
                    <input type="submit" name="submit2" value="Выбрать" class="butt5">
                </form>
            </div>
        </div>
    </div>
<?php else:
        $query1 = ("select id from public.user where login ='".$_SESSION["login"]."'");
        $result1 = pg_query($query1);
        $from_id = pg_fetch_row($result1);

        $query2 = ("select id from public.user where login ='".$_SESSION['to_login']."'");
        $result2 = pg_query($query2);
        $to_id = pg_fetch_row($result2);

        $query3 = ("insert into public.messages (message, from_name_id, to_name_id) VALUES ('".$_POST['text']."', '".$from_id[0]."', '".$to_id[0]."')");
        $result_query_insert = pg_query($query3);
        $postgre = pg_close();
?>
    <div class="container">
        <div class="centered">
            <h2 class="textStyle">Отлично!</h2>
            <p class="textStyle">Теперь взгляни, что написали твои предшественники</p>
            <form method="post">
                <button  type="button" class="butt4" onClick='location.href="/file.php"'>Смотреть</button>
            </form>
        </div>
    </div>
<?php endif; ?>
</body>
</html>