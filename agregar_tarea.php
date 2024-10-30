<?php
require_once __DIR__ . '/includes/functions.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = crearTarea($_POST['comida'], $_POST['cantidad'], $_POST['precio']);
    if ($id) {
        header("Location: index.php?mensaje=Venta creada con éxito");
        exit;
    } else {
        $error = "No se pudo crear la Venta.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nueva Venta</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Agregar Nueva Venta</h1>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST">
    <label>comida: <input type="text" name="comida" required></label>
    <label>cantidad: <textarea name="cantidad" required></textarea></label>
    <label>precio: <textarea name="precio" required></textarea></label>
    
    <input type="submit" value="Crear Venta">
</form>
<a href="index.php" class="button">Volver a la lista de Ventas</a>
</div>
</body>
</html>
