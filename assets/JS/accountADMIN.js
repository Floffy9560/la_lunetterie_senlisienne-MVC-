/*------------------------------------*/
/*              nom                */
/*------------------------------------*/

let lastname = localStorage.getItem("lastname");

const accountLastname = document.getElementById("accountLastname");

accountLastname.innerHTML = `<input type="text"  placeholder="${lastname}" readonly>`;

/*------------------------------------*/
/*              prénom                */
/*------------------------------------*/

let firstname = localStorage.getItem("firstname");

const accountFirstname = document.getElementById("accountFirstname");

accountFirstname.innerHTML = `<input type="text" placeholder="${firstname}" readonly>`;

/*------------------------------------*/
/*                tel                 */
/*------------------------------------*/

let tel = localStorage.getItem("tel");

const accountTel = document.getElementById("accountTel");

accountTel.innerHTML = `<input type="text"  placeholder="${tel}" readonly>`;

/*------------------------------------*/
/*               email                */
/*------------------------------------*/

let email = localStorage.getItem("email");

const accountEmail = document.getElementById("accountEmail");

accountEmail.innerHTML = `<input type="email" placeholder="${email}" readonly>`;

/*------------------------------------*/
/*             password               */
/*------------------------------------*/

let password = localStorage.getItem("password");

const accountPassword = document.getElementById("accountPassword");

accountPassword.innerHTML = `<input type="password"  placeholder="${password}">`;

/*------------------------------------*/
/*              adress                */
/*------------------------------------*/

let adress = localStorage.getItem("adress");

const accountAdress = document.getElementById("accountAdress");

accountAdress.innerHTML = `<textarea  placeholder="${adress}" readonly>`;
