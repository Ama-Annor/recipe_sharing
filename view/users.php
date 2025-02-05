<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Delicious Discoveries</title>
    <link rel="stylesheet" href="../assets/css/users.css">
    <link rel="icon" href="../assets/images/logo.jpg">
</head>
<body>
    <header>
        <div class="logo">Delicious Discoveries - User Management</div>
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
        <h2>User Management</h2>
        
        <div class="search-container">
            <input type="text" id="user-search" placeholder="Search users by name or email...">
            <button id="search-button">Search</button>
        </div>

        <div class="user-container">
            <table>
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Registration Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../db/config.php';

                    if (!isset($conn)) {
                        die("Database connection not available. Please check your configuration.");
                    }

                    $query = "SELECT u.user_id, u.fname, u.lname, u.email, u.role, u.created_at
                             FROM users u";

                    $result = $conn->query($query);

                    if ($result) {
                        while ($row = $result->fetch_assoc()) {
                            // Format the date
                            $created_date = new DateTime($row['created_at']);
                            $formatted_date = $created_date->format('M d, Y g:i A');
                            
                            echo "<tr>
                                    <td>" . htmlspecialchars($row['user_id']) . "</td>
                                    <td>
                                        <div class='user-info'>
                                            <div>
                                                <span class='user-name'>" . htmlspecialchars($row['fname'] . ' ' . $row['lname']) . "</span>                                            
                                            </div>
                                        </div>
                                    </td>
                                    <td>" . htmlspecialchars($row['email']) . "</td>
                                    <td>" . ($row['role'] == 1 ? "Admin" : "User") . "</td>
                                    <td>" . htmlspecialchars($formatted_date) . "</td>
                                    <td class='action-buttons'>
                                        <button class='view-more' onclick='showUserDetails(" . $row['user_id'] . ")'>View More</button>
                                        <button class='edit' onclick='openEditModal(" . $row['user_id'] . ", \"" . htmlspecialchars($row['fname'] . ' ' . $row['lname'], ENT_QUOTES) . "\", \"" . htmlspecialchars($row['email'], ENT_QUOTES) . "\")'>Edit</button>
                                        <button class='delete' onclick='confirmDeletion(" . $row['user_id'] . ")'>Delete</button>
                                    </td>
                                </tr>";
                        }
                        $result->close();
                    } else {
                        echo "<tr><td colspan='6'>Error loading users: " . htmlspecialchars($conn->error) . "</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>

    <div id="user-modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>User Details</h2>
            <p id="user-details"></p>
        </div>
    </div>

    <div id="edit-modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditModal()">&times;</span>
            <h2>Edit User</h2>
            <form id="edit-form">
                <label for="edit-name">Name:</label>
                <input type="text" id="edit-name" required>
                <label for="edit-email">Email:</label>
                <input type="email" id="edit-email" required>
                <button type="submit" class="submit-button">Submit</button>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Delicious Discoveries. User Management.</p>
    </footer>

    <script>
    function openEditModal(userId, name, email) {
        const modal = document.getElementById('edit-modal');
        const form = document.getElementById('edit-form');
        const nameInput = document.getElementById('edit-name');
        const emailInput = document.getElementById('edit-email');
        
        nameInput.value = name;
        emailInput.value = email;
        form.dataset.userId = userId;
        
        modal.style.display = 'block';
    }

    function closeEditModal() {
        const modal = document.getElementById('edit-modal');
        modal.style.display = 'none';
    }

    function showUserDetails(userId) {
        const modal = document.getElementById('user-modal');
        const details = document.getElementById('user-details');
        details.textContent = 'Loading user details...';
        modal.style.display = 'block';
    }

    function closeModal() {
        const modal = document.getElementById('user-modal');
        modal.style.display = 'none';
    }

    function confirmDeletion(userId) {
        if (confirm("Are you sure you want to delete this user?")) {
            fetch('../functions/delete_user.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ 
                    user_id: parseInt(userId) 
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("User deleted successfully!");
                    location.reload();
                } else {
                    alert("Error deleting user: " + (data.error || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert("Error deleting user. Please try again.");
            });
        }
    }

    document.getElementById('edit-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const userId = this.dataset.userId;
        const name = document.getElementById('edit-name').value.trim();
        const email = document.getElementById('edit-email').value.trim();

        if (!userId) {
            alert("Error: No user ID found");
            return;
        }

        fetch('../functions/edit_user.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                user_id: parseInt(userId),
                name: name,
                email: email
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("User updated successfully!");
                location.reload();
            } else {
                alert("Error updating user: " + (data.error || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Error updating user. Please try again.");
        });
    });

    window.onclick = function(event) {
        const editModal = document.getElementById('edit-modal');
        const userModal = document.getElementById('user-modal');
        if (event.target == editModal) {
            closeEditModal();
        }
        if (event.target == userModal) {
            closeModal();
        }
    }
    </script>
</body>
</html>