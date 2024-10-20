<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Pagina Principal</h1>

    <p>Nombre de la Página: <?= $data['pagina_titulo'] ?></p>

    <p>
        <?php
          Formato($data);
        ?>
    </p>
</body>
</html>