<?php session_start();
$conexion=mysqli_connect('localhost','root','','pasteleria')or die('Error al seleccionar la base de datos');
// Funcion para registrar 
function registrar(){
    global $conexion;
    
    $usuario=escapar($_POST['usuario']); 
    $acceso=password_hash($_POST['acceso'],PASSWORD_DEFAULT); 
    if($conexion->query('insert into usuarios(username,acceso) values
    ("'.$usuario.'","'.$acceso.'")')){
        $_SESSION['alert']=array('successs','Te has registrado con exito'); 
}else{
    $_SESSION['alert']=array('danger','Ha ocurrido un error al registrar'); 
    }
}
 //Funcion para iniciar sesion 
function iniciar_sesion(){
    global $conexion;
    
    $usuario=escapar($_POST['usuario']); 
    $acceso=$_POST['acceso']; 
    $query=$conexion->query('select * from usuarios where username="'.$usuario.'"'); 
    if($query->num_rows>0){
        //validar datos de acceso 
        $datos=$query->fetch_assoc();
        if(password_verify($acceso,$datos['acceso'])){
            $_SESSION['usuario']=array('id'=>$datos['id'],'nombre'=>$datos['username']); 
        }else{
            $_SESSION['alert']=array('warning','La contraseña ingresada es incorrecta'); 

        }
    }else{
        $_SESSION['alert']=array('warning','El nombre de usuario es incorrecto'); 
    }

}

function get_header($title){
    echo '
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="style.css">

        <title>'.$title.'</title>
    </head>
    <body>';
    if(isset($_SESSION['alert'])){
        echo '
        <div class="alert alert-'.$_SESSION['alert'][0].' animated fadeInLeft alert-dismissible fade show alerta" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            '.$_SESSION['alert'][1].'
        </div>';
        unset($_SESSION['alert']);
    }
}
function get_footer(){
    echo '
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="js/jquery-3.2.1.slim.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>';
}
function escapar($entrada){
    global $conexion;
    return mysqli_real_escape_string($conexion,$entrada);
}