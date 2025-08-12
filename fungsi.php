<?php
function is_login($level) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['login']) || $_SESSION['level'] != $level) {
        header("Location: login.php");
        exit;
    }
}
