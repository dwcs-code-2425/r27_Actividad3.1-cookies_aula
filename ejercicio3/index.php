<?php

require_once 'catalogo.php';


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Tienda de informática</title>
</head>

<body>

    <h1>Catálogo de productos</h1>

    <ul>
        <?php foreach ($productos as $id => $producto): ?>
            <li>
                <a href="producto.php?id=<?= $id ?>">
                    <?= htmlspecialchars($producto['nombre']) ?>
                </a>
                - <?= number_format($producto['precio'], 2, ',', '.') ?> €
            </li>
        <?php endforeach; ?>
    </ul>

    <h2>Productos visitados recientemente</h2>
    <?php
    if (isset($_POST["eliminar"])) {
        setcookie("historial", "", time() - 1);
    } else {
        if (isset($_COOKIE["historial"])) {
            // print_r($_COOKIE["historial"]);
            $array = explode(",", $_COOKIE["historial"]);
    ?>
            <ul>
                <?php
                foreach ($array as $id) { ?>
                    <li>
                        <a href="producto.php?id=<?= $id ?>">
                            <?= htmlspecialchars($productos[$id]['nombre']) ?>
                        </a>
                        - <?= number_format($productos[$id]['precio'], 2, ',', '.') ?> €
                    </li>
                <?php } ?>
            </ul>
    <?php }
    }
    ?>

    <!-- COMPLETAR: eliminar si viene por POST y mostrar los productos del historial -->


    <form method="post" action="index.php">
        <button type="submit" name="eliminar">
            Eliminar historial
        </button>
    </form>

</body>

</html>