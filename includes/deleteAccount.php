<?php
session_start();

$id = $_SESSION['users_id'];


require_once 'connection.php';
require_once 'functions.inc.php';


require_once 'connection.php';
require_once 'functions.inc.php';

deleteAccount($connection, $id);
mysqli_close($connection);

