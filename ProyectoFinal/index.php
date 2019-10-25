<?php include 'funciones.php'; 
if(empty($_SESSION['usuario'])){
    get_header('Inicia sesion'); 
    include 'login.php'; 
}else{
    include 'home.php'; 
}
get_footer(); 
