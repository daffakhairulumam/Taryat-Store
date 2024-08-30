<?php

function connection()
{
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'taryat_store';

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Connection Failed: " . mysqli_connect_error());
    }
    return $conn;
}
