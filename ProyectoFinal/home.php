<!DOCTYPE html>
<html>
<head>
	<title>Carrito </title>
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-md-12">
		<h1>Pasteleria Delicias Dorada</h1>
		<p></p>
		<br>
			<ul>
				<li><a href="./products.php">Productos</a></li>
				<li><a href="./cart.php">Carrito</a></li>
			</ul>
			<br><br><hr>
	
		</div>
	</div>
</div>

</body>
</html>


<?php if(empty($conexion))return;
?>
<section class="full-height bienvenido">
    <section class="container">
        <h1 class="text-center">Bienvenido <?php echo $_SESSION['usuario']['nombre'];?> </h1>
        <p class="text-center"><a href="salir.php" class="btn btn-secondary btn-lg">Salir</a></p>
    </section>
</section>

