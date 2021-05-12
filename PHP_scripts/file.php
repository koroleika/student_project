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

<form class="centered">
    <p class='textStyle'>
        <?php
            $query1 = ("select id from public.user where login ='".$_SESSION["login"]."'");
            $result1 = pg_query($query1);
            $to_id = pg_fetch_row($result1);

            $query2 = ("select user_name as un, message as msg from public.messages as pmsg left join public.user as pus on pmsg.from_name_id = pus.id where pmsg.to_name_id = '".$to_id[0]."'");
            $result2 = pg_query($query2);

            while($row = pg_fetch_assoc($result2)){
                echo "Пользователь, которого зовут ";
                echo $row['un'];
                echo ", написал тебе: ";
                echo $row['msg'];
                echo "<br>";
            }

            $query3 = ("select user_name as un, message as msg from public.messages as pmsg left join public.user as pus on pmsg.from_name_id = pus.id where pmsg.to_name_id = 29");
            $result3 = pg_query($query3);

            while($row2 = pg_fetch_assoc($result3)){
                echo "Пользователь, которого зовут ";
                echo $row2['un'];
                echo ", написал всем: ";
                echo $row2['msg'];
                echo "<br>";
            }
            $postgre = pg_close();
        ?>
    </p>
</form>
</body>
</html>
