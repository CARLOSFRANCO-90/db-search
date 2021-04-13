<?php

//Condicion de busqueda
$where = '';
if (isset($_REQUEST['name'])) {
    $name = $_REQUEST['name'];
    if ($name != '') {
        $where = "AND c.nombre LIKE '%$name%'";
    }
}
if (isset($_REQUEST['entry'])) {
    $entry = $_REQUEST['entry'];
    if ($entry != '') {
        if ($where == "") {
            $where = " AND i.entrada = '$entry'";
        } else {
            $where = "$where AND i.entrada = '$entry'";
        }
    }
}
if (isset($_REQUEST['class'])) {
    $class = $_REQUEST['class'];
    if ($class != "") {
        if ($where == "") {
            $where = " AND v.clase_vehiculo = '$class'";
        } else {
            $where = "$where AND v.clase_vehiculo = '$class'";
        }
    }
}

//1. cocectar base datos
$host = "localhost";
$dbname = "franco_parqueadero";
$username = "root";
$contrasena = "";

$cnx = new PDO("mysql:host=$host;dbname=$dbname", $username, $contrasena);

//2. construir la sentiencia SQL
$sql = "SELECT c.nombre AS nombre, c.direccion AS direccion, i.entrada AS entrada, v.clase_vehiculo AS clase FROM cliente AS c JOIN ingresos AS i JOIN vehiculo AS v WHERE i.fk_cliente = c.id AND i.fk_vehiculo = v.id $where ORDER BY c.nombre";
//3.preparar SQL sentencias
$q = $cnx->prepare($sql);
//4. ejecutar SQL sentencia
$resultado = $q->execute();
$ingresos = $q->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso - Listado Ingreso</title>
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

    .item2 {
        margin: 10px 10px;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        font-size: 15px;
    }

    h1 a {
        text-decoration: none;
        color: black;
    }

    .form-container {
        margin: 10px;
        border: 1px solid black;
        padding: 20px;
        width: 500px;
    }

    .form-container2 {
        display: inline-flex;
        margin: 10px;
        margin-bottom: 20px;
    }

    th {
        letter-spacing: 2px;
    }

    td {
        letter-spacing: 1px;
    }

    .buton {
        font-size: 15px;
    }

    table {
        table-layout: fixed;
        width: 100%;
        border-collapse: collapse;
        border: 3px solid purple;
    }

    th,
    td {
        padding: 20px;
        text-align: center;
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
        <h2>Lista Ingresos</h2>

        <form action="full-ingreso.php" class="form-container2">
            <div class="item2">Nombre <input type="text" class="text" name="name"></div>
            <div class="item2">Entrada
                <select name="entry">
                    <option value="">Seleccionar</option>
                    <option value="2">Dia</option>
                    <option value="3">Noche</option>
                </select>
            </div>
            <div class="item2">Clase Vehiculo
                <select name="class">
                    <option value="">Seleccionar</option>
                    <option value="0">Moto</option>
                    <option value="1">Carro</option>
                </select>
            </div>
            <div class="item2"><input type="submit" value="Buscar" /></div>
        </form>

        <table>
            <tr>
                <th>Nombre Cliente</th>
                <th>Dirección</th>
                <th>Entrada</th>
                <th>Clase Vehiculo</th>
            </tr>

            <?php
            for ($i = 0; $i < count($ingresos); $i++) {
            ?>
                <tr>
                    <td><?php echo $ingresos[$i]["nombre"] ?></td>
                    <td><?php echo $ingresos[$i]["direccion"] ?></td>
                    <td>
                        <?php
                        $entrada = $ingresos[$i]["entrada"];
                        if ($entrada == "2") {
                            echo "Día";
                        } else {
                            echo "Noche";
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        $clase = $ingresos[$i]["clase"];
                        if ($clase == 0) {
                            echo "Moto";
                        } else {
                            echo "Carro";
                        }
                        ?>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</body>

</html>