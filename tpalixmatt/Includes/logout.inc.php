<?php

if (isset($_POST['submit']))
{
    session_start();
    session_unset();
    session_destroy();
    header("Location: ../View/login.php?login=logout");
    exit();
}