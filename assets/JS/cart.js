//------------------------------------------------------------------------------//
//--- Récupération des cards présentes dans le localStorage (cardsDataCart) ---//
//------------------------------------------------------------------------------//

const body = document.getElementById("body");
let storedCardsCart = JSON.parse(localStorage.getItem("cardsDataCart")) || [];
let storedLens = JSON.parse(localStorage.getItem("lensData")) || [];

body.innerHTML = "";

// Cartes
if (storedCardsCart.length > 0) {
  storedCardsCart.forEach((card, index) => {
    body.innerHTML += `
      <div class="bodyCart" data-type="card" data-index="${index}">
        <div class="secondColumn produits">
          <div class="img">
            <img src="${card.image}" alt="${card.name}">  
          </div>
          <div class="article">                        
            <span>Modèle : ${card.name}</span>
          </div>
          <div class="choiceQuantity">
            <button class="less">-</button>
            <p class="quantity">${card.quantity || 1}</p>
            <button class="more">+</button>
            <i class="bi bi-trash-fill trash" data-index="${index}"></i>
          </div>
        </div>
        <div class="thirdColumn">
          <p class="price" data-price="${card.price}">${
      card.price * (card.quantity || 1)
    } €</p>
        </div>
      </div>`;
  });
}

// Lentilles
if (storedLens.length > 0) {
  storedLens.forEach((lens, index) => {
    const pricePerUnit = 15;
    const totalPriceLens = pricePerUnit * lens.quantity;

    body.innerHTML += `
      <div class="bodyCart" data-type="lens" data-index="${index}">
        <div class="secondColumn produits">
          <div class="img">
            <img src="/assets/img/boite-lentille.png" alt="total one lens">  
          </div>
          <div class="article">                                                                     
            <span>Correction OD : ${lens.correctionOD}</span>
            <span>Correction OG : ${lens.correctionOG}</span>
            <span>Modèle : Total one</span>                                 
          </div>
          <div class="choiceQuantity">
            <button class="less">-</button>
            <p class="quantity">${lens.quantity}</p>
            <button class="more">+</button>
            <i class="bi bi-trash-fill trash" data-index="${index}"></i>
          </div>
        </div>
        <div class="thirdColumn">
          <p class="price" data-price="${pricePerUnit}">${totalPriceLens} €</p>
        </div>
      </div>`;
  });
}

// Si panier vide
if (storedLens.length === 0 && storedCardsCart.length === 0) {
  body.innerHTML = `
    <div class="emptyCart">
      <p>🛒 Votre panier est vide, ajoutez des articles en cliquant sur 'Ajouter au panier'. 🛒</p>
    </div>`;
}

//-----------------------------------------------------------------------------//
//--------------------- GESTION INTERACTIVE DU PANIER ------------------------//
//-----------------------------------------------------------------------------//

