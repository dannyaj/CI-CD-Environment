<?php

require 'DB_Config.php';

$dsn = $dbtype . ':dbname='  .$dbname . ';host=' . $host;

//echo $dsn;
//echo '<br>';

//echo $dbuser;
//echo '<br>';
//echo $dbuserpw;
//echo '<br><br>';

try
{
    $connection = new PDO($dsn, $dbuser, $dbuserpw);
}
catch (PDOException $e)
{
    echo 'There was a problem connecting to the database: ' . $e->getMessage();
}
?>
