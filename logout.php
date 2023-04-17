<?php
    session_start();
    unset($_SESSION["l_id"]);
    unset($_SESSION['service_count']);
    header("location: index.php");
?>
