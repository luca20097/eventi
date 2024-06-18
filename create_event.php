<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $start = $_POST['start'];
    $end = $_POST['end'];

    $sql = "INSERT INTO events (title, start, end) VALUES (:title, :start, :end)";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute(['title' => $title, 'start' => $start, 'end' => $end])) {
        echo json_encode(['success' => true, 'id' => $pdo->lastInsertId()]);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>
