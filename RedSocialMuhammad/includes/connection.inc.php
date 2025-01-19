<?php
$dsn = 'mysql:host=localhost;port=3307;dbname=social';
$user = 'social';
$pass = 'laicos';
$charset = 'utf8mb4';

$options = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"];