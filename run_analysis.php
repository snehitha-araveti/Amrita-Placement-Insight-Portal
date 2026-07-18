<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Use the absolute path
$python_path = "C:/Python313/python.exe";
$script_path = "C:/wamp64/www/amrita_placement/placement_engine.py";

// 1. Run and capture both output AND errors
$output = [];
$return_var = 0;
exec("$python_path $script_path 2>&1", $output, $return_var);

// 2. If it failed, show us the error!
if ($return_var !== 0) {
    echo "<h1>Python Error Detected!</h1>";
    echo "<pre>" . implode("\n", $output) . "</pre>";
    echo "<hr><a href='dashboard.php'>Go Back</a>";
    exit();
}

// 3. If it succeeded, redirect
header("Location: dashboard.php?notif=Analysis Successful");
exit();
?>