setTimeout(() => {
  const btnMore = document.querySelectorAll(".more");
  const btnLess = document.querySelectorAll(".less");
  const btnDeletes = document.querySelectorAll(".trash");
  const total = document.getElementById("total");

  const allQuantity = () => document.querySelectorAll(".quantity");
  const allPrice = () => document.querySelectorAll(".price");

  function totalPrice() {
    let totalAmount = 0;
    allPrice().forEach((price) => {
      const current = parseFloat(price.textContent);
      if (!isNaN(current)) totalAmount += current;
    });
    return totalAmount;
  }

  function totalItems() {
    let totalQuantity = 0;
    allQuantity().forEach((q) => {
      const val = parseFloat(q.textContent);
      if (!isNaN(val)) totalQuantity += val;
    });
    return totalQuantity;
  }

  function updateTotalDisplay() {
    if (total) {
      total.innerHTML = totalPrice() + " €";
    }
  }

  // Fonction qui met à jour le nombre total d'articles dans le panier
  function updateCartCountDisplay() {
    const totalInCart = totalItems(); // On recalcul le nombre total d'articles
    localStorage.setItem("totalInCart", JSON.stringify(totalInCart)); // Sauvegarder dans le localStorage

    // Mettre à jour l'affichage du nombre d'articles dans le panier
    const articleCountElements = document.querySelectorAll(
      ".nbrArticle, .nbrArticleBurger"
    );
    articleCountElements.forEach((el) => (el.textContent = totalInCart));
  }

  function deleteArticle() {
    btnDeletes.forEach((btnDelete) => {
      btnDelete.addEventListener("click", (event) => {
        const index = event.target.getAttribute("data-index");
        const cartItem = event.target.closest(".bodyCart");

        // Afficher la popup de confirmation avec SweetAlert2
        Swal.fire({
          title: "Voulez-vous vraiment supprimer cet article ?",
          text: "La quantité atteindra zéro si vous continuez.",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Oui, supprimer",
          cancelButtonText: "Annuler",
          reverseButtons: true,
          customClass: {
            popup: "custom-swal", // doit correspondre à ton .swal2-popup.custom-swal
            icon: "custom-icon", // pour appliquer couleurs à .swal2-icon
            confirmButton: "custom-confirm-btn",
            cancelButton: "custom-cancel-btn",
          },
        }).then((result) => {
          if (result.isConfirmed) {
            // Supprimer l'article des tableaux (selon le type)
            if (cartItem.dataset.type === "card") {
              storedCardsCart.splice(index, 1);
            } else {
              storedLens.splice(index, 1);
            }

            // Mettre à jour le localStorage
            localStorage.setItem(
              "cardsDataCart",
              JSON.stringify(storedCardsCart)
            );
            localStorage.setItem("lensData", JSON.stringify(storedLens));

            // Supprimer l'élément du DOM
            cartItem.remove();

            // Vérification si le panier est vide
            if (storedCardsCart.length === 0 && storedLens.length === 0) {
              body.innerHTML = `
                <div class="emptyCart">
                  <p>🛒 Votre panier est vide, ajoutez des articles en cliquant sur 'Ajouter au panier'. 🛒</p>
                </div>`;
            }

            // Mettre à jour le nombre d'articles dans le panier
            updateCartCountDisplay();

            // Afficher une confirmation de suppression
            Swal.fire({
              title: "Supprimé !",
              text: "L'article a été supprimé de votre panier.",
              icon: "success",
              confirmButtonText: "OK",
              customClass: {
                popup: "custom-swal",
                icon: "custom-icon",
                confirmButton: "custom-confirm-btn",
              },
            });
          }
        });
      });
    });
  }

  // Mettre à jour la quantité et gérer l'ajout/retrait de quantité
  btnMore.forEach((btn, index) => {
    btn.addEventListener("click", () => {
      const cartItem = btn.closest(".bodyCart");
      const type = cartItem.dataset.type;
      const i = parseInt(cartItem.dataset.index);
      const quantity = cartItem.querySelector(".quantity");
      const price = cartItem.querySelector(".price");
      const unitPrice = parseFloat(price.dataset.price);

      let newQty = parseInt(quantity.textContent) + 1;
      quantity.textContent = newQty;
      price.textContent = unitPrice * newQty + " €";

      updateStorage(type, i, newQty);
      updateCartCountDisplay();
      updateTotalDisplay();
    });
  });

  // Gestion du bouton "moins"
  btnLess.forEach((btn, index) => {
    btn.addEventListener("click", () => {
      const cartItem = btn.closest(".bodyCart");
      const type = cartItem.dataset.type;
      const i = parseInt(cartItem.dataset.index);
      const quantity = cartItem.querySelector(".quantity");
      const price = cartItem.querySelector(".price");
      const unitPrice = parseFloat(price.dataset.price);

      let currentQty = parseInt(quantity.textContent);
      let newQty = currentQty - 1;

      if (newQty <= 0) {
        // Affichage de la confirmation avec SweetAlert2
        Swal.fire({
          title: "Voulez-vous vraiment supprimer cet article ?",
          text: "La quantité atteindra zéro si vous continuez.",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Oui, supprimer",
          cancelButtonText: "Annuler",
          reverseButtons: true,
          customClass: {
            popup: "custom-swal", // doit correspondre à ton .swal2-popup.custom-swal
            icon: "custom-icon", // pour appliquer couleurs à .swal2-icon
            confirmButton: "custom-confirm-btn",
            cancelButton: "custom-cancel-btn",
          },
        }).then((result) => {
          if (result.isConfirmed) {
            // Supprimer de la source de données
            if (type === "card") storedCardsCart.splice(i, 1);
            else storedLens.splice(i, 1);

            // Mettre à jour le localStorage
            localStorage.setItem(
              "cardsDataCart",
              JSON.stringify(storedCardsCart)
            );
            localStorage.setItem("lensData", JSON.stringify(storedLens));

            // Supprimer du DOM
            cartItem.remove();

            // Vérification panier vide
            if (storedCardsCart.length === 0 && storedLens.length === 0) {
              body.innerHTML = `
                <div class="emptyCart">
                  <p>🛒 Votre panier est vide, ajoutez des articles en cliquant sur 'Ajouter au panier'. 🛒</p>
                </div>`;
            }

            // Affichage d'une confirmation de suppression
            Swal.fire({
              title: "Supprimé !",
              text: "L'article a été supprimé de votre panier.",
              icon: "success",
              confirmButtonText: "OK",
              customClass: {
                popup: "custom-swal",
                icon: "custom-icon",
                confirmButton: "custom-confirm-btn",
              },
            });
          }
        });
      } else {
        // Mise à jour de la quantité et du prix
        quantity.textContent = newQty;
        price.textContent = unitPrice * newQty + " €";
        updateStorage(type, i, newQty);
      }

      updateCartCountDisplay();
      updateTotalDisplay();
    });
  });

  function updateStorage(type, index, quantity) {
    if (type === "card") {
      storedCardsCart[index].quantity = quantity;
      localStorage.setItem("cardsDataCart", JSON.stringify(storedCardsCart));
    } else {
      storedLens[index].quantity = quantity;
      localStorage.setItem("lensData", JSON.stringify(storedLens));
    }
  }

  // Appel de la fonction deleteArticle pour gérer la suppression
  deleteArticle();

  updateTotalDisplay();
  updateCartCountDisplay(); // Initialiser l'affichage du nombre d'articles
}, 0);
