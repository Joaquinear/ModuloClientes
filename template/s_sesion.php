<?php 
session_name( 'sgc2' );
@session_start();
if(!isset($_SESSION['usuario'])) {
    header('Location: ../contenido/login.php?ss=nn');
}
error_reporting(E_ERROR);
ini_set('display_errors', 1);
?>