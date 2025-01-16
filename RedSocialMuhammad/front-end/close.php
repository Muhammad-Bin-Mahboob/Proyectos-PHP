<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/session.inc.php');
session_destroy();
header('Location: /front-end/index.php');