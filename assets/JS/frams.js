/*--------------------------------------------------------------------------------------------------*/
/*---------------------------------------menu filtres ----------------------------------------------*/
/*--------------------------------------------------------------------------------------------------*/

const buttonFilter = document.getElementById("buttonFilter");
const menuSearch = document.getElementById("menuSearch");
const overlay = document.getElementById("overlay");
const buttonReset = document.querySelector(".buttonReset");

buttonFilter.addEventListener("click", () => {
  buttonFilter.classList.toggle("open");
  menuSearch.classList.toggle("open");
  overlay.classList.toggle("open");
});

overlay.addEventListener("click", () => {
  buttonFilter.classList.remove("open");
  menuSearch.classList.remove("open");
  overlay.classList.remove("open");
});

//-----------------------------------------------------------------//
//-----------------réinitialiser les filtres----------------------//
//---------------------------------------------------------------//

buttonReset.addEventListener("click", () => {
  // Récupérer toutes les checkboxes cochées
  const checkedBoxes = document.querySelectorAll(
    'input[type="checkbox"]:checked'
  );
  // Vérifier si des checkboxes sont cochées
  if (checkedBoxes.length > 0) {
    // Réinitialiser toutes les checkboxes cochées
    checkedBoxes.forEach((checkbox) => {
      checkbox.checked = false;
    });
  }
});

//---------------------------------------------------------------------------------------//
//-----------------Récupérer les données de la cards souhaitée -------------------------//
//-------------------------------------------------------------------------------------//

document.addEventListener("DOMContentLoaded", () => {
  let cards = document.querySelectorAll(".cards");

  cards.forEach((currentGlass) => {
    // Récupérer l'icone coeur de la carte sélectionnée
    let heart = currentGlass.querySelector(".bi-heart-fill");

    // Récupérer le boutton de la carte sélectionnée
    const buttonPushCart = currentGlass.querySelector(".buttonPushCart");

    // Récupérer l'ID unique
    let cardId = currentGlass.getAttribute("data-id");

    // Récupérer tout le HTML de la carte
    let cardHTML = currentGlass.outerHTML;

    // Vérifier si cette carte est déjà en favoris pour changer la couleur du cœur au chargement
    let storedCards = JSON.parse(localStorage.getItem("cardsData")) || [];
    let isFavorite = storedCards.some((storedCard) => storedCard.id === cardId);

    if (isFavorite) {
      heart.classList.add("heart-red");
      heart.classList.remove("heart-black");
    } else {
      heart.classList.add("heart-black");
      heart.classList.remove("heart-red");
    }

    heart.addEventListener("click", () => {
      let storedCards = JSON.parse(localStorage.getItem("cardsData")) || [];

      if (!heart.classList.contains("heart-red")) {
        // Ajouter la classe rouge et enregistrer la carte
        heart.classList.add("heart-red");
        heart.classList.remove("heart-black");

        storedCards.push({ id: cardId, html: cardHTML });
        localStorage.setItem("cardsData", JSON.stringify(storedCards));

        console.log("Ajouté :", storedCards);
      } else {
        // Remettre la classe noire et supprimer la carte
        heart.classList.add("heart-black");
        heart.classList.remove("heart-red");

        storedCards = storedCards.filter(
          (storedCard) => storedCard.id !== cardId
        );
        localStorage.setItem("cardsData", JSON.stringify(storedCards));

        console.log("Supprimé :", storedCards);
      }
    });

    buttonPushCart.addEventListener("click", () => {
      buttonPushCart.style.backgroundColor = "green";
      buttonPushCart.style.color = "white";

      let cartStoredCards =
        JSON.parse(localStorage.getItem("cardsDataCart")) || [];

      // Récupère la source de l'image
      let image = currentGlass.querySelector("img").src;
      // Récupère le nom des lunettes
      let name = currentGlass.querySelector("h3").textContent;
      // Extrait le texte du prix
      let priceText = currentGlass.querySelector("#price").textContent;
      // Extrait uniquement le prix numérique
      let price = parseFloat(priceText.replace(/[^0-9.]/g, ""));
      console.log("le prix est de : " + priceText);
      console.log("le prix est de : " + price);

      cartStoredCards.push({ name, price, image });

      localStorage.setItem("cardsDataCart", JSON.stringify(cartStoredCards));

      // Récupérer les cartes stockées dans localStorage
      let storedCardsCartLength =
        JSON.parse(localStorage.getItem("cardsDataCart")) || [];
      // Afficher le nbr d'article dans le logo panier
      document.querySelector(".nbrArticle").textContent =
        storedCardsCartLength.length;
      document.querySelector(".nbrArticleBurger").textContent =
        storedCardsCartLength.length;
    });
  });
});
// //------------------------------------------------------------------//
// //----------------Changer la couleur du coeur----------------------//
// //----------------------------------------------------------------//

