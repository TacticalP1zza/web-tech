<?php
/*Logs the user out*/
function logout(){
    session_start();
    session_unset();
    session_destroy();
    header("location:../index.php");
}
logout();
?>