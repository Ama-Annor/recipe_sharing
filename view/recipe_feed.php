<?php
// Start the session
session_start();

// Check if the user is logged in by verifying the session variable
if (!isset($_SESSION['user_id'])) {
    // If the user is not logged in, redirect them to the login page
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/recipe_feed.css">
    <title>Delicious Discoveries - Recipe Feed</title>
    <link rel="icon" type="image/jpg" href="../assets/images/logo.jpg">
</head>

<body>
    <header>
        <div class="logo">Delicious Discoveries</div>
        <div class="nav-bar">
            <ul>
                <li><a href="regular_admin_dashboard.php">Dashboard</a></li>                                                               
                <li><a href="../actions/logout.php">Logout</a></li>
            </ul>
        </div>
    </header>

    <div class="search-container">
        <input type="text" id="recipe-search" placeholder="Search recipes...">
        <button type="button" id="search-button">Search</button>
    </div>

    <div class="featured-recipes">
        <h2>Featured Recipes</h2>
        <div class="recipe-grid">
            <!-- Recipe Card 1 -->
            <div class="recipe-card">
                <img src="../assets/images/chicken.jpeg" alt="Chicken Teriyaki">
                <div class="card-info">
                    <h3>Chicken Teriyaki</h3>
                    <p>A delicious Japanese-inspired dish with tender chicken and a sweet-savory sauce.</p>
                    <div class="rating">★★★★☆</div>
                    <a href="#" class="view-recipe">View Recipe</a>
                </div>
            </div>

            <!-- Recipe Card 2 -->
            <div class="recipe-card">
                <img src="../assets/images/pizza.jpeg" alt="Classic Margherita Pizza">
                <div class="card-info">
                    <h3>Classic Margherita Pizza</h3>
                    <p>A simple yet flavorful pizza with fresh mozzarella, tomatoes, and basil.</p>
                    <div class="rating">★★★★★</div>
                    <a href="#" class="view-recipe">View Recipe</a>
                </div>
            </div>

            <!-- Recipe Card 3 -->
            <div class="recipe-card">
                <img src="../assets/images/lavacake.jpeg" alt="Chocolate Lava Cake">
                <div class="card-info">
                    <h3>Chocolate Lava Cake</h3>
                    <p>A decadent dessert with a gooey chocolate center that flows like lava.</p>
                    <div class="rating">★★★★★</div>
                    <a href="#" class="view-recipe">View Recipe</a>
                </div>
            </div>

            <!-- Recipe Card 4 -->
            <div class="recipe-card">
                <img src="../assets/images/salad.jpeg" alt="Fresh Caesar Salad">
                <div class="card-info">
                    <h3>Fresh Caesar Salad</h3>
                    <p>A crisp and tangy salad with romaine lettuce, croutons, and Caesar dressing.</p>
                    <div class="rating">★★★★☆</div>
                    <a href="#" class="view-recipe">View Recipe</a>
                </div>
            </div>

            <!-- Recipe Card 5 -->
            <div class="recipe-card">
                <img src="../assets/images/burger.jpeg" alt="Homemade Beef Burgers">
                <div class="card-info">
                    <h3>Homemade Beef Burgers</h3>
                    <p>Juicy beef patties with all the classic burger fixings.</p>
                    <div class="rating">★★★★☆</div>
                    <a href="#" class="view-recipe">View Recipe</a>
                </div>
            </div>

            <!-- Recipe Card 6 -->
            <div class="recipe-card">
                <img src="../assets/images/pasta.jpeg" alt="Creamy Tuscan Chicken Pasta">
                <div class="card-info">
                    <h3>Creamy Tuscan Chicken Pasta</h3>
                    <p>A rich and creamy pasta dish with tender chicken, sun-dried tomatoes, and spinach.</p>
                    <div class="rating">★★★★★</div>
                    <a href="#" class="view-recipe">View Recipe</a>
                </div>
            </div>

            <!-- Recipe Card 7 -->
            <div class="recipe-card">
                <img src="../assets/images/soup.jpeg" alt="Tomato Basil Soup">
                <div class="card-info">
                    <h3>Tomato Basil Soup</h3>
                    <p>A comforting soup made with ripe tomatoes and fresh basil.</p>
                    <div class="rating">★★★★☆</div>
                    <a href="#" class="view-recipe">View Recipe</a>
                </div>
            </div>

            <!-- Recipe Card 8 -->
            <div class="recipe-card">
                <img src="../assets/images/sushi.jpeg" alt="Fresh Sushi Platter">
                <div class="card-info">
                    <h3>Fresh Sushi Platter</h3>
                    <p>A variety of sushi rolls featuring fresh fish and vegetables.</p>
                    <div class="rating">★★★★★</div>
                    <a href="#" class="view-recipe">View Recipe</a>
                </div>
            </div>

            <!-- Recipe Card 9 -->
            <div class="recipe-card">
                <img src="../assets/images/tacos.jpeg" alt="Spicy Beef Tacos">
                <div class="card-info">
                    <h3>Spicy Beef Tacos</h3>
                    <p>Flavorful ground beef tacos with fresh toppings and a zesty kick.</p>
                    <div class="rating">★★★★☆</div>
                    <a href="#" class="view-recipe">View Recipe</a>
                </div>
            </div>

            <!-- Recipe Card 10 -->
            <div class="recipe-card">
                <img src="../assets/images/pancake.webp" alt="Fluffy Pancakes">
                <div class="card-info">
                    <h3>Fluffy Pancakes</h3>
                    <p>Light and airy pancakes perfect for a delightful breakfast treat.</p>
                    <div class="rating">★★★★★</div>
                    <a href="#" class="view-recipe">View Recipe</a>
                </div>
            </div>
        </div>
    </div>

    <div class="categories">
        <h2>Categories</h2>
        <!-- Category Card 1 -->
        <div class="category-grid">
            <div class="category-card">
                <img src="../assets/images/main_course.jpeg" alt="Main Course">
                <div class="category-info">
                    <h3>Main Courses</h3>
                    <a href="#" class="read-more">Explore</a>
                </div>
            </div>
            <!-- Category Card 2 -->
            <div class="category-card">
                <img src="../assets/images/desserts.jpeg" alt="Desserts">
                <div class="category-info">
                    <h3>Desserts</h3>
                    <a href="#" class="read-more">Explore</a>
                </div>
            </div>
            <!-- Category Card 3 -->
            <div class="category-card">
                <img src="../assets/images/healthy_eats.jpeg" alt="Healthy Eats">
                <div class="category-info">
                    <h3>Healthy Eats</h3>
                    <a href="#" class="read-more">Explore</a>
                </div>
            </div>
            <!-- Category Card 4 -->
            <div class="category-card">
                <img src="../assets/images/baking.jpeg" alt="Baking">
                <div class="category-info">
                    <h3>Baking</h3>
                    <a href="#" class="read-more">Explore</a>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="social-icons">
            <p>Follow Us on Social Media</p>
            <div class="icons">
                <span>Facebook</span>
                <span>Twitter</span>
                <span>Instagram</span>
            </div>
        </div>
        <h5>Copyright © 2024 By Delicious Discoveries</h5>
    </footer>
</body>

</html>
