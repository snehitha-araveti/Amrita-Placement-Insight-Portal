<?php
include 'db.php';

$type = $_GET['type'];
$id = $_GET['id'];

if ($type == 'student') {
    $stmt = $pdo->prepare("DELETE FROM students WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: roster.php?notif=Student Removed");
} 
else if ($type == 'company') {
    // Note: analytics_results will be deleted automatically because of our SQL FOREIGN KEY CASCADE
    $stmt = $pdo->prepare("DELETE FROM companies WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: drives.php?notif=Drive Removed");
}
exit();
?>