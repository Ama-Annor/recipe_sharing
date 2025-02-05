<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Management - Delicious Discoveries</title>
    <link rel="stylesheet" href="../assets/css/recipes.css">
    <link rel="icon" type="image/jpg" href="../assets/images/logo.jpg"> 
</head>
<body>
    <header>
        <div class="logo">Delicious Discoveries - Recipe Management</div>
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
        <h2>Recipe Management</h2>
        
        <!--User Inputs for recipes-->
        <div class="form-container">
            <h3>Add New Recipe</h3>
            <form id="recipe-form" onsubmit="return validateForm()">
                <label for="recipe-title">Title:</label>
                <input type="text" id="recipe-title">

                <label for="ingredients-origin">Ingredients Origin:</label>
                <input type="text" id="ingredients-origin">

                <label for="ingredients-name">Ingredients (comma-separated):</label>
                <input type="text" id="ingredients-name">

                <label for="nutritional-value">Nutritional Value:</label>
                <input type="text" id="nutritional-value">

                <label for="allergen-info">Allergen Information:</label>
                <input type="text" id="allergen-info">

                <label for="shelf-life">Shelf Life:</label>
                <input type="text" id="shelf-life">

                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" required min="1">

                <label for="unit">Unit:</label>
                <input type="text" id="unit">

                <label for="recipe-image">Recipe Image URL:</label>
                <input type="url" id="recipe-image">

                <label for="prep-time">Preparation Time (Minutes):</label>
                <input type="number" id="prep-time" required min="0">

                <label for="cooking-time">Cooking Time (Minutes):</label>
                <input type="number" id="cooking-time" required min="0">

                <label for="serving-size">Serving Size:</label>
                <input type="text" id="serving-size">

                <label for="food-description">Food Description:</label>
                <textarea id="food-description"></textarea>

                <label for="calories">Calories per Serving:</label>
                <input type="number" id="calories" required min="0">

                <label for="food-origin">Food Origin:</label>
                <input type="text" id="food-origin">

                <label for="instructions">Instructions:</label>
                <textarea id="instructions"></textarea>

                <button type="submit">Add Recipe</button>
            </form>
        </div>

        <div class="recipe-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Date Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Chocolate Lava Cake</td>
                        <td>Adwoa Afari</td>
                        <td>2024-01-12</td>
                        <td>
                            <button class="edit" onclick="editRecipe(1)">Edit</button>
                            <button class="delete" onclick="confirmDeletion(1)">Delete</button>
                            <button class="view-more" onclick="viewRecipeDetails(1)">View More</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Pesto Pasta</td>
                        <td>Julius Osei</td>
                        <td>2024-02-25</td>
                        <td>
                            <button class="edit" onclick="editRecipe(2)">Edit</button>
                            <button class="delete" onclick="confirmDeletion(2)">Delete</button>
                            <button class="view-more" onclick="viewRecipeDetails(2)">View More</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!--Viewing recipe details -->
        <div id="recipe-modal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h3>Recipe Details</h3>
                <p><strong>Recipe ID: </strong><span id="modal-recipe-id"></span></p>
                <p><strong>Title: </strong><span id="modal-title"></span></p>
                <p><strong>Author: </strong><span id="modal-author"></span></p>
                <p><strong>Details: </strong><span id="modal-content"></span></p>
            </div>
        </div>

        <!--Editing recipes-->
        <div id="edit-recipe-modal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeEditModal()">&times;</span>
                <h3>Edit Recipe</h3>
                <form id="edit-recipe-form">
                    <label for="edit-recipe-title">Title:</label>
                    <input type="text" id="edit-recipe-title" required>

                    <label for="edit-ingredients-name">Ingredients:</label>
                    <input type="text" id="edit-ingredients-name" required>

                    <label for="edit-instructions">Instructions:</label>
                    <textarea id="edit-instructions" required></textarea>

                    <label for="edit-prep-time">Preparation Time (Minutes):</label>
                    <input type="number" id="edit-prep-time" required min="0">

                    <label for="edit-cooking-time">Cooking Time (Minutes):</label>
                    <input type="number" id="edit-cooking-time" required min="0">

                    <label for="edit-calories">Calories per Serving:</label>
                    <input type="number" id="edit-calories" required min="0">

                    <label for="edit-recipe-image">Recipe Image URL:</label>
                    <input type="url" id="edit-recipe-image" required>

                    <button type="button" onclick="saveEdit()">Save Changes</button>
                </form>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Delicious Discoveries. Recipe Management.</p>
    </footer>

    <script src="../assets/js/recipes.js"></script>
</body>
</html>


<!--References:
https://www.youtube.com/watch?v=y44GPiPPS4M&t=25s&pp=ygUdcmVjaXBlIHdlYnNpdGUgdHV0b3JpYWwgIGh0bWw%3D
https://www.youtube.com/watch?v=bhKJtFILfn0&pp=ygUkcmVjaXBlIHdlYnNpdGUgdHV0b3JpYWwgIGh0bWwgbW9kYWxz
https://www.youtube.com/watch?v=q5zT3S6BWN8&t=352s&pp=ygUkcmVjaXBlIHdlYnNpdGUgdHV0b3JpYWwgIGh0bWwgbW9kYWxz
-->