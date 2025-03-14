// /*------------------------------------*/
// /*              nom                */
// /*------------------------------------*/

// let lastname = localStorage.getItem("lastname");

// const accountLastname = document.getElementById("accountLastname");

// accountLastname.innerHTML = `<input type="text"  value="${lastname}" readonly>`;

// /*------------------------------------*/
// /*              prénom                */
// /*------------------------------------*/

// let firstname = localStorage.getItem("firstname");

// const accountFirstname = document.getElementById("accountFirstname");

// accountFirstname.innerHTML = `<input type="text" value="${firstname}" readonly>`;

// /*------------------------------------*/
// /*                tel                 */
// /*------------------------------------*/

// let tel = localStorage.getItem("tel");

// const accountTel = document.getElementById("accountTel");

// accountTel.innerHTML = `<input type="text"  value="${tel}" readonly>`;

// /*------------------------------------*/
// /*               email                */
// /*------------------------------------*/

// let email = localStorage.getItem("email");

// const accountEmail = document.getElementById("accountEmail");

// accountEmail.innerHTML = `<input type="email" value="${email}" readonly>`;

// /*------------------------------------*/
// /*             password               */
// /*------------------------------------*/

// let password = localStorage.getItem("password");

// const accountPassword = document.getElementById("accountPassword");

// accountPassword.innerHTML = `<input type="password"  value="${password}" readonly>`;

// /*------------------------------------*/
// /*              adress                */
// /*------------------------------------*/

// let adress = localStorage.getItem("adress");

// const accountAdress = document.getElementById("accountAdress");

// accountAdress.innerHTML = `<textarea readonly>${adress}</textarea>`;

// /*------------------------------------*/
// /*        incrémentation card         */
// /*------------------------------------*/

// let cards = JSON.parse(localStorage.getItem("cards"));

// let framsChoice = document.getElementById("framsChoice");

// framsChoice.innerHTML = cards;

let displayGlasses = JSON.parse(localStorage.getItem("glassDatas"));

let framsCrush = document.getElementById("framsCrush");

// displayGlasses.forEach((displayGlasse, index) => {
//   framsCrush.innerHTML += `<div class='cards' id='lunette'>
//                               <div class='imgSize'>
//                                     <img src="${displayGlasse.image_path}" alt="lunette ${displayGlasse.image_path}" class="img">
//                               </div>
//                               <h4>${displayGlasse.name}</h4>
//                               <p><strong>Prix:</strong>  ${displayGlasse.price}  €</p>
//                               <p><strong>Couleur:</strong>   ${displayGlasse.color}  </p>
//                               <p><strong>Matière:</strong>   ${displayGlasse.matter}  </p>
//                               <p><strong>Genre:</strong>   ${displayGlasse.gender} </p>
//                               <p><strong>Catégorie:</strong>   ${displayGlasse.category}  </p>
//                               <p><strong>Marque:</strong>   ${displayGlasse.brand}  </p>
//                               <input type="text" name="index" value="${index}"/>
//                               <button class='buttonDeleteCrush'>Spprimer des coups de coeurs</button>
//                             </div>`;
// });

// Récupérer les cartes stockées dans localStorage pour les crushs
let storedCards = JSON.parse(localStorage.getItem("cardsData")) || [];

storedCards.forEach((storedCard) => {
  // Créer un div et insérer la carte
  let div = document.createElement("div");
  div.innerHTML = storedCard.html;
  div.setAttribute("data-id", storedCard.id);

  // Sélectionner le bouton "Ajouter au panier"
  let deleteButton = div.querySelector(".buttonPushCart");

  if (deleteButton) {
    deleteButton.textContent = " Supprimer des favoris"; // Changer le texte

    // Ajouter un événement au bouton pour supprimer la carte
    deleteButton.addEventListener("click", () => {
      div.remove(); // Supprimer du DOM

      // Supprimer la carte du localStorage
      storedCards = storedCards.filter((card) => card.id !== storedCard.id);
      localStorage.setItem("cardsData", JSON.stringify(storedCards));

      console.log("Carte supprimée :", storedCard.id);
    });
  }

  framsCrush.appendChild(div); // Ajouter la carte à la liste des favoris
});

// Une fois les cartes ajoutées, récupérer tous les boutons 'buttonPushCart' dans le DOM
let buttonPushCart = document.querySelectorAll(".buttonPushCart");

// Ajouter un événement à chaque bouton 'buttonPushCart'
buttonPushCart.forEach((button) => {
  button.addEventListener("click", () => {
    // Logique à ajouter lors du clic sur le bouton (ex. supprimer la carte des coups de cœur)
    console.log("Carte supprimée des coups de cœur!");
  });
});

const buttonDeleteCrushs = document.querySelectorAll(".buttonDeleteCrush");

buttonDeleteCrushs.forEach((buttonDeleteCrush, index) => {
  buttonDeleteCrush.addEventListener("click", () => {
    // // Supprimer un élément
    displayGlasses.forEach((displayGlasse, index) => {
      console.log(displayGlasses["index"]);
    });

    //     localStorage.removeItem("displayGlasses['index']");
  });
});

// // Sppression de l'atribu readonly lors du click sur le boutton "modifier coordonnes" afin de pouvoir soumettre le formualire afin de changer ses coordonnes

// const inputForm = document.querySelectorAll(".identity input");
// console.log(inputForm);

// const btnModify = document.getElementById("modify");

// btnModify.addEventListener("click", () => {
//   inputForm.forEach((input) => {
//     if (input.hasAttribute("readonly")) {
//       input.removeAttribute("readonly"); // Supprimer readonly
//     }
//     // else {
//     //   input.setAttribute("readonly", true); // Ajouter readonly
//     // }
//   });
// });
