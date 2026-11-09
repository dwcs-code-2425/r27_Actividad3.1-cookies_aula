<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visits counter</title>
</head>

<body>
    <h1>Visits counter</h1>

    <?php
    if (isset($_POST["eliminar"])) {
        setcookie("visitas", "", time() - 1);
        header('Location: visitas.php');
        exit;
    } else if (isset($_COOKIE["visitas"])) {

        $visitas = $_COOKIE["visitas"];
        setcookie("visitas", ++$visitas, time() + 3600);
        //El nuevo valor no estará disponible en $_COOKIE hasta la próxima petición HTTP 
        //Por ese motivo no podemos usar $_COOKIE["visitas] para mostrar su valor
    ?>
        <form action="" method="post">
            <input type="submit" value="Eliminar cookie" name="eliminar" />
        </form>



        <p>Nos ha visitado <?= $visitas ?> veces</p>
    <?php  } else {
        setcookie("visitas", 1, time() + 3600);
    ?>
        <p>Bienvenido</p>
    <?php
    }


    ?>



</body>

</html>