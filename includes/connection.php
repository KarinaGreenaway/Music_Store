
<?php
$username = "s5418936";
$password = "YmvRC9JpYfj9MHtvVWM4EhKY7uXMi3Hk";
$host = "db.bucomputing.uk";
$port = 6612;
$database = $username;

$connection = mysqli_init();
if (!$connection) {
    echo "<p>Initalising MySQLi failed</p>";
} else {
    mysqli_ssl_set($connection, NULL, NULL, NULL, '/public_html/sys_tests', NULL);

    // Connect the MySQL connection
    mysqli_real_connect($connection, $host, $username, $password, $database, $port, NULL, MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT);
    if (mysqli_connect_errno()) {
        echo "<p>Failed to connect to MySQL. " .
            "Error (" . mysqli_connect_errno() . "): " . mysqli_connect_error() . "</p>";
    }
    //else {
    //    echo "<p>Connected to server: " . mysqli_get_host_info($connection) . "</p>";

    //}
}

