const btnMore = document.querySelectorAll(".more");

const btnLess = document.querySelectorAll(".less");

let total = document.getElementById("total");

let allPrice = document.querySelectorAll(".price");

let allQuantity = document.querySelectorAll(".quantity");

//---------------------------------------------------------------------------------------
//    Mise en place du prix total des articles / Setting up the total price of items
//---------------------------------------------------------------------------------------

function totalPrice() {
  let totalPrice = 0; // Initialiser le total

  allPrice.forEach((p) => {
    // Convertir le texte en nombre et l'ajouter au total
    const currentPrice = parseFloat(p.textContent); // Convertir en nombre (float)

    // Vérifier que c'est un nombre'
    if (!isNaN(currentPrice)) {
      totalPrice += currentPrice;
    }
  });

  return "Prix total :", totalPrice;
}
total.innerHTML = totalPrice();

// let BodyKart = document.querySelectorAll(".bodyKart");

// BodyKart.forEach((currentBodyKart) => {
//   return currentBodyKart.innerHTML;
// });

//----------------------------------------------------------
//        Evenement sur bouton + / Event on + button
//----------------------------------------------------------
let bdd = [];
fetch("/assets/datas/glasses.json")
  .then((response) => response.json()) // Convertir la réponse en JSON

  .then((glasses) => {
    glasses.forEach((glass, index) => {
      bdd.push(glass);
    });
  });
console.log(bdd);
//Augmenter de 1 le nbr d'article lors du click et multiplier par deux le prix

btnMore.forEach((btn, index) => {
  btn.addEventListener("click", () => {
    let quantity = allQuantity[index]; // Get corresponding quantity
    let price = allPrice[index]; // Get corresponding price

    quantity.textContent = parseFloat(quantity.textContent) + 1;
    price.textContent =
      parseFloat(price.textContent) + currentPrice.textContent + "€";
  });
});

btnLess.forEach((btn, index) => {
  btn.addEventListener("click", () => {
    let quantity = allQuantity[index];
    let price = allPrice[index];
    quantity.textContent = parseFloat(quantity.textContent) - 1;
    price.textContent = parseFloat(price.textContent) / 2;
  });
});
