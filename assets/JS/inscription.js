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
  /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>])[A-Za-z\d!@#$%^&*(),.?":{}|<>]{8,}$/;

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

btnSubmitCustomer.addEventListener("click", (event) => {
  const customerMailValue = inputCustomerMail.value;
  if (emailRegex.test(customerMailValue)) {
    emailCustomerTcheck.classList.add("open");
    labelCustomerMail.style.visibility = "hidden";
  } else {
    emailCustomerTcheck.classList.remove("open");
    labelCustomerMail.style.visibility = "visible";
  }

  const customerPasswordValue = inputPasswordCustomer.value;
  if (passwordRegex.test(customerPasswordValue)) {
    passwordCustomerTcheck.classList.add("open");
    labelPasswordCustomer.style.visibility = "hidden";
  } else {
    passwordCustomerTcheck.classList.remove("open");
    labelPasswordCustomer.style.visibility = "visible";
  }
  if (
    emailRegex.test(customerMailValue) &&
    passwordRegex.test(customerPasswordValue)
  ) {
    return true;
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
console.log(closeEyeCustomer, eyeCustomer);

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

//--------------------------------------------------------------------------------------------------------------//
//------------événement click sur le btn submit pour la verification regex d'un nouveau client-----------------//
//------------------------------------------------------------------------------------------------------------//

// en cliquant sur le boutton si les caractères sont corrects faire apparaitre le logo sinon faire apparaitre le text
btnSubmit.addEventListener("click", () => {
  const lastnameValue = inputLastname.value.trim();
  if (lastnameRegex.test(lastnameValue)) {
    lastnameTcheck.classList.add("open");
    labelLastname.style.visibility = "hidden";
  } else {
    labelLastname.style.visibility = "visible";
    lastnameTcheck.classList.remove("open");
  }

  const firstnameValue = inputFirstname.value.trim();
  if (firstnameRegex.test(firstnameValue)) {
    firstnameTcheck.classList.add("open");
    labelFirstname.style.visibility = "hidden";
  } else {
    labelFirstname.style.visibility = "visible";
    firstnameTcheck.classList.remove("open");
  }

  const telValue = inputTel.value.trim();
  if (telRegex.test(telValue)) {
    telTcheck.classList.add("open");
    labelTel.style.visibility = "hidden";
  } else {
    labelTel.style.visibility = "visible";
    telTcheck.classList.remove("open");
  }

  const emailValue = inputEmail.value.trim();
  if (emailRegex.test(emailValue)) {
    emailTcheck.classList.add("open");
    labelEmail.style.visibility = "hidden";
  } else {
    labelEmail.style.visibility = "visible";
    emailTcheck.classList.remove("open");
  }

  const passwordValue = inputfPassword.value.trim();
  if (passwordRegex.test(passwordValue)) {
    passwordTcheck.classList.add("open");
    eye.style.visibility = "hidden";
    closeEye.style.visibility = "hidden";
    labelPassword.style.visibility = "hidden";
  } else {
    labelPassword.style.visibility = "visible";
    passwordTcheck.classList.remove("open");
  }

  const adressValue = inputAdress.value;
  if (adressRegex.test(adressValue)) {
    postalAdressTcheck.classList.add("open");
    labelAdress.style.visibility = "hidden";
  } else {
    labelAdress.style.visibility = "visible";
    postalAdressTcheck.classList.remove("open");
  }
});
/*if (
    emailRegex.test(customerMailValue) &&
    passwordRegex.test(currentPasswordValue)
  ) {
    return true;
  }
});*/
