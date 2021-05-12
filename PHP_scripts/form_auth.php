
<!-- Блок для вывода сообщений -->
<div class="block_for_messages">
    <?php
 
        if(isset($_SESSION["error_messages"]) && !empty($_SESSION["error_messages"])){
            echo $_SESSION["error_messages"];
 
            //Уничтожаем чтобы не появилось заново при обновлении страницы
            unset($_SESSION["error_messages"]);
        }
 
        if(isset($_SESSION["success_messages"]) && !empty($_SESSION["success_messages"])){
            echo $_SESSION["success_messages"];
             
            //Уничтожаем чтобы не появилось заново при обновлении страницы
            unset($_SESSION["success_messages"]);
        }
    ?>
</div>
 
<?php
    //Проверяем, если пользователь не авторизован, то выводим форму авторизации, 
    //иначе выводим сообщение о том, что он уже авторизован
    if(!isset($_SESSION["login"]) && !isset($_SESSION["password"])){
?>
<meta name="viewport" content="width=device-width">
<div class="conteiner">
    <div id="form_auth" class="centered">
        <h2 class="textStyle">Форма авторизации</h2>
        <form action="auth.php" method="post" name="form_auth">
            <table>
                <tbody>
                    <tr>
                        <td class="textStyle2"> Логин </td>
                        <td class="content">
                            <input type="login" name="login" placeholder="Введите логин" required="required">
                            <object class="content_circle"></object>
                            <span id="valid_login_message" class="mesage_error"></span>
                        </td>
                    </tr>  
                    <tr>
                        <td class="textStyle2"> Пароль </td>
                        <td class="content">
                            <input type="password" name="password" placeholder="Введите пароль" required="required">
                            <object class="content_circle"></object>
                            <span id="valid_password_message" class="mesage_error"></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="submit" name="btn_submit_auth" class="butt2" value="Войти">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>
<?php
    }else{
?>
    <div id="authorized" class="centered">
        <h2>Вы уже авторизованы</h2>
    </div>
<?php
    }
?>
 
<?php
    //Подключение подвала
    require_once("footer.php");
?>