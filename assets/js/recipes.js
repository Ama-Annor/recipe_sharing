const recipes = [
    {
        id: 1,
        title: "Chocolate Lava Cake",
        author: "Adwoa Afari",
        details: "A delicious chocolate cake with a gooey center.",
        ingredients: "Flour, Cocoa powder, Butter, Eggs, Sugar",
        instructions: "1. Mix ingredients. 2. Bake for 10 minutes.",
        prepTime: 15,
        cookingTime: 10,
        calories: 350,
        imageUrl: "https://food.com/lava-cake.jpg"
    },
    {
        id: 2,
        title: "Pesto Pasta",
        author: "Julius Osei",
        details: "A quick and easy pasta dish with homemade pesto.",
        ingredients: "Pasta, Pesto sauce, Parmesan, Olive oil",
        instructions: "1. Cook pasta. 2. Mix with pesto sauce.",
        prepTime: 10,
        cookingTime: 15,
        calories: 250,
        imageUrl: "https://food.com/pesto-pasta.jpg"
    }
];

//Getting recipe details by ID
function getRecipeById(recipeId) {
    return recipes.find(recipe => recipe.id === recipeId);
}

//The Wiew More Feature (Modal)
function viewRecipeDetails(recipeId) {
    const recipe = getRecipeById(recipeId);

    if (recipe) {
        //Populating modal with recipe details
        document.getElementById("modal-recipe-id").innerText = recipe.id;
        document.getElementById("modal-title").innerText = recipe.title;
        document.getElementById("modal-author").innerText = recipe.author;
        document.getElementById("modal-content").innerText = recipe.details;

        //Modal is shown
        document.getElementById("recipe-modal").style.display = 'block';
    }
}

//Edit Recipe Feature (Modal)
function editRecipe(recipeId) {
    const recipe = getRecipeById(recipeId);

    if (recipe) {
        //Pre-fill the edit form with existing recipe data
        document.getElementById("edit-recipe-title").value = recipe.title;
        document.getElementById("edit-ingredients-name").value = recipe.ingredients;
        document.getElementById("edit-instructions").value = recipe.instructions;
        document.getElementById("edit-prep-time").value = recipe.prepTime;
        document.getElementById("edit-cooking-time").value = recipe.cookingTime;
        document.getElementById("edit-calories").value = recipe.calories;
        document.getElementById("edit-recipe-image").value = recipe.imageUrl;

        //Show the edit modal
        document.getElementById("edit-recipe-modal").style.display = 'block';
    }
}

//Save edited recipe
function saveEdit() {
    const recipeId = document.getElementById("modal-recipe-id").innerText;
    const recipe = getRecipeById(parseInt(recipeId));

    if (recipe) {
        //Update the recipe data from the edit form
        recipe.title = document.getElementById("edit-recipe-title").value;
        recipe.ingredients = document.getElementById("edit-ingredients-name").value;
        recipe.instructions = document.getElementById("edit-instructions").value;
        recipe.prepTime = document.getElementById("edit-prep-time").value;
        recipe.cookingTime = document.getElementById("edit-cooking-time").value;
        recipe.calories = document.getElementById("edit-calories").value;
        recipe.imageUrl = document.getElementById("edit-recipe-image").value;

        alert("Recipe updated successfully!");
        closeEditModal();
    }
}

//View More modal is closed
function closeModal() {
    document.getElementById("recipe-modal").style.display = 'none';
}

//Edit modal is closed
function closeEditModal() {
    document.getElementById("edit-recipe-modal").style.display = 'none';
}

//Confirmation of Deletio 
function confirmDeletion(recipeId) {
    if (confirm("Are you sure you want to delete this recipe?")) {
        deleteRecipe(recipeId);
    }
}

//Fake deletion of a recipe
function deleteRecipe(recipeId) {
    const index = recipes.findIndex(recipe => recipe.id === recipeId);
    if (index > -1) {
        recipes.splice(index, 1);  
        alert("Recipe deleted successfully.");
        location.reload();  
    }
}

//Client-side validation for adding/editing recipes
function validateForm() {
    let title = document.getElementById("recipe-title").value;
    let ingredients = document.getElementById("ingredients-name").value;
    let instructions = document.getElementById("instructions").value;
    let cookingTime = document.getElementById("cooking-time").value;
    let prepTime = document.getElementById("prep-time").value;
    let calories = document.getElementById("calories").value;
    let imageUrl = document.getElementById("recipe-image").value;

    if (!title || !ingredients || !instructions || !cookingTime || !prepTime || !calories || !imageUrl) {
        alert("Please fill out all required fields.");
        return false;
    }

    if (isNaN(cookingTime) || cookingTime <= 0) {
        alert("Cooking time must be a positive number.");
        return false;
    }

    if (isNaN(prepTime) || prepTime <= 0) {
        alert("Preparation time must be a positive number.");
        return false;
    }

    if (isNaN(calories) || calories <= 0) {
        alert("Calories must be a positive number.");
        return false;
    }

    if (!isValidUrl(imageUrl)) {
        alert("Please provide a valid URL for the recipe image.");
        return false;
    }

    return true;
}

//URL validation
function isValidUrl(url) {
    let pattern = new RegExp('^(https?:\\/\\/)?'+ //protocol
    '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+//domain name
    '((\\d{1,3}\\.){3}\\d{1,3}))'+ //OR ip address
    '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ 
    '(\\?[;&a-z\\d%_.~+=-]*)?'+ 
    '(\\#[-a-z\\d_]*)?$','i'); 
    return !!pattern.test(url);
}

//Sources: 
//https://regex-generator.olafneumann.org/
//https://www.w3schools.com/howto/howto_css_modals.asp
//https://www.freecodecamp.org/news/how-to-build-a-modal-with-javascript/
