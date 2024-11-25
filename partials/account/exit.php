<?php
    session_start(); 
    $_SESSION = array(); 
    session_destroy();
    echo json_encode(array('status' => 'success'));
    echo '<a href="/partials/forms/login.php">';
    echo '<img src="/img/avatar.png" alt="avatar">';
    echo '</a>';
?>