// let hearts = document.querySelectorAll(".bi-heart-fill");

// hearts.forEach((heart, index) => {
//   heart.addEventListener("click", () => {
//     // Basculer la couleur du cœur entre rouge et noir
//     heart.style.color = heart.style.color === "red" ? "black" : "red";
//   });
// });

/*--------------------------------------------------------------------------------------------------*/
/*-------------------------------------recuperation JSON--------------------------------------------*/
/*--------------------------------------------------------------------------------------------------*/

// fetch("/assets/datas/glasses.json")
//   .then((response) => response.json()) // Convertir la réponse en JSON

//   .then((glasses) => {
//     glasses.forEach((glass) => {
//       const containerCards = document.querySelector(".containerCards");
//       const glassCard = document.createElement("div");
//       glassCard.classList.add("cards");

//       glassCard.innerHTML = `
//       <img src="${glass.image}" alt="${glass.name}" style="width: 100%; height: 200px;" class="img">
//         <h3>${glass.name}</h3>
//         <p>Prix : ${glass.price} </p>
//         <p>Couleur : ${glass.color}</p>
//         <p>Matière : ${glass.matiere} </p>
//         <i class="bi bi-heart-fill"></i>
//         <button class="buttonPushKart">Ajouté au panier</button>
//       `;

//       containerCards.appendChild(glassCard);
//       heartChoice();
//     });
//   })
//   .catch((error) => {
//     console.error("Erreur lors du chargement des données :", error);
//   });

// //-----------------------------------------------------------------//
// //-----------------code pour filter les lunettes------------------//
// //---------------------------------------------------------------//

// buttonFilter.addEventListener("click", () => {
//   // Conteneur principal où les cartes seront ajoutées
//   let containerCards = document.querySelector(".containerCards");

//   // Vider le conteneur avant d'afficher les résultats filtrés
//   containerCards.innerHTML = "";

//   // Récupérer les checkboxes cochées
//   const checkedBoxes = document.querySelectorAll(
//     'input[type="checkbox"]:checked'
//   );

//   //Mettres les valeurs en minuscule pour facilité la recherche
//   const checkboxValues = Array.from(checkedBoxes).map((input) =>
//     input.value.toLowerCase()
//   );

//   // Charger les données depuis le fichier JSON
//   fetch("/assets/datas/glasses.json")
//     .then((response) => response.json())
//     .then((glasses) => {
//       // Filtrer les lunettes en fonction des valeurs cochées
//       const filteredGlasses = glasses.filter((glass) => {
//         // Vérifie si au moins une valeur cochée correspond à l'une des propriétés
//         return checkboxValues.some((value) =>
//           [
//             glass.color.toLowerCase(),
//             glass.matiere.toLowerCase(),
//             glass.genre.toLowerCase(),
//             glass.forme.toLowerCase(),
//           ].includes(value)
//         );
//       });

//       // Afficher les lunettes filtrées
//       if (filteredGlasses.length > 0) {
//         filteredGlasses.forEach((glass) => {
//           // Créer une carte pour chaque lunette filtrée
//           const glassCard = document.createElement("div");

