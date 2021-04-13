<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente</title>
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
            <a href="./crea-cliente.php" class="item">Crear Cliente</a>
            <a href="../vehiculo/crea-vehiculo.php" class="item">Crear Vehiculo</a>
            <a href="../ingresos/crea-ingresos.php" class="item">Crear Ingreso</a>
            <a href="../ingresos/full-ingreso.php" class="item">Ver Ingresos</a>
        </nav>
    </header>
    <div class="form-container">
        <h2>Formulario de ingreso nuevo cliente</h2>
        <form action="crea-cliente.php" method="post">
            Nombre <input type="text" name="nombre">
            <br /><br />
            Dirección <input type="text" name="direccion">
            <br /><br />
            Teléfono <input type="text" name="telefono">
            <br /><br />
            <input class="buton" type="submit" value="Crear Cliente">
        </form>
    </div>
</body>

</html>


<?php
$nombre = $_REQUEST["nombre"];
$direccion = $_REQUEST["direccion"];
$telefono = $_REQUEST["telefono"];

//1. cocectar base datos
$host = "localhost";
$dbname = "franco_parqueadero";
$username = "root";
$contrasena = "";

$cnx = new PDO("mysql:host=$host;dbname=$dbname", $username, $contrasena);

//2. construir la sentiencia SQL
$sql = "INSERT INTO cliente (nombre, direccion, telefono) VALUES('$nombre', '$direccion', '$telefono')";

//3.preparar SQL sentencias
$q = $cnx->prepare($sql);

//4. ejecutar SQL sentencia
$resultado = $q->execute();

if ($resultado) {
    echo "Cliente $nombre se guardo bien";
} else
    echo "hubo un error en la creacion del cliente $nombre";
?>