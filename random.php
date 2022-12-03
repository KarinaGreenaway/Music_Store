<?php
$pwd="Wa!tPlease";
$r=password_hash($pwd, PASSWORD_DEFAULT);
echo "<p>$r</p>";