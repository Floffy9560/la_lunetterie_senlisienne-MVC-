let displayGlasses = JSON.parse(localStorage.getItem("glassDatas"));

let framsCrush = document.getElementById("framsCrush");

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

// Confirmation lors de la suppression du compte
// =============================================
// const form = document.getElementById("deleteAccountForm");

// form.addEventListener("submit", function (e) {
//   e.preventDefault(); // Empêche la soumission du formulaire immédiatement

//   // Affiche SweetAlert pour la confirmation
//   Swal.fire({
//     title: "Êtes-vous sûr ?",
//     text: "Cette action est irréversible. Votre compte sera supprimé.",
//     icon: "warning",
//     showCancelButton: true,
//     confirmButtonColor: "#c89f36",
//     cancelButtonColor: "#d33",
//     confirmButtonText: "Oui, supprimer",
//     cancelButtonText: "Annuler",
//     customClass: {
//       popup: "custom-swal",
//       confirmButton: "custom-confirm-btn",
//       cancelButton: "custom-cancel-btn",
//       icon: "custom-icon",
//     },
//   }).then((result) => {
//     if (result.isConfirmed) {
//       form.submit();
//     }
//   });
// });
const deleteButton = document.getElementById("supprimer");
const form = document.getElementById("deleteAccountForm");

deleteButton.addEventListener("click", () => {
  Swal.fire({
    title: "Êtes-vous sûr ?",
    text: "Cette action est irréversible. Votre compte sera supprimé.",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#c89f36",
    cancelButtonColor: "#d33",
    confirmButtonText: "Oui, supprimer",
    cancelButtonText: "Annuler",
    customClass: {
      popup: "custom-swal",
      confirmButton: "custom-confirm-btn",
      cancelButton: "custom-cancel-btn",
      icon: "custom-icon",
    },
  }).then((result) => {
    if (result.isConfirmed) {
      form.submit(); // C’est ici que la magie opère
    }
  });
});
