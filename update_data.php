<?php
include 'db.php';

// Check if data was sent via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type = $_POST['type'];
    $id = $_POST['id'];

    if ($type == 'student') {
        $name = trim($_POST['name']);
        $cgpa = floatval($_POST['cgpa']);

        // 1. Validation: Ensure CGPA is between 0 and 10
        if ($cgpa < 0 || $cgpa > 10) {
            header("Location: edit.php?type=student&id=$id&error=CGPA must be between 0 and 10");
            exit();
        }

        // 2. Validation: Ensure Name is not empty
        if (empty($name)) {
            header("Location: edit.php?type=student&id=$id&error=Name cannot be empty");
            exit();
        }

        // 3. Perform the Update
        $stmt = $pdo->prepare("UPDATE students SET name = ?, cgpa = ? WHERE id = ?");
        $stmt->execute([$name, $cgpa, $id]);
        
        header("Location: roster.php?notif=Student Record Updated Successfully");
    } 
    
    else if ($type == 'company') {
        $name = trim($_POST['name']);
        $industry = trim($_POST['industry']);
        $min_cgpa = floatval($_POST['min_cgpa']);

        // 1. Validation
        if ($min_cgpa < 0 || $min_cgpa > 10) {
            header("Location: edit.php?type=company&id=$id&error=Requirement must be between 0 and 10");
            exit();
        }

        if (empty($name) || empty($industry)) {
            header("Location: edit.php?type=company&id=$id&error=All fields are required");
            exit();
        }

        // 2. Perform the Update
        $stmt = $pdo->prepare("UPDATE companies SET name = ?, industry = ?, min_cgpa = ? WHERE id = ?");
        $stmt->execute([$name, $industry, $min_cgpa, $id]);
        
        header("Location: drives.php?notif=Placement Drive Updated Successfully");
    }
} else {
    // If someone tries to access this file directly without a form, send them home
    header("Location: dashboard.php");
}
exit();