// const currentMonthDisplay = document.getElementById("currentMonth");
// const prevMonthButton = document.getElementById("prevMonth");
// const nextMonthButton = document.getElementById("nextMonth");
// let dayChoice = "";
// let currentDate = new Date();

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

// function updateMonthDisplay() {
//   currentMonthDisplay.innerHTML = `${
//     monthNames[currentDate.getMonth()]
//   } ${currentDate.getFullYear()}`;
// }

//-------------------------------------//
// Fonction pour créer le calendrier--//
//-----------------------------------//

// function createCalendar(month, year) {
//   const thead = document.getElementById("thead");
//   const tbody = document.getElementById("tbody");

//----------------------//
// Vide le calendrier--//
//--------------------//

//   thead.innerHTML = "";
//   tbody.innerHTML = "";

//   //------------------------------------------------//
//   // Ajouter les en-têtes des jours de la semaine--//
//   //----------------------------------------------//

//   const daysOfWeek = ["Lun", "Mar", "Mer", "Jeu", "Ven", "Sam", "Dim"];
//   let headerRow = document.createElement("tr");
//   daysOfWeek.forEach((day) => {
//     let th = document.createElement("th");
//     th.innerText = day;
//     headerRow.appendChild(th);
//   });
//   thead.appendChild(headerRow);

//-----------------------------//
// Générer les jours du mois--//
//---------------------------//

//   const daysInMonth = new Date(year, month + 1, 0).getDate();
//   let firstDay = new Date(year, month, 1).getDay();
//   firstDay = firstDay === 0 ? 6 : firstDay - 1;

//   let date = 1;

//   //créer une ligne pour chaque semaine
//   for (let i = 0; i < 6; i++) {
//     let week = document.createElement("tr");

//     // Créer des cases pour chaque jour
//     for (let j = 0; j < 7; j++) {
//       let day = document.createElement("td");

//       if (i === 0 && j < firstDay) {
//         week.appendChild(day); // Cellule vide avant le début du mois
//       } else if (date > daysInMonth) {
//         week.appendChild(day); // Cellule vide après la fin du mois
//       } else {
//         day.innerText = date;
//         if (j == 0) {
//           day.classList.add("monday"); // Ajouter une classe spéciale aux lundis
//         } else {
//           day.style.opacity = 0.6; // Appliquer l'opacité sur les jours non prioritaires
//         }
//         week.appendChild(day);
//         date++;
//       }
//     }
//     tbody.appendChild(week);
//   }
const mondays = document.querySelectorAll(".monday");
mondays.forEach((monday) => {
  monday.addEventListener("click", () => {
    mondays.forEach((m) => {
      if (m.classList.contains("active")) {
        m.classList.remove("active");
      }
    });
    dayChoice = monday.innerText;
    mondays.innerText = date;
    monday.classList.add("active");
  });
});
//}

//--------------------------------------------------------//
// Gérer les boutons "Mois Précédent" et "Mois Suivant"--//
//------------------------------------------------------//

// prevMonthButton.addEventListener("click", () => {
//   currentDate.setMonth(currentDate.getMonth() - 1);
//   updateMonthDisplay();
//   createCalendar(currentDate.getMonth(), currentDate.getFullYear());
// });

// nextMonthButton.addEventListener("click", () => {
//   currentDate.setMonth(currentDate.getMonth() + 1);
//   updateMonthDisplay();
//   createCalendar(currentDate.getMonth(), currentDate.getFullYear());
// });

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

// document
//   .querySelector(".buttonFooter:last-child")
//   .addEventListener("click", () => {
//     dateChoisi.innerText = `${dayChoice} ${
//       monthNames[currentDate.getMonth()]
//     } ${currentDate.getFullYear()} `;
//   });

//-----------------------------//
// ----- Btn prendre RDV -----//
//---------------------------//
const makeAppointment = document.getElementById("makeAppointment");

makeAppointment.addEventListener("click", () => {
  const appointmentDate = dateChoisi.innerText;
});

//-----------------------------//
// Initialiser l'affichage----//
//---------------------------//

// updateMonthDisplay();
// createCalendar(currentDate.getMonth(), currentDate.getFullYear());
