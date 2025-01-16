<?php
header('Content-Type: application/json');

if (isset($_GET['key']) && $_GET['key'] === 'secretKey') {
    echo json_encode(['flag' => 'Q1RGe1RoYW5rWW91Rm9yRmluZGluZ01lfQ==']);
} else {
    echo json_encode(['error' => 'Invalid key']);
}
?>
