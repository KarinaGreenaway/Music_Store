<?php

require_once 'connection.php';
require_once 'functions.inc.php';


getProductTable($connection);
mysqli_close($connection);

