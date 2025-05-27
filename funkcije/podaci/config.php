<?php

$conn = new mysqli("db", "user", "password", "shoes_db");
if ($conn->connect_error)
    die('GRESKA: ' . $conn->connect_error);

?>