//           glassCard.innerHTML = `
//             <img src="${glass.image}" alt="${glass.name}" style="width: 100%; height: 200px;" class="img">
//             <h3>${glass.name}</h3>
//             <p>Prix : ${glass.price}</p>
//             <p>Couleur : ${glass.color}</p>
//             <p>Matière : ${glass.matiere}</p>
//             <i class="bi bi-heart-fill"></i>
//             <button class="buttonPushKart">Ajouté au panier</button>
//           `;
//           glassCard.classList.add("cards");
//           // Ajouter la/les carte(s) au conteneur principal
//           containerCards.appendChild(glassCard);
//           heartChoice();
//         });
//       } else {
//         // Aucun résultat trouvé
//         containerCards.innerHTML =
//           "<p><b>Aucun résultat trouvé pour les filtres sélectionnés.</b></p>";
//       }
//     })
//     .catch((error) => {
//       console.error("Erreur lors du chargement des données :", error);
//       containerCards.innerHTML =
//         "<p>Erreur lors du chargement des données.</p>";
//     });
// });

// //----------------------------------------------------------------------------------------------//
// //---------fonction qui récupère les lunettes sélectionnées grâce au click sur le coeur--------//
// //--------------------------------------------------------------------------------------------//

// function heartChoice() {
//   let cards = document.querySelectorAll(".cards");
//   let hearts = document.querySelectorAll(".bi-heart-fill");

//   hearts.forEach((heart, index) => {
//     heart.addEventListener("click", () => {
//       // Basculer la couleur du cœur entre rouge et noir
//       heart.style.color = heart.style.color === "red" ? "black" : "red";

//       // Récupérer ou initialiser le tableau dans le localStorage
//       let tableau = JSON.parse(localStorage.getItem("cards")) || [];

//       let currentCard = cards[index].outerHTML; // Récupérer le contenu de la carte associée
//       let cardIndex = cards[index];

//       if (heart.style.color === "red") {
//         // Ajouter la carte au tableau si elle n'est pas déjà dedans
//         if (!tableau.includes(currentCard)) {
//           tableau.push(currentCard);
//         }
//       } else {
//         // Retirer la carte du tableau si elle est désélectionnée
//         // tableau = tableau.filter((card) => card !== currentCard);
//         delete tableau[cardIndex];
//       }

//       // Sauvegarder le tableau dans le localStorage
//       localStorage.setItem("cards", JSON.stringify(tableau));

//       // Affichage dans la console pour vérifier
//       console.log(tableau);
//     });
//   });
// }

// Charger les données depuis le fichier JSON (exemple pour récupérer les lunettes) après avoir clicker sur réinitialisé
//   fetch("/assets/datas/glasses.json")
//     .then((response) => response.json())
//     .then((glasses) => {
//       const container = document.querySelector(".containerCards"); // Conteneur où les cartes seront affichées
//       container.innerHTML = ""; // Vider le conteneur avant d'ajouter les nouvelles cartes

//       // Créer une carte pour chaque lunette (ou autre contenu)
//       glasses.forEach((glass) => {
//         const glassCard = document.createElement("div");
//         glassCard.classList.add("cards");

//         glassCard.innerHTML = `
//           <img src="${glass.image}" alt="${glass.name}" style="width: 100%; height: 200px;" class="img">
//           <h3>${glass.name}</h3>
//           <p>Prix : ${glass.price}</p>
//           <p>Couleur : ${glass.color}</p>
//           <p>Matière : ${glass.matiere}</p>
//           <i class="bi bi-heart-fill"></i>
//           <button class="buttonPushKart">Ajouté au panier</button>
//         `;

//         // Ajouter la carte au conteneur
//         container.appendChild(glassCard);
//       });
//     })
//     .catch((error) => {
//       console.error("Erreur lors du chargement des données :", error);
//     });
// });
