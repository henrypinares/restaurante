<?php
require_once __DIR__ . '/../config/database.php';
function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}
function formatDate($date) {
    return $date->toDateTime()->format('Y-m-d');
}
function crearTarea($comida, $cantidad, $precio) {
    global $tasksCollection;
    $resultado = $tasksCollection->insertOne([
        'comida' => sanitizeInput($comida),
        'cantidad' => sanitizeInput($cantidad),
        'precio' => sanitizeInput($precio),
        'venta' => false
    ]);
    return $resultado->getInsertedId();
}
function obtenerTareas() {
    global $tasksCollection;
    return $tasksCollection->find();
}
function obtenerTareaPorId($id) {
    global $tasksCollection;
    return $tasksCollection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
}
function actualizarTarea($id, $comida, $cantidad, $precio, $venta) {
    global $tasksCollection;
    $resultado = $tasksCollection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectId($id)],
        ['$set' => [
            'comida' => sanitizeInput($comida),
            'cantidad' => sanitizeInput($cantidad),
            'precio' => sanitizeInput($precio),
            'venta' => $venta
        ]]
    );
    return $resultado->getModifiedCount();
}
function eliminarTarea($id) {
    global $tasksCollection;

    try {
        $objectId = new MongoDB\BSON\ObjectId($id);
    } catch (Exception $e) {
        return 0;
    }
    $resultado = $tasksCollection->deleteOne(['_id' => $objectId]);
    return $resultado->getDeletedCount();
}




?>