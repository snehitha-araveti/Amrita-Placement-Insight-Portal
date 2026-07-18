<?php 
include 'db.php'; 
$type = $_GET['type'];
$id = $_GET['id'];

if($type == 'student') {
    $data = $pdo->prepare("SELECT * FROM students WHERE id = ?");
    $data->execute([$id]);
    $item = $data->fetch();
} else {
    $data = $pdo->prepare("SELECT * FROM companies WHERE id = ?");
    $data->execute([$id]);
    $item = $data->fetch();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Entry | Amrita Core</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --bg: #09090b; --card: #1c1c20; --accent: #6366f1; --text-main: #fafafa; --border: #334155; }
        body { background-color: var(--bg); color: var(--text-main); font-family: 'Plus Jakarta Sans', sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .edit-card { background: var(--card); border: 1px solid var(--border); padding: 40px; border-radius: 24px; width: 450px; box-shadow: 0 20px 40px rgba(0,0,0,0.4); }
        input, select { background: #000; border: 1px solid var(--border); color: white; padding: 14px; border-radius: 12px; width: 100%; margin-bottom: 20px; }
        .btn-update { background: var(--accent); color: white; border: none; padding: 15px; border-radius: 12px; width: 100%; font-weight: 700; cursor: pointer; }
        .cancel-link { display: block; text-align: center; margin-top: 20px; color: #a1a1aa; text-decoration: none; font-size: 0.9rem; }
    </style>
</head>
<body>
    <div class="edit-card">
        <?php if(isset($_GET['error'])): ?>
    <div style="background: rgba(239, 68, 68, 0.1); color: #ef4444; padding: 12px; border-radius: 10px; margin-bottom: 20px; border: 1px solid rgba(239, 68, 68, 0.2); font-size: 0.85rem;">
        <i class="fa-solid fa-circle-exclamation"></i> <?php echo htmlspecialchars($_GET['error']); ?>
    </div>
<?php endif; ?>
        <h2 style="margin-top:0">Edit <?php echo ucfirst($type); ?></h2>
        <form action="update_data.php" method="POST">
            <input type="hidden" name="type" value="<?php echo $type; ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <?php if($type == 'student'): ?>
                <label>Full Name</label>
                <input type="text" name="name" value="<?php echo $item['name']; ?>" required>
                <label>CGPA</label>
                <input type="number" step="0.01" name="cgpa" value="<?php echo $item['cgpa']; ?>" required>
            <?php else: ?>
                <label>Company Name</label>
                <input type="text" name="name" value="<?php echo $item['name']; ?>" required>
                <label>Industry</label>
                <input type="text" name="industry" value="<?php echo $item['industry']; ?>" required>
                <label>Min CGPA</label>
                <input type="number" step="0.01" name="min_cgpa" value="<?php echo $item['min_cgpa']; ?>" required>
            <?php endif; ?>

            <button type="submit" class="btn-update">Save Changes</button>
            <a href="dashboard.php" class="cancel-link">Cancel and Go Back</a>
        </form>
    </div>
</body>
</html>