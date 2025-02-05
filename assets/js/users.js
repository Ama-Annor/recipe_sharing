function showUserDetails(userId) {
    const userDetails = document.getElementById("user-details");
    
    //Mock user details based on userId
    const users = {
        1: "Adwoa Afari - Email: adwoaa@gmail.com - Recipes: 12",
        2: "Julius Osei - Email: josei@yahoo.com - Recipes: 10",
        3: "Charlie Owusu - Email: charlie@hotmail.com - Recipes: 8",
        4: "Kwadwo Annor - Email: kwad@gmail.com - Recipes: 6",
        5: "Mya Cudjoe - Email: myajoe@example.com - Recipes: 5",
    };

    userDetails.innerText = users[userId] || "User not found";
    document.getElementById("user-modal").style.display = "block";
}

//Close User Details Modal
function closeModal() {
    document.getElementById("user-modal").style.display = "none";
}

// Confirm User Deletion
function confirmDeletion(userId) {
    const confirmation = confirm(`Are you sure you want to delete User ID: ${userId}?`);
    if (confirmation) {
        alert(`User ID: ${userId} deleted successfully!`);
    }
}

// Open Edit User Modal
function openEditModal(userId, userName, userEmail) {
    document.getElementById("edit-name").value = userName;
    document.getElementById("edit-email").value = userEmail;

    //Add event listener to the form for submission
    document.getElementById("edit-form").onsubmit = function(event) {
        event.preventDefault(); 
        const updatedName = document.getElementById("edit-name").value;
        const updatedEmail = document.getElementById("edit-email").value;

        //Client-side validation
        if (validateEmail(updatedEmail) && updatedName.trim() !== "") {
            alert(`User ID: ${userId} updated! Name: ${updatedName}, Email: ${updatedEmail}`);
            closeEditModal(); 
        } else {
            alert("Please enter valid details.");
        }
    };

    document.getElementById("edit-modal").style.display = "block";
}

//Close Edit User Modal
function closeEditModal() {
    document.getElementById("edit-modal").style.display = "none";
}

//Validate Email Format
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(String(email).toLowerCase());
}

//Search Users Functionality
document.getElementById("user-search").addEventListener("input", function() {
    const searchTerm = this.value.toLowerCase();
    const rows = document.querySelectorAll(".user-container table tbody tr");
    
    rows.forEach(row => {
        const name = row.cells[1].textContent.toLowerCase();
        const email = row.cells[2].textContent.toLowerCase();
        
        if (name.includes(searchTerm) || email.includes(searchTerm)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
});

window.onclick = function(event) {
    const userModal = document.getElementById("user-modal");
    const editModal = document.getElementById("edit-modal");
    
    if (event.target === userModal) {
        closeModal();
    }
    if (event.target === editModal) {
        closeEditModal();
    }
}
