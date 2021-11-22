<?php
// if(!isset($_SESSION['ADMIN'])){
//     header('Location: login.php');
// }else{
    session_start();
    unset($_SESSION['ADMIN']);
    header("Location: login.php");
// }

?>