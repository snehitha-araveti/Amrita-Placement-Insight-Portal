<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Amrita Core | Student Roster</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --bg: #09090b; --sidebar: #121214; --card: #1c1c20; --accent: #6366f1; --text-main: #fafafa; --text-muted: #a1a1aa; --border: #334155; }
        body { background-color: var(--bg); color: var(--text-main); font-family: 'Plus Jakarta Sans', sans-serif; margin: 0; display: flex; }
        .sidebar { width: 280px; background: var(--sidebar); border-right: 1px solid rgba(255,255,255,0.1); padding: 40px 24px; position: fixed; height: 100vh; }
        .logo { font-size: 1.25rem; font-weight: 700; color: var(--accent); display: flex; align-items: center; gap: 12px; margin-bottom: 48px; text-decoration:none; }
        .nav-item { color: var(--text-muted); text-decoration: none; padding: 12px 16px; border-radius: 10px; margin-bottom: 8px; display: flex; align-items: center; gap: 12px; transition: 0.2s; }
        .nav-item.active { background: rgba(99, 102, 241, 0.1); color: var(--accent); }
        
        /* FIX: Main content spacing */
        .main { margin-left: 280px; padding: 60px 100px; width: calc(100% - 280px); }
        
        .form-card { background: var(--card); border: 1px solid rgba(255,255,255,0.05); padding: 35px; border-radius: 24px; margin-bottom: 50px; }
        
        /* FIX: Robust Spacing using Flex and Margin */
        .form-flex { display: flex; align-items: flex-end; width: 100%; }
        .input-group { flex: 1; margin-right: 40px; } /* This creates the gap */
        .input-group:last-child { margin-right: 0; }
        
        label { display: block; font-size: 0.85rem; color: var(--text-muted); margin-bottom: 10px; font-weight: 600; }
        input, select { 
            background: #000; 
            border: 1px solid var(--border); 
            color: white; 
            padding: 14px 18px; 
            border-radius: 12px; 
            width: 100%; 
            font-size: 0.95rem;
            transition: border-color 0.3s;
        }
        input:focus { border-color: var(--accent); outline: none; }
        
        .btn-save { 
            background: var(--accent); 
            color: white; 
            border: none; 
            padding: 15px 30px; 
            border-radius: 12px; 
            cursor: pointer; 
            font-weight: 700; 
            min-width: 160px;
            box-shadow: 0 4px 14px rgba(99, 102, 241, 0.4);
        }

        table { width: 100%; border-collapse: collapse; background: var(--card); border-radius: 20px; overflow: hidden; }
        th { text-align: left; padding: 20px; color: var(--text-muted); border-bottom: 1px solid rgba(255,255,255,0.05); font-size: 0.75rem; text-transform: uppercase; }
        td { padding: 20px; border-bottom: 1px solid rgba(255,255,255,0.05); }
    </style>
</head>
<body>
    <aside class="sidebar">
        <a href="dashboard.php" class="logo"><i class="fa-solid fa-shield-halved"></i> AMRITA CORE</a>
        <nav>
            <a href="dashboard.php" class="nav-item"><i class="fa-solid fa-chart-pie"></i> Dashboard</a>
            <a href="roster.php" class="nav-item active"><i class="fa-solid fa-users"></i> Student Roster</a>
            <a href="drives.php" class="nav-item"><i class="fa-solid fa-building"></i> Placement Drives</a>
            <a href="analytics.php" class="nav-item"><i class="fa-solid fa-microchip"></i> Global Analytics</a>
        </nav>
    </aside>
    <main class="main">
        <h1 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 10px;">Student Roster</h1>
        <p style="color: var(--text-muted); margin-bottom: 40px;">Manage student profiles and academic performance</p>
        <?php if(isset($_GET['error'])): ?>
    <div style="background: rgba(239, 68, 68, 0.1); color: #ef4444; padding: 15px; border-radius: 12px; margin-bottom: 20px; border: 1px solid rgba(239, 68, 68, 0.2); font-weight: 600;">
        <i class="fa-solid fa-triangle-exclamation"></i> <?php echo htmlspecialchars($_GET['error']); ?>
    </div>
<?php endif; ?>
        <div class="form-card">
            <form action="save_data.php" method="POST" class="form-flex">
                <input type="hidden" name="type" value="student">
                
                <div class="input-group">
                    <label>Full Name</label>
                    <input type="text" name="name" minlength="3" pattern="[A-Za-z\s]+" title="Names should only contain letters" placeholder="e.g. Rahul Nair" required>
                </div>
                
                <div class="input-group">
                    <label>Current CGPA</label>
                    <input type="number" step="0.01" name="cgpa" placeholder="0.00" min="0.0" max ="10.0" required>
                </div>
                
                <div class="input-group">
                    <label>Department</label>
                    <select name="branch">
                        <option>CSE</option><option>ECE</option><option>ME</option><option>AIE</option>
                    </select>
                </div>
                
                <div class="input-group" style="flex: 0;">
                    <button type="submit" class="btn-save">Add Student</button>
                </div>
            </form>
        </div>

        <table>
            <thead>
    <tr>
        <th>Student Name</th>
        <th>Branch</th>
        <th>CGPA</th>
        <th>Status</th>
        <th style="text-align:right;">Actions</th> <!-- Add this -->
    </tr>
</thead>
<tbody>
    <?php $stmt = $pdo->query("SELECT * FROM students ORDER BY id DESC");
    while($s = $stmt->fetch()): ?>
    <tr>
        <td><strong style="font-weight: 600;"><?php echo $s['name']; ?></strong></td>
        <td><?php echo $s['branch']; ?></td>
        <td><?php echo $s['cgpa']; ?></td>
        <td><span style="color:var(--accent); font-weight:600;">● Active</span></td>
        <td style="text-align:right;">
            <!-- EDIT BUTTON -->
            <a href="edit.php?type=student&id=<?php echo $s['id']; ?>" style="color:var(--text-muted); margin-right:15px;"><i class="fa-solid fa-pen-to-square"></i></a>
            <!-- DELETE BUTTON -->
            <a href="delete_data.php?type=student&id=<?php echo $s['id']; ?>" style="color:#ef4444;" onclick="return confirm('Delete this student?')"><i class="fa-solid fa-trash"></i></a>
        </td>
    </tr>
    <?php endwhile; ?>
</tbody>
        </table>
    </main>
</body>
</html>