<?php
    require_once __DIR__ .'/includes/functions.php';

    if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $resultado = eliminarTarea($id);
        
        if ($resultado > 0) {
            $mensaje = "Venta eliminada exitosamente.";
        } else {
            $mensaje = "Error al eliminar la Venta.";
        }
        header('Location: index.php');
        exit;
    }
    $tareas = obtenerTareas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ventas</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
    <div class="container">
        <h1>RESTAURANTE EL BUEN SABOR</h1>

        <?php if (isset($mensaje)): ?>
            <div class="<?php echo $count > 0 ? 'success' : 'error'; ?>">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>

        <a href="agregar_tarea.php" class="button">AGREGAR VENTA</a>

        <h2>Lista de ventas de hoy</h2>
        <table>
            <tr>
                <th>COMIDA</th>
                <th>CANTIDAD EN PLATOS</th>
                <th>PRECIO</th>
                <th>Venta</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($tareas as $tarea): ?>
            <tr>
                <td><?php echo htmlspecialchars($tarea['comida']); ?></td>
                <td><?php echo htmlspecialchars($tarea['cantidad']); ?></td>
                <td><?php echo htmlspecialchars($tarea['precio']); ?></td>
                <td><?php echo $tarea['venta'] ? 'Sí' : 'No'; ?></td>
                <td class="actions">
                    <a href="editar_tarea.php?id=<?php echo $tarea['_id']; ?>" class="button">Editar</a>
                    <a href="index.php?accion=eliminar&id=<?php echo $tarea['_id']; ?>" class="button" onclick="return confirm('¿Estás seguro de que quieres eliminar esta venta?');">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
