document.addEventListener("DOMContentLoaded", function () {

  //This function is to validate user's input
  function validateEmailFormat(emailAddress) {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(emailAddress);
  }

  //This function is to validate password strength
  function isValidPassword(password) {
    const passwordRegex = /^(?=.*[A-Z])(?=(?:.*\d){3})(?=.*[\W_]).{8,}$/;
    return passwordRegex.test(password);
  }
});

const signupForm = document.getElementById("signupForm");
const inputFirstName = document.getElementById("firstName");
const inputLastName = document.getElementById("lastName");
const inputEmail = document.getElementById("email");
const inputPassword = document.getElementById("password");
const inputConfirmPassword = document.getElementById("confirmPassword");
const successMessage = document.getElementById("successMessage");

function validateForm() {
  let formIsValid = true;
  successMessage.textContent = "";

  //Validate first name input
  if (!inputFirstName.value.trim()) {
    document.getElementById("firstNameError").textContent =
      "First name is required";
    formIsValid = false;
  } else {
    document.getElementById("firstNameError").textContent = "";
  }

  //Validate last name input
  if (!inputLastName.value.trim()) {
    document.getElementById("lastNameError").textContent =
      "Last name is required";
    formIsValid = false;
  } else {
    document.getElementById("lastNameError").textContent = "";
  }

  //Validate email input
  if (!inputEmail.value.trim()) {
    document.getElementById("emailError").textContent = "Email is required";
    formIsValid = false;
  } else if (!validateEmailFormat(inputEmail.value)) {
    document.getElementById("emailError").textContent =
      "Please enter a valid email address";
    formIsValid = false;
  } else {
    document.getElementById("emailError").textContent = "";
  }

  //Validate password input
  if (!inputPassword.value.trim()) {
    document.getElementById("passwordError").textContent =
      "Password is required";
    formIsValid = false;
  } else if (!isValidPassword(inputPassword.value)) {
    document.getElementById("passwordError").textContent =
      "Password must be at least 8 characters long, contain one uppercase letter, three digits, and one special character";
    formIsValid = false;
  } else {
    document.getElementById("passwordError").textContent = "";
  }

  //Validate confirm password input
  if (inputPassword.value !== inputConfirmPassword.value) {
    document.getElementById("confirmPasswordError").textContent =
      "Passwords do not match";
    formIsValid = false;
  } else {
    document.getElementById("confirmPasswordError").textContent = "";
  }

  //Show success message if form is valid
  // if (formIsValid) {
  //     successMessage.textContent = 'Registration successful! You can now log in.';
  // }
  return formIsValid;
}

//Sources:
//https://regex-generator.olafneumann.org/
//https://www.w3schools.com/howto/howto_css_modals.asp
//https://www.freecodecamp.org/news/how-to-build-a-modal-with-javascript/
