<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "football";
//создаем соединение
$connect = new mysqli($servername, $username, $password, $dbname);
$connect->set_charset("utf8");