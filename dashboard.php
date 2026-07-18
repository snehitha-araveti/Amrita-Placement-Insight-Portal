<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amrita Placement | Enterprise Insight Portal</title>
    
    <!-- Professional Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --bg: #09090b;
            --sidebar: #121214;
            --card: #1c1c20;
            --accent: #6366f1; /* Modern Indigo */
            --text-main: #fafafa;
            --text-muted: #a1a1aa;
            --success: #10b981;
            --border: rgba(255, 255, 255, 0.08);
        }

        * { box-sizing: border-box; }
        body { 
            background-color: var(--bg); 
            color: var(--text-main); 
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0; 
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Navigation */
        .sidebar {
            width: 280px;
            background: var(--sidebar);
            border-right: 1px solid var(--border);
            padding: 40px 24px;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
        }

        .logo {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--accent);
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 48px;
        }

        .nav-item {
            color: var(--text-muted);
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .nav-item.active {
            background: rgba(99, 102, 241, 0.1);
            color: var(--accent);
        }

        .nav-item:hover:not(.active) {
            background: rgba(255, 255, 255, 0.03);
            color: white;
        }

        /* Main Content Area */
        .main {
            margin-left: 280px;
            padding: 48px;
            width: 100%;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 40px;
        }

        .btn-python {
            background: var(--accent);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.3);
            transition: transform 0.2s;
        }

        .btn-python:hover { transform: translateY(-2px); filter: brightness(1.1); }

        /* KPI Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-bottom: 48px;
        }

        .stat-card {
            background: var(--card);
            border: 1px solid var(--border);
            padding: 24px;
            border-radius: 20px;
        }

        .stat-label { color: var(--text-muted); font-size: 0.875rem; margin-bottom: 8px; }
        .stat-value { font-size: 2rem; font-weight: 700; }

        /* Company Card Grid */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 24px;
        }

        .company-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 32px;
            position: relative;
            transition: border-color 0.3s;
        }

        .company-card:hover { border-color: var(--accent); }

        .industry-tag {
            background: rgba(99, 102, 241, 0.1);
            color: var(--accent);
            padding: 4px 12px;
            border-radius: 100px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .company-name { font-size: 1.5rem; margin: 16px 0 8px; font-weight: 700; }
        .criteria { color: var(--text-muted); font-size: 0.935rem; margin-bottom: 32px; }

        /* Python Result Box */
        .python-insight {
            background: rgba(16, 185, 129, 0.05);
            border: 1px solid rgba(16, 185, 129, 0.1);
            border-radius: 16px;
            padding: 20px;
        }

        .insight-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .insight-title { color: var(--success); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; }
        .eligibility-number { font-size: 2.25rem; font-weight: 700; color: var(--success); }

        .progress-container { height: 6px; background: #27272a; border-radius: 10px; overflow: hidden; margin-top: 12px; }
        .progress-bar { height: 100%; background: var(--success); border-radius: 10px; transition: width 1s ease; }
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="logo">
        <i class="fa-solid fa-shield-halved"></i> AMRITA CORE
    </div>
    <nav>
        <a href="dashboard.php" class="nav-item active"><i class="fa-solid fa-grid-2"></i> Dashboard</a>
        <a href="roster.php" class="nav-item"><i class="fa-solid fa-users"></i> Student Roster</a>
        <a href="drives.php" class="nav-item"><i class="fa-solid fa-building-user"></i> Placement Drives</a>
        <a href="analytics.php" class="nav-item"><i class="fa-solid fa-chart-pie"></i> Global Analytics</a>
    </nav>
</aside>

<main class="main">
    <div class="header">
        <div>
            <h1 style="font-size: 2rem; font-weight: 800; margin: 0;">Placement Dashboard</h1>
            <p style="color: var(--text-muted); margin-top: 4px;">Intelligence Engine Status: <span style="color: var(--success);">● Operational</span></p>
        </div>
        <a href="run_analysis.php" class="btn-python">
            <i class="fa-solid fa-bolt-lightning"></i> Get Analysis
        </a>
    </div>

    <!-- Notification Alert -->
    <?php if(isset($_GET['notif'])): ?>
        <div style="background: rgba(16, 185, 129, 0.1); color: var(--success); padding: 16px; border-radius: 12px; margin-bottom: 32px; border: 1px solid rgba(16, 185, 129, 0.2);">
            <i class="fa-solid fa-circle-check"></i> <?php echo $_GET['notif']; ?>
        </div>
    <?php endif; ?>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label">Total Students</div>
            <div class="stat-value"><?php echo $pdo->query("SELECT COUNT(*) FROM students")->fetchColumn(); ?></div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Partner Companies</div>
            <div class="stat-value"><?php echo $pdo->query("SELECT COUNT(*) FROM companies")->fetchColumn(); ?></div>
        </div>
        <div class="stat-card">
            <div class="stat-label">Avg. Eligibility</div>
            <div class="stat-value" style="color: var(--accent);">84%</div>
        </div>
    </div>

    <h2 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 24px;">Upcoming Recruitment Drives</h2>
    <div class="card-grid">
        <?php
        $query = "SELECT c.*, r.eligible_count FROM companies c 
                  LEFT JOIN analytics_results r ON c.id = r.company_id";
        $stmt = $pdo->query($query);
        while ($row = $stmt->fetch()):
            $count = $row['eligible_count'] ?? 0;
            $total_students = $pdo->query("SELECT COUNT(*) FROM students")->fetchColumn();
            $percent = $total_students > 0 ? ($count / $total_students) * 100 : 0;
        ?>
        <div class="company-card">
            <span class="industry-tag"><?php echo $row['industry']; ?></span>
            <h3 class="company-name"><?php echo $row['name']; ?></h3>
            <p class="criteria">Required: <strong><?php echo $row['min_cgpa']; ?> CGPA</strong></p>
            
            <div class="python-insight">
                <div class="insight-header">
                    <span class="insight-title">Eligibility Insight</span>
                    <i class="fa-solid fa-microchip" style="color: var(--success); opacity: 0.5;"></i>
                </div>
                <div style="display: flex; align-items: baseline; gap: 8px;">
                    <span class="eligibility-number"><?php echo $count; ?></span>
                    <span style="color: var(--text-muted); font-size: 0.875rem;">Students Eligible</span>
                </div>
                <div class="progress-container">
                    <div class="progress-bar" style="width: <?php echo $percent; ?>%"></div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</main>

</body>
</html>