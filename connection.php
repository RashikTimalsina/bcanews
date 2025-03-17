<?php

session_start();
$conn = new mysqli("localhost", "root", "", "bca_news");

if (!$conn) {
    die(" Database Connection failed");
}

function message()
{
    if (isset($_SESSION['success'])) {
        $output = "<div class='alert alert-success'>";
        $output .= htmlentities($_SESSION['success']);
        $output .= "</div>";
        $_SESSION['success'] = null;
        return $output;
    }
    if (isset($_SESSION['error'])) {
        $output = "<div class='alert alert-error'>";
        $output .= htmlentities($_SESSION['error']);
        $output .= "</div>";
        $_SESSION['error'] = null;
        return $output;
    }
    return ''; // Return an empty string if no message is set
}
