<?php

// Idiomas disponibles
$idiomas = [
    'gl' => 'Galego',
    'es' => 'Castellano'
];

// Contenidos de la página
$contenidos = [
    'gl' => [
        'titulo' => 'Benvida á nosa tenda',
        'descricion' => 'Nesta tenda atoparás unha selección de produtos de informática e tecnoloxía.',
        'mensaxe' => 'A túa experiencia, no teu idioma.',
        'seleccion' => 'Seleccionar idioma',
        'boton' => 'Gardar preferencia',
        'eliminar' => 'Eliminar preferencia'
    ],
    'es' => [
        'titulo' => 'Bienvenido a nuestra tienda',
        'descricion' => 'En esta tienda encontrarás una selección de productos de informática y tecnología.',
        'mensaxe' => 'Tu experiencia, en tu idioma.',
        'seleccion' => 'Seleccionar idioma',
        'boton' => 'Guardar preferencia',
        'eliminar' => 'Eliminar preferencia'
    ]
];


$idioma = 'gl'; //Por defecto, galego. Debería extraerse da cookie se existe

if (isset($_POST["eliminar"])) {
    setcookie("idioma", "", time() - 1);
} else {

    if (isset($_POST["idioma"])) {
        $idioma = $_POST["idioma"];


        // Comprobar que el valor de la cookie es válido
        if (!array_key_exists($idioma, $idiomas)) {
            $idioma = 'gl';
        }

        setcookie("idioma", $idioma, time() + 60 * 60 * 24 * 30);
        header('Location: index.php');
        exit;
    }
    if (isset($_COOKIE["idioma"])) {
        if (!array_key_exists($_COOKIE["idioma"], $idiomas)) {
            $idioma = 'gl';
            //eliminamos la cookie 
            setcookie("idioma", "", time()  - 1);
        } else {
            $idioma = $_COOKIE["idioma"];
        }
    }
}


//Seleccionamos o subarray correspondente ao idioma seleccionado
$texto = $contenidos[$idioma];

?>

<!DOCTYPE html>
<html lang="<?= $idioma === 'gl' ? 'gl' : 'es' ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($texto['titulo']) ?></title>
</head>

<body>

    <h1><?= htmlspecialchars($texto['titulo']) ?></h1>

    <p><?= htmlspecialchars($texto['descricion']) ?></p>

    <p><?= htmlspecialchars($texto['mensaxe']) ?></p>

    <hr>

    <h2><?= htmlspecialchars($texto['seleccion']) ?></h2>

    <form method="post" action="index.php">

        <select name="idioma">
            <?php foreach ($idiomas as $codigo => $nome): ?>
                <option value="<?= $codigo ?>"
                    <?= $idioma === $codigo ? 'selected' : '' ?>>
                    <?= htmlspecialchars($nome) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">
            <?= htmlspecialchars($texto['boton']) ?>
        </button>

    </form>

    <form method="post" action="index.php" style="margin-top: 10px;">
        <button type="submit" name="eliminar">
            <?= htmlspecialchars($texto['eliminar']) ?>
        </button>
    </form>

</body>

</html>