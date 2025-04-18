//---------------------------------------------------------//
//-----récupération du boutton submit et des inputs-------//
//-------------------------------------------------------//

const btnSubmit = document.getElementById("submit");

const btnSubmitCustomer = document.getElementById("submitCustomer");

const inputCustomerMail = document.querySelector("#customerMail");

let inputPasswordCustomer = document.getElementById("passwordCustomer");

let inputLastname = document.getElementById("lastname");

let inputFirstname = document.getElementById("firstname");

let inputEmail = document.getElementById("email");

let inputPassword = document.getElementById("password");

let inputAdress = document.getElementById("adressT");

let inputTel = document.getElementById("tel");

//------------------------------------------------------------------------//
//------------recherche des labels + logo de validation------------------//
//----------------------------------------------------------------------//

////////////////////   Si déja client   ///////////////////////

const labelCustomerMail = document.getElementById("labelCustomerMail");
const emailCustomerTcheck = document.getElementById("emailCustomerTcheck");

const labelPasswordCustomer = document.getElementById("labelPasswordCustomer");
const passwordCustomerTcheck = document.getElementById(
  "passwordCustomerTcheck"
);

////////////////////   Si nouveau client   ////////////////////

const labelPassword = document.getElementById("labelPassword");
const passwordTcheck = document.getElementById("password-tcheck");

const labelFirstname = document.getElementById("labelFirstname");
const firstnameTcheck = document.getElementById("firstname-tcheck");

const labelLastname = document.getElementById("labelLastname");
const lastnameTcheck = document.getElementById("lastname-tcheck");

const labelTel = document.getElementById("labelTel");
const telTcheck = document.getElementById("tel-tcheck");

const labelEmail = document.getElementById("labelEmail");
const emailTcheck = document.getElementById("email-tcheck");

const labelAdress = document.getElementById("labelAdress");
const postalAdressTcheck = document.getElementById("postal-adress-tcheck");

//---------------------------------------------------------//
//------------mise en variable des regex------------------//
//-------------------------------------------------------//

const emailRegex = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i;

const passwordRegex =
  /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,}$/;

const firstnameRegex =
  /^[A-ZÀÂÄÆÇÉÈÊËÎÏÔÖŒÙÛÜŸa-zàâäæçéèêëîïôöœùûüÿ' -]{2,50}$/i;

const lastnameRegex =
  /^[A-ZÀÂÄÆÇÉÈÊËÎÏÔÖŒÙÛÜŸa-zàâäæçéèêëîïôöœùûüÿ' -]{2,50}$/i;

const telRegex = /^(?:\+33|0)(?:\s|-|\.)?[1-9](?:\s|-|\.|\d){8}$/;

const adressRegex =
  /^\s*(\d{1,5})\s+(bis|ter|quater)?\s*(rue|avenue|boulevard|chemin|place|quai|allée|square|impasse|passage)?\s+([\w\sèéàîï\-']+){3,}\s*(\d{5})?\s*([\w\s\-']+)?\s*$/;

//---------------------------------------------------------------------------------------------------------------//
//------------événement click sur le btn submit pour la verification regex d'un client éxistant-----------------//
//-------------------------------------------------------------------------------------------------------------//

// Fonction verificationInput qui renvoi un booléen
function verificationInput(inputElement, regex, checkElement, labelElement) {
  const inputValue = inputElement.value.trim();

  if (regex.test(inputValue)) {
    checkElement.classList.add("open");
    labelElement.style.visibility = "hidden";
    return true; // Champ valide
  } else {
    checkElement.classList.remove("open");
    labelElement.style.visibility = "visible";
    return false; // Champ invalide
  }
}
btnSubmitCustomer.addEventListener("click", (event) => {
  let isValid = true; // On suppose que tout est valide au départ

  isValid &= verificationInput(
    inputCustomerMail,
    emailRegex,
    emailCustomerTcheck,
    labelCustomerMail
  );

  isValid &= verificationInput(
    inputPasswordCustomer,
    passwordRegex,
    passwordCustomerTcheck,
    labelPasswordCustomer
  );

  if (!isValid) {
    event.preventDefault(); // Empêche l'envoi si un champ est invalide
  }
});

//--------------------------------------------------------------------------------------------------------------//
//------------événement click sur le btn submit pour la verification regex d'un nouveau client-----------------//
//------------------------------------------------------------------------------------------------------------//

btnSubmit.addEventListener("click", (event) => {
  let isValid = true; // Vérifier si tous les champs sont valides

  // Vérification des champs
  isValid &= verificationInput(
    inputLastname,
    lastnameRegex,
    lastnameTcheck,
    labelLastname
  );
  isValid &= verificationInput(
    inputFirstname,
    firstnameRegex,
    firstnameTcheck,
    labelFirstname
  );
  isValid &= verificationInput(inputTel, telRegex, telTcheck, labelTel);
  isValid &= verificationInput(inputEmail, emailRegex, emailTcheck, labelEmail);
  isValid &= verificationInput(
    inputPassword,
    passwordRegex,
    passwordTcheck,
    labelPassword
  );
  isValid &= verificationInput(
    inputAdress,
    adressRegex,
    postalAdressTcheck,
    labelAdress
  );

  // Gestion spéciale pour le champ mot de passe
  if (passwordRegex.test(inputPassword.value.trim())) {
    eye.style.visibility = "hidden";
    closeEye.style.visibility = "hidden";
  }

  // Empêcher la soumission si le formulaire n'est pas valide
  if (!isValid) {
    event.preventDefault();
  }
});

//--------------------------------------------------------------------------------------------------------------//
//------------événement click sur l'oeil afin d'afficher ou de masquer le mot de passe-------------------------//
//------------------------------------------------------------------------------------------------------------//

////////////////////
///si déja client///
////////////////////

const eyeCustomer = document.getElementById("eyeCustomer");
const closeEyeCustomer = document.getElementById("closeEyeCustomer");
const passwordCustomer = document.getElementById("passwordCustomer");

closeEyeCustomer.addEventListener("click", () => {
  if (passwordCustomer.type === "password") {
    passwordCustomer.type = "text";
  }
  eyeCustomer.classList.toggle("open");
  closeEyeCustomer.classList.toggle("open");
});
eyeCustomer.addEventListener("click", () => {
  if (passwordCustomer.type === "text") {
    passwordCustomer.type = "password";
  }
  eyeCustomer.classList.toggle("open");
  closeEyeCustomer.classList.toggle("open");
});

////////////////////
///si new  client///
////////////////////

const eye = document.getElementById("eye");
const currentPassword = document.getElementById("password");
const closeEye = document.getElementById("closeEye");

closeEye.addEventListener("click", () => {
  if (currentPassword.type === "password") {
    currentPassword.type = "text";
  }
  eye.classList.toggle("open");
  closeEye.classList.toggle("open");
});
eye.addEventListener("click", () => {
  if (currentPassword.type === "text") {
    currentPassword.type = "password";
  }
  eye.classList.toggle("open");
  closeEye.classList.toggle("open");
});
