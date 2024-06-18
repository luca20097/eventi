<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $start = $_POST['start'];
    $end = $_POST['end'];

    $sql = "UPDATE events SET title = :title, start = :start, end = :end WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute(['title' => $title, 'start' => $start, 'end' => $end, 'id' => $id])) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>
