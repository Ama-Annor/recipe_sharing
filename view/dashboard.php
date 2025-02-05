<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Delicious Discoveries</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="icon" href="../assets/images/logo.jpg">
</head>
<body>
    <header>
        <div class="logo">Delicious Discoveries</div>
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="recipes.php">Recipes</a></li>
                <li><a href="users.php">Users</a></li>
                <li><a href="../actions/logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section id="dashboard">
            <h2>DASHBOARD</h2>
            <div class="stats-container">
                <div class="stat-card">
                    <h3>TOTAL USERS</h3>
                    <p class="stat-number" id="total-users">Loading...</p>
                </div>
                <div class="stat-card">
                    <h3>TOTAL RECIPES</h3>
                    <p class="stat-number" id="total-recipes">Loading...</p>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Delicious Discoveries. Dashboard.</p>
    </footer>
    <script>
        function fetchDashboardStats() {
            // Fetch total users
            fetch('../functions/api.php?action=getTotalUsers')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('total-users').textContent = data.total_users || '0';
                })
                .catch(error => {
                    console.error('Error fetching total users:', error);
                });

            // Fetch total recipes
            fetch('../functions/api.php?action=getTotalRecipes')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('total-recipes').textContent = data.total_recipes || '0';
                })
                .catch(error => {
                    console.error('Error fetching total recipes:', error);
                });
        }

        document.addEventListener('DOMContentLoaded', fetchDashboardStats);
    </script>
</body>
</html>