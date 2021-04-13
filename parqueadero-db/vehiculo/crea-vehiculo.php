<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehiculo</title>

</head>

<style>
    header {
        align-content: space-between;
        margin-bottom: 20px;
    }

    .item {
        margin: 0 5px;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        font-size: 20px;
    }

    h1 a {
        text-decoration: none;
        color: black;
    }

    .form-container {
        margin: 10px;
        border: 1px solid black;
        padding: 20px;
        width: 400px;
    }

    .buton {
        font-size: 15px;
    }
</style>

<body>
    <header>
        <h1>
            <a href="../index.html">Sistema de parquadero</a>
        </h1>
        <nav>
            <a href="../cliente/crea-cliente.php" class="item">Crear Cliente</a>
            <a href="./crea-vehiculo.php" class="item">Crear Vehiculo</a>
            <a href="../ingresos/crea-ingresos.php" class="item">Crear Ingreso</a>
            <a href="../ingresos/full-ingreso.php" class="item">Ver Ingresos</a>
        </nav>
    </header>
    <div class="form-container">
        <h2>Formulario de ingreso nuevo vehiculo</h2>
        <form action="crea-vehiculo.php" method="POST">
            <label for="nombre">Ingrese Datos</label>
            <br /> <br />
            <input type="radio" name="clase_vehiculo" value="0" />Moto
            <input type="radio" name="clase_vehiculo" value="1" />Carro
            <br /> <br />

            <input type="radio" name="pago" value="2" />Dia
            <input type="radio" name="pago" value="3" />Mes
            <br /> <br />
            <input type="submit" value="Guardar">
        </form>
    </div>
</body>

</html>

<?php

$clase_vehiculo = $_REQUEST["clase_vehiculo"];
$pago = $_REQUEST["pago"];

//1. cocectar base datos
$host = "localhost";
$dbname = "franco_parqueadero";
$username = "root";
$contrasena = "";

$cnx = new PDO("mysql:host=$host;dbname=$dbname", $username, $contrasena);

//2. construir la sentiencia SQL
$sql = "INSERT INTO vehiculo (clase_vehiculo, pago) VALUES('$clase_vehiculo', '$pago')";

//3.preparar SQL sentencias
$q = $cnx->prepare($sql);

//4. ejecutar SQL sentencia
$resultado = $q->execute();

if ($resultado) {
    echo "Vehiculo se guardo bien";
} else {
    echo "hubo un error en la creacion del vehiculo";
}
?>