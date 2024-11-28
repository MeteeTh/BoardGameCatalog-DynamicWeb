<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_boardgame_connect = "localhost";
$database_boardgame_connect = "boardgame";
$username_boardgame_connect = "root";
$password_boardgame_connect = "12345678";
$boardgame_connect = mysql_pconnect($hostname_boardgame_connect, $username_boardgame_connect, $password_boardgame_connect) or trigger_error(mysql_error(),E_USER_ERROR); 
?>