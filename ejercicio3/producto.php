<?php

require_once 'catalogo.php';

// Obtener el identificador del producto solicitado
$id = $_GET['id'] ?? 0;

// Comprobar que el producto existe
if (!array_key_exists($id, $productos)) {
    die('Producto no encontrado');
}


$producto = $productos[$id];

//COMPLETAR: almacenar el producto en el historial de productos visitados

if (isset($_COOKIE["historial"])) {
    $cadena = $_COOKIE["historial"];
    $array = explode(",", $cadena);

    $pos = array_search($id, $array);
    if ($pos !== false) {
        unset($array[$pos]);
    }
    //array_push($array, $id);
    $array[] = $id;

    $cadena = implode(",", $array);

    setcookie("historial", $cadena, time() + 60 * 60 * 24 * 30);
} else {
    setcookie("historial", $id, time() + 60 * 60 * 24 * 30);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($producto['nombre']) ?></title>
</head>

<body>

    <h1><?= htmlspecialchars($producto['nombre']) ?></h1>

    <p><?= htmlspecialchars($producto['descripcion']) ?></p>

    <p>
        Precio: <?= number_format($producto['precio'], 2, ',', '.') ?> €
    </p>

    <p>
        <a href="index.php">Volver al catálogo</a>
    </p>

</body>

</html>