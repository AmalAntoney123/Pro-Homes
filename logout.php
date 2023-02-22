<?php
    session_start();
    unset($_SESSION["l_id"]);
    header("location: index.php");
?>
