<?php

require_once 'connection.php';
require_once 'functions.inc.php';

$search = $_POST['search'];

getResults($connection, $search);
mysqli_close($connection);
