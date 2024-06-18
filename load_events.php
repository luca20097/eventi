<?php
require 'db.php';

$sql = "SELECT id, title, start, end FROM events";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($events);
?>
