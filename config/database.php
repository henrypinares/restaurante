<?php
require_once __DIR__ . '/../vendor/autoload.php';
$mongoClient = new MongoDB\Client("mongodb+srv://henry:DgLo4kUdRDMXksyl@cluster0.viorv.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0");
$database = $mongoClient->selectDatabase('escuela');
$tasksCollection = $database->tareas;
?>
