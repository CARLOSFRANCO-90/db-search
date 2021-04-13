<?php
//1. cocectar base datos
$host = "localhost";
$dbname = "franco_parqueadero";
$username = "root";
$contrasena = "";

$cnx = new PDO("mysql:host=$host;dbname=$dbname", $username, $contrasena);

//2. construir la sentiencia SQL
$sql = "SELECT id, nombre FROM cliente";
//3.preparar SQL sentencias
$q = $cnx->prepare($sql);
//4. ejecutar SQL sentencia
$resultado = $q->execute();
$cliente = $q->fetchAll();

//2. construir la sentiencia SQL
$sql = "SELECT clase_vehiculo, pago FROM vehiculo";
//3.preparar SQL sentencias
$q = $cnx->prepare($sql);
//4. ejecutar SQL sentencia
$resultado = $q->execute();
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso - Crear Ingreso</title>
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
            <a href="../vehiculo/crea-vehiculo.php" class="item">Crear Vehiculo</a>
            <a href="./crea-ingresos.php" class="item">Crear Ingreso</a>
            <a href="full-ingreso.php" class="item">Ver Ingresos</a>
        </nav>
    </header>
    <div class="form-container">
        <h2>Formulario de nuevo ingreso</h2>
        <form action="crea-ingresos.php" method="POST">
            Clientes
            <select name="fk_cliente" id="fk_cliente">
                <?php
                for ($i = 0; $i < count($cliente); $i++) {
                ?>
                    <option value="<?php echo intval($cliente[$i]["id"]) ?>">
                        <?php echo $cliente[$i]["nombre"] ?>
                    </option>
                <?php
                }
                ?>

            </select>
            <br /><br />
            <br />
            Vehiculo
            <select name="fk_vehiculo" id="">
                <option value="3">Moto</option>
                <option value="1">Carro</option>
                <br /> <br />
            </select>
            <p>Entrada</p>
            <input type="radio" name="entrada" value="2" />Dia
            <input type="radio" name="entrada" value="3" />Noche
            <br /><br />
            <input type="submit" value="Registrar Ingreso" class="buton">
            <br /><br />
        </form>
    </div>
</body>

</html>

<?php
$cliente = $_REQUEST["fk_cliente"];
$vehiculo = $_REQUEST["fk_vehiculo"];
$ingresos = $_REQUEST["entrada"];

//1. cocectar base datos
$host = "localhost";
$dbname = "franco_parqueadero";
$username = "root";
$contrasena = "";

$cnx = new PDO("mysql:host=$host;dbname=$dbname", $username, $contrasena);

//2. construir la sentiencia SQL
$sql = "INSERT INTO ingresos (fk_cliente, fk_vehiculo, entrada) VALUES('$cliente', '$vehiculo', '$ingresos')";
//3.preparar SQL sentencias
$q = $cnx->prepare($sql);
//4. ejecutar SQL sentencia
$result = $q->execute();

if ($result) {
    echo "Ingreso se guardo bien";
} else {
    echo "hubo un error en el ingreso";
}
?>