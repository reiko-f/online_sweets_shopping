<?php
    session_start();
    session_unset();
    session_destroy();

    header("location: ../final_index.php");
    exit();
?>