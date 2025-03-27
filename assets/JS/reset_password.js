//--------------------------------------------------------------------//
//------------mise en variable de la regex password------------------//
//------------------------------------------------------------------//

const passwordRegex =
  /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,}$/;
const password = document.getElementById("password");
const confirmPassword = document.getElementById("confirmPassword");
const checkConfirmPassword = document.querySelector(".checkConfirmPassword");
const checkPassword = document.querySelector(".checkPassword");
const sendBtn = document.getElementById("sendBtn");

sendBtn.disabled = true; // Désactiver le boutton d'envoi

// Récupérer ce qu'écrit l'utilisateur en temsp réel
password.addEventListener("input", function () {
  // Vérifie si les mots de passe correspondent et qu'il respecte bien le regex
  if (
    password.value === confirmPassword.value &&
    passwordRegex.test(password.value)
  ) {
    checkConfirmPassword.style.visibility = "visible"; // Affiche l'indicateur
    checkPassword.style.visibility = "visible"; // Affiche l'indicateur
    sendBtn.disabled = false; // Réactiver le boutton d'envoi si les deux mdp correspondent
  } else {
    checkConfirmPassword.style.visibility = "hidden"; // Masque l'indicateur
    checkPassword.style.visibility = "hidden"; // Masque l'indicateur
  }
});

// Récupérer ce qu'écrit l'utilisateur en temsp réel
confirmPassword.addEventListener("input", function () {
  // Vérifie si les mots de passe correspondent et qu'il respecte bien le regex
  if (
    password.value === confirmPassword.value &&
    passwordRegex.test(confirmPassword.value)
  ) {
    checkConfirmPassword.style.visibility = "visible"; // Affiche l'indicateur
    checkPassword.style.visibility = "visible"; // Affiche l'indicateur
    sendBtn.disabled = false; // Réactiver le boutton d'envoi si les deux mdp correspondent
  } else {
    checkConfirmPassword.style.visibility = "hidden"; // Masque l'indicateur
    checkPassword.style.visibility = "hidden"; // Masque l'indicateur
  }
});

//--------------------------------------------------------------------------------------------------------------//
//------------événement click sur l'oeil afin d'afficher ou de masquer le mot de passe-------------------------//
//------------------------------------------------------------------------------------------------------------//

const eyes = document.querySelectorAll(".eye");
const closeEyes = document.querySelectorAll(".closeEye");
const passwords = document.querySelectorAll("input[type='password']");

//Parcourir tout les eyeCloses des différent inputs
closeEyes.forEach((closeEye, index) => {
  const eye = eyes[index]; // Associer chaque œil à closeEyes
  const password = passwords[index]; // Associer chaque input type password à closeEyes

  closeEye.addEventListener("click", () => {
    if (password.type === "password") {
      password.type = "text";
    } else {
      password.type = "password";
    }
    eye.classList.toggle("open");
    closeEye.classList.toggle("open");
  });

  eye.addEventListener("click", () => {
    if (password.type === "text") {
      password.type = "password";
    } else {
      password.type = "text";
    }
    eye.classList.toggle("open");
    closeEye.classList.toggle("open");
  });
});
