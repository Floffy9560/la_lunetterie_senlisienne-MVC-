//------------------------------------------------------------------------------//
//--- Récupération des cards présente dans le locale storage cardsDataCart ---  //
//------------------------------------------------------------------------------//

// Récupérer les cartes stockées dans localStorage
let storedCardsCart = JSON.parse(localStorage.getItem("cardsDataCart")) || [];
console.log(storedCardsCart.length);

const body = document.getElementById("body");
console.log("body");

// Afficher les cartes présentes dans le localStorage
if (storedCardsCart.length > 0) {
  storedCardsCart.forEach((card, index) => {
    body.innerHTML += ` <div class="bodyCart">
                          <div class="secondColumn produits">
                            <div class="img">
                                <img src="${card.image}" alt="${card.name}" >  
                            </div>
                            <div class="article">                        
                                <span>Modèle : ${card.name}</span>
                            </div>
                            <div class="choiceQuantity">
                                    <button class="less">-</button>
                                    <p class="quantity">1</p>
                                    <button class="more">+</button>
                                    <i class="bi bi-trash-fill trash"></i>
                            </div>
                            
                          </div>
                      
                        <div class="thirdColumn">
                            <p class="price" data-price="${card.price}">${card.price} € </p>
                        </div>
                     </div>`;
  });
} else {
  body.innerHTML = `<div class="bodyCart">
    <p>Votre panier est vide, ajoutez des articles à votre panier en cliquant sur les boutons 'Ajouter au panier'.</p>
    </div>;`;
}

const bodyCart = document.querySelectorAll("bodyCart");

const btnMore = document.querySelectorAll(".more");

const btnLess = document.querySelectorAll(".less");

let total = document.getElementById("total");

let allQuantity = document.querySelectorAll(".quantity");

let allPrice = document.querySelectorAll(".price");

const btnDeletes = document.querySelectorAll(".trash");

//----------------------------------------------------------
//        Evenement sur bouton + / Event on + button
//----------------------------------------------------------

//Augmenter de 1 le nbr d'article lors du click et multiplier par deux le prix
btnMore.forEach((btn, index) => {
  btn.addEventListener("click", () => {
    // Récupérer le prix initiale correspondant
    let unitPrice = parseFloat(allPrice[index].dataset.price);

    // Récupérer la qtt correspondante
    let quantity = allQuantity[index];
    // Récupérer le prix correspondant
    let price = allPrice[index];

    // Rendre visible le bouton de diminution
    btnLess[index].style.visibility = "visible";

    quantity.textContent = parseInt(quantity.textContent) + 1;
    price.textContent = unitPrice * quantity.textContent + " €";
    total.innerHTML = totalPrice();
  });
});

btnLess.forEach((btn, index) => {
  btn.addEventListener("click", () => {
    let unitPrice = parseFloat(allPrice[index].dataset.price);
    let quantity = allQuantity[index];
    let price = allPrice[index];

    let currentQuantity = parseInt(quantity.textContent); // Convertir en nombre pour la manipulation

    if (currentQuantity == 1) {
      // Réinitialiser la quantité à 0
      quantity.textContent = 0;
      // Masquer le bouton si la quantité est 1
      btnLess[index].style.visibility = "hidden";
    } else {
      // Décrémenter la quantité et afficher le bouton
      quantity.textContent = currentQuantity - 1;
      btnLess[index].style.visibility = "visible";
    }

    price.textContent = unitPrice * quantity.textContent + " €";
    total.innerHTML = totalPrice();
  });
});

//---------------------------------------------------------------------------------------
//    Mise en place du prix total des articles / Setting up the total price of items
//---------------------------------------------------------------------------------------

function totalPrice() {
  let total = 0; // Initialiser la somme à 0

  allPrice.forEach((price) => {
    // Convertir le texte en nombre
    const currentPrice = parseFloat(price.textContent);

    // Vérifier que c'est un nombre valide
    if (!isNaN(currentPrice)) {
      total += currentPrice; // Ajouter au total
    }
  });

  return total; // Retourner le total en tant que nombre
}

// Appeler la fonction et stocker le total
const sum = totalPrice();
console.log(sum + " €");
total.innerHTML = totalPrice() + " €";

function deleteArticle() {
  btnDeletes.forEach((btnDelete) => {
    btnDelete.addEventListener("click", (event) => {
      // Récupérer l'index de l'élément cliqué
      let index = event.target.getAttribute("data-index");

      // Supprimer l'élément du tableau stocké dans localStorage
      storedCardsCart.splice(index, 1);

      // Mettre à jour localStorage avec le nouveau tableau
      localStorage.setItem("cardsDataCart", JSON.stringify(storedCardsCart));

      // Supprimer l'élément du DOM (visuellement)
      event.target.closest(".bodyCart").remove();
      // Rafraîchir la page pour mettre à jour le total
      location.reload();
    });
  });
}
deleteArticle();
// function deleteArticle(index) {
//   // Supprimer l'élément du tableau stocké dans localStorage
//   storedCardsCart.splice(index, 1);

//   // Mettre à jour localStorage avec le nouveau tableau
//   localStorage.setItem("cardsDataCart", JSON.stringify(storedCardsCart));

//   // Supprimer l'élément du DOM (visuellement)
//   document.querySelectorAll(".bodyCart")[index].remove();

//   // Mise à jour du total
//   total.innerHTML = totalPrice();
// }
