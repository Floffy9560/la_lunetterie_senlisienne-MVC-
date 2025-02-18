const currentMonthDisplay = document.getElementById("currentMonth");
const prevMonthButton = document.getElementById("prevMonth");
const nextMonthButton = document.getElementById("nextMonth");
let dayChoice = "";
let currentDate = new Date();

//-----------------------------//
// Tableau des noms des mois--//
//---------------------------//

const monthNames = [
  "Janvier",
  "Février",
  "Mars",
  "Avril",
  "Mai",
  "Juin",
  "Juillet",
  "Août",
  "Septembre",
  "Octobre",
  "Novembre",
  "Décembre",
];

//------------------------------------------------//
// Met à jour l'affichage du mois et de l'année--//
//----------------------------------------------//

function updateMonthDisplay() {
  currentMonthDisplay.innerHTML = `${
    monthNames[currentDate.getMonth()]
  } ${currentDate.getFullYear()}`;
}

//-------------------------------------//
// Fonction pour créer le calendrier--//
//-----------------------------------//

function createCalendar(month, year) {
  const thead = document.getElementById("thead");
  const tbody = document.getElementById("tbody");

  //----------------------//
  // Vide le calendrier--//
  //--------------------//

  thead.innerHTML = "";
  tbody.innerHTML = "";

  //------------------------------------------------//
  // Ajouter les en-têtes des jours de la semaine--//
  //----------------------------------------------//

  const daysOfWeek = ["Lun", "Mar", "Mer", "Jeu", "Ven", "Sam", "Dim"];
  let headerRow = document.createElement("tr");
  daysOfWeek.forEach((day) => {
    let th = document.createElement("th");
    th.innerText = day;
    headerRow.appendChild(th);
  });
  thead.appendChild(headerRow);

  //-----------------------------//
  // Générer les jours du mois--//
  //---------------------------//

  const daysInMonth = new Date(year, month + 1, 0).getDate();
  let firstDay = new Date(year, month, 1).getDay();
  firstDay = firstDay === 0 ? 6 : firstDay - 1;

  let date = 1;

  //créer une ligne pour chaque semaine
  for (let i = 0; i < 6; i++) {
    let week = document.createElement("tr");

    //créer des case pour chaque jours
    for (let j = 0; j < 7; j++) {
      let day = document.createElement("td");
      if (i === 0 && j < firstDay) {
        week.appendChild(day); // Cellule vide
      } else if (date > daysInMonth) {
        week.appendChild(day); // Cellule vide
      } else {
        day.innerText = date; // Insère la date
        week.appendChild(day);
        day.addEventListener("click", (e) => {
          console.log(e);
          if (j == 0) {
            dayChoice = e.target.innerText;
            day.style.background = "green";
          }
        });
        date++;
      }
      if (j > 0) {
        day.style.opacity = 0.5;
      }
    }
    tbody.appendChild(week);
  }
}

//--------------------------------------------------------//
// Gérer les boutons "Mois Précédent" et "Mois Suivant"--//
//------------------------------------------------------//

prevMonthButton.addEventListener("click", () => {
  currentDate.setMonth(currentDate.getMonth() - 1);
  updateMonthDisplay();
  createCalendar(currentDate.getMonth(), currentDate.getFullYear());
});

nextMonthButton.addEventListener("click", () => {
  currentDate.setMonth(currentDate.getMonth() + 1);
  updateMonthDisplay();
  createCalendar(currentDate.getMonth(), currentDate.getFullYear());
});

//-----------------------//
// Bouton Réinitialisé--//
//---------------------//

document
  .querySelector(".buttonFooter:first-child")
  .addEventListener("click", () => {
    currentDate = new Date();
    updateMonthDisplay();
    createCalendar(currentDate.getMonth(), currentDate.getFullYear());
    dateChoisi.innerText = "";
  });

//---------------//
// Bouton Ok----//
//-------------//

document
  .querySelector(".buttonFooter:last-child")
  .addEventListener("click", () => {
    dateChoisi.innerText = `${dayChoice} ${
      monthNames[currentDate.getMonth()]
    } `;
  });

//-----------------------------//
// Initialiser l'affichage----//
//---------------------------//

updateMonthDisplay();
createCalendar(currentDate.getMonth(), currentDate.getFullYear());
