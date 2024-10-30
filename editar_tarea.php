<?php
require_once __DIR__ . '/includes/functions.php';
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}
$tarea = obtenerTareaPorId($_GET['id']);

if (!$tarea) {
    header("Location: index.php?mensaje=venta no encontrado");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $count = actualizarTarea($_GET['id'], $_POST['comida'], $_POST['cantidad'], $_POST['precio'], isset($_POST['venta']));
    if ($count > 0) {
        header("Location: index.php?mensaje=Venta actualizada con éxito");
        exit;
    } else {
        $error = "No se pudo actualizar la venta.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Venta</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Editar Venta</h1>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST">
    <label>Comida: <input type="text" name="comida" value="<?php echo htmlspecialchars($tarea['comida']); ?>" required></label>
    <label>Cantidad: <textarea name="cantidad" required><?php echo htmlspecialchars($tarea['cantidad']); ?></textarea></label>
    <label>Precio: <textarea name="precio" required><?php echo htmlspecialchars($tarea['precio']); ?></textarea></label>
    <label>Venta: <input type="checkbox" name="venta" <?php echo $tarea['venta'] ? 'checked' : ''; ?>></label>
    <input type="submit" value="Actualizar Venta">
</form>
<a href="index.php" class="button">Volver a la lista de Ventas</a>
</div>
</body>
</html>
