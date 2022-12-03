<?php

    require_once 'connection.php';
    require_once 'functions.inc.php';


    getProducts($connection);
    mysqli_close($connection);



