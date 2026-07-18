<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Amrita Core | Analytics</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --bg: #09090b; --sidebar: #121214; --card: #1c1c20; --accent: #6366f1; --text-main: #fafafa; --text-muted: #a1a1aa; --border: rgba(255, 255, 255, 0.08); --success: #10b981; }
        body { background-color: var(--bg); color: var(--text-main); font-family: 'Plus Jakarta Sans', sans-serif; margin: 0; display: flex; }
        .sidebar { width: 280px; background: var(--sidebar); border-right: 1px solid var(--border); padding: 40px 24px; position: fixed; height: 100vh; }
        .logo { font-size: 1.25rem; font-weight: 700; color: var(--accent); display: flex; align-items: center; gap: 12px; margin-bottom: 48px; text-decoration:none; }
        .nav-item { color: var(--text-muted); text-decoration: none; padding: 12px 16px; border-radius: 10px; margin-bottom: 8px; display: flex; align-items: center; gap: 12px; transition: 0.2s; }
        .nav-item.active { background: rgba(99, 102, 241, 0.1); color: var(--accent); }
        
        .main { margin-left: 280px; padding: 60px 80px; width: calc(100% - 280px); min-height: 100vh; }
        
        .chart-container { background: var(--card); border: 1px solid var(--border); padding: 40px; border-radius: 32px; margin-bottom: 32px; }
        .bar-row { margin-bottom: 32px; }
        .bar-label { display: flex; justify-content: space-between; margin-bottom: 12px; font-weight: 600; }
        .bar-bg { height: 14px; background: #27272a; border-radius: 10px; overflow: hidden; }
        .bar-fill { height: 100%; background: linear-gradient(90deg, var(--accent), #a855f7); border-radius: 10px; transition: 1.5s cubic-bezier(0.4, 0, 0.2, 1); width: 0; }
    </style>
</head>
<body>
    <aside class="sidebar">
        <a href="dashboard.php" class="logo"><i class="fa-solid fa-shield-halved"></i> AMRITA CORE</a>
        <nav>
            <a href="dashboard.php" class="nav-item"><i class="fa-solid fa-chart-pie"></i> Dashboard</a>
            <a href="roster.php" class="nav-item"><i class="fa-solid fa-users"></i> Student Roster</a>
            <a href="drives.php" class="nav-item"><i class="fa-solid fa-building"></i> Placement Drives</a>
            <a href="analytics.php" class="nav-item active"><i class="fa-solid fa-microchip"></i> Global Analytics</a>
        </nav>
    </aside>
    <main class="main">
        <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 12px;">Global Analytics</h1>
        <p style="color:var(--text-muted); margin-bottom: 48px; font-size: 1.1rem;">Live data insights calculated via Python Analytical Engine</p>
        
        <div class="chart-container shadow">
            <h3 style="margin-top:0; margin-bottom: 32px;">Eligibility Distribution Per Company</h3>
            <?php 
            $total_students = $pdo->query("SELECT COUNT(*) FROM students")->fetchColumn();
            $stmt = $pdo->query("SELECT c.name, r.eligible_count FROM companies c LEFT JOIN analytics_results r ON c.id = r.company_id");
            while($row = $stmt->fetch()):
                $perc = $total_students > 0 ? ($row['eligible_count'] / $total_students) * 100 : 0;
            ?>
            <div class="bar-row">
                <div class="bar-label">
                    <span><?php echo $row['name']; ?></span>
                    <span style="color:var(--success)"><?php echo round($perc); ?>% Students Eligible</span>
                </div>
                <div class="bar-bg"><div class="bar-fill" style="width:<?php echo $perc; ?>%"></div></div>
            </div>
            <?php endwhile; ?>
        </div>
    </main>
    <script>
        // Trigger animation for the bars
        window.onload = () => {
            const fills = document.querySelectorAll('.bar-fill');
            fills.forEach(fill => {
                const width = fill.style.width;
                fill.style.width = '0';
                setTimeout(() => { fill.style.width = width; }, 100);
            });
        }
    </script>
</body>
</html>