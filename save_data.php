<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type = $_POST['type'];

    if ($type == 'student') {
        $name = trim($_POST['name']);
        $cgpa = floatval($_POST['cgpa']);
        $branch = $_POST['branch'];

        // VALIDATION LOGIC
        if (empty($name) || strlen($name) < 3) {
            header("Location: roster.php?error=Invalid Name (Min 3 chars)");
            exit();
        }
        if ($cgpa < 0 || $cgpa > 10) {
            header("Location: roster.php?error=CGPA must be between 0 and 10.00");
            exit();
        }

        // INSERT IF VALID
        $stmt = $pdo->prepare("INSERT INTO students (name, cgpa, branch) VALUES (?, ?, ?)");
        $stmt->execute([$name, $cgpa, $branch]);
        header("Location: roster.php?notif=Student Added Successfully");
    } 
    
    else if ($type == 'company') {
        $name = trim($_POST['name']);
        $industry = trim($_POST['industry']);
        $min_cgpa = floatval($_POST['min_cgpa']);

        // VALIDATION LOGIC
        if (empty($name) || empty($industry)) {
            header("Location: drives.php?error=All fields are required");
            exit();
        }
        if ($min_cgpa < 0 || $min_cgpa > 10) {
            header("Location: drives.php?error=Requirement must be between 0 and 10");
            exit();
        }

        $stmt = $pdo->prepare("INSERT INTO companies (name, industry, min_cgpa) VALUES (?, ?, ?)");
        $stmt->execute([$name, $industry, $min_cgpa]);
        header("Location: drives.php?notif=Company Drive Added");
    }
}
?>