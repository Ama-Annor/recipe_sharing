<?php
session_start();
// Check if user is logged in and is a regular admin
if (!isset($_SESSION['user_id']) || $_SESSION['userrole'] != 2) {
    header("Location: ../login.php");
    exit();
}

// Hardcoded data for demonstration
$personalStats = [
    ['title' => 'Total Recipes', 'value' => 15],
    ['title' => 'Pending Approvals', 'value' => 3],
    ['title' => 'Approved Recipes', 'value' => 12],
    ['title' => 'Recipe Categories', 'value' => 4]
];

$recentRecipes = [
    ['id' => 1, 'name' => 'Chocolate Cake', 'status' => 'Approved', 'date' => '2024-03-20'],
    ['id' => 2, 'name' => 'Pasta Carbonara', 'status' => 'Pending', 'date' => '2024-03-19'],
    ['id' => 3, 'name' => 'Garden Salad', 'status' => 'Approved', 'date' => '2024-03-18']
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regular Admin Dashboard</title>
    <link rel="stylesheet" href="../../assets/css/regular_admin_dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="icon" type="image/jpg" href="../../assets/images/logo.jpg">
    <link rel="stylesheet" href="../assets/css/regular_admin_dashboard.css">
</head>
<body>
    <header>
        <div class="logo">Recipe Admin Portal</div>
        <nav>
            <ul>
                <li><a href="regular_admin_dashboard.php" class="active">Dashboard</a></li>
                <li><a href="recipe_feed.php">Recipes</a></li>
                <li><a href="../actions/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Welcome, <?php echo $_SESSION['fname']; ?></h2>

        <!-- Stats Container -->
        <div class="stats-container">
            <?php foreach ($personalStats as $stat): ?>
            <div class="stat-card">
                <h3><?php echo $stat['title']; ?></h3>
                <div class="stat-number"><?php echo $stat['value']; ?></div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Charts Container -->
        <div class="charts-container">
            <!-- Recent Recipes Section -->
            <div class="chart-card">
                <h3>Recent Recipe Submissions</h3>
                <div class="active-users">
                    <?php foreach ($recentRecipes as $recipe): ?>
                    <div class="user-card">
                        <div class="user-info">
                            <div class="username"><?php echo $recipe['name']; ?></div>
                        </div>
                        <div class="user-recipes">
                            <span class="status <?php echo strtolower($recipe['status']); ?>">
                                <?php echo $recipe['status']; ?>
                            </span>
                            <span class="date"><?php echo $recipe['date']; ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Recipe Categories Chart -->
            <div class="chart-card">
                <h3>Recipe Categories Distribution</h3>
                <div class="bar-chart">
                    <div class="bar" style="height: 60%;">
                        <span class="bar-label">Desserts</span>
                        <span class="bar-value">5</span>
                    </div>
                    <div class="bar" style="height: 80%;">
                        <span class="bar-label">Main Course</span>
                        <span class="bar-value">4</span>
                    </div>
                    <div class="bar" style="height: 40%;">
                        <span class="bar-label">Appetizers</span>
                        <span class="bar-value">3</span>
                    </div>
                    <div class="bar" style="height: 30%;">
                        <span class="bar-label">Beverages</span>
                        <span class="bar-value">3</span>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Recipe Admin Portal. All rights reserved.</p>
    </footer>
</body>
</html>