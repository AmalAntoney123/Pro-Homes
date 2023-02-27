<?php
try {
    // Attempt to connect to the database
    $con = mysqli_connect("localhost", "root", "", "DB_ProHomes");

    // Check if connection was successful
    if (!$con) {
        // Redirect to the 404 page
        header('Location: 404.html');
        exit;
    }
} catch (mysqli_sql_exception $e) {
    // Redirect to the 404 page
    header('Location: 404.html');
    exit;
}