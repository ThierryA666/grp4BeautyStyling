<<<<<<< HEAD
import * as data from './data-form-rendez-vous.js';

document.getElementById("button").addEventListener("click", controlSaisie);


// let prestaRv = document.getElementById("service");

// data.prestations.forEach(pres => {
//     prestaRv.innerHTML += ` <<option value=${pres.nom}, ${pres.description}>${pres.nom}, ${pres.description}</option>`;
// });
// console.log(prestaRv);

let salonRv = document.getElementById("salons");

data.salons.forEach(sal => {
    salonRv.innerHTML += ` <<option value=${sal.nomSalon}>${sal.nomSalon}</option>`;
});

let nouveauClient = [];
function donnees(){
    let fecha = new Date(document.getElementById('date').value);
    let fechaFormateada = fecha.toISOString().split('T')[0];
    let hora = document.getElementById('heure').value.slice(0, -2);
    let horaFormateada = hora + ":00";

    let client = {
        date: fechaFormateada,
        Heure: horaFormateada,
        // service: document.getElementById("service").value,
        detail: document.getElementById("detail").value,
        Nom: document.getElementById("nom").value,
        salon: document.getElementById("salons").value
    }
    form.reset();
    nouveauClient.push(client);
    // window.localStorage.setItem('form', JSON.stringify(form));  
    // window.location.href = 'historiquedesrendezvous.html';
    console.log(client);
// ligne 30 et 31 sont utilisés pour capturer les données et les envoyer à 'historiquedesrendezvous.html'
}
console.log(nouveauClient);

function controlSaisie(){
    let date = document.getElementById('date').value;
    let detail = document.getElementById('detail').value;

    let erreurSpan = document.getElementById('dateRv');
    let erreurSpan3 = document.getElementById('detailRv');

    if (date===Number(date)) {
        erreurSpan.innerHTML = "Une erreur s'est produite, tapez une date (Ex: 2024-06-12)";
        document.getElementById('date').focus;
    } 
    else if (date===""){
        erreurSpan.innerHTML = "Une erreur s'est produite, tapez une date (Ex: 15 Février 2024)";
        document.getElementById('date').focus;
    } 
    else if (detail===Number(detail)){
        erreurSpan3.innerHTML = "Une erreur s'est produite, tapez votre message";
        document.getElementById('detail').focus;
    } 
    else {
        donnees();
    }
}



// document.addEventListener("DOMContentLoaded", function() {
//     // Agregar un evento de escucha al formulario
//     document.getElementById("form").addEventListener("submit", function(event) {
//         // Evitar el envío del formulario por defecto
//         event.preventDefault();

//         // Obtener los datos del formulario
//         let formData = new FormData(this);

//         // Mostrar los datos en la consola para depuración
//         for (let [key, value] of formData.entries()) {
//             console.log(key + ": " + value);
//         }

//         // Enviar los datos al servidor utilizando Axios
//         axios.post("rendezvouscoteclient.php", formData)
//             .then(function(response) {
//                 // Manejar la respuesta del servidor
//                 console.log(response.data); // Mensaje de éxito o error devuelto por PHP
//                 alert(response.data); // Mostrar mensaje al usuario
//             })
//             .catch(function(error) {
//                 // Manejar errores de la solicitud
//                 console.error("Error:", error);
//                 alert("Error al enviar los datos del formulario");
//             });
//     });
// });

=======
import * as data from './data-form-rendez-vous.js';

document.getElementById("button").addEventListener("click", controlSaisie);


// let prestaRv = document.getElementById("service");

// data.prestations.forEach(pres => {
//     prestaRv.innerHTML += ` <<option value=${pres.nom}, ${pres.description}>${pres.nom}, ${pres.description}</option>`;
// });
// console.log(prestaRv);

let salonRv = document.getElementById("salons");

data.salons.forEach(sal => {
    salonRv.innerHTML += ` <<option value=${sal.nomSalon}>${sal.nomSalon}</option>`;
});

let nouveauClient = [];
function donnees(){
    let fecha = new Date(document.getElementById('date').value);
    let fechaFormateada = fecha.toISOString().split('T')[0];
    let hora = document.getElementById('heure').value.slice(0, -2);
    let horaFormateada = hora + ":00";

    let client = {
        date: fechaFormateada,
        Heure: horaFormateada,
        // service: document.getElementById("service").value,
        detail: document.getElementById("detail").value,
        Nom: document.getElementById("nom").value,
        salon: document.getElementById("salons").value
    }
    form.reset();
    nouveauClient.push(client);
    // window.localStorage.setItem('form', JSON.stringify(form));  
    // window.location.href = 'historiquedesrendezvous.html';
    console.log(client);
// ligne 30 et 31 sont utilisés pour capturer les données et les envoyer à 'historiquedesrendezvous.html'
}
console.log(nouveauClient);

function controlSaisie(){
    let date = document.getElementById('date').value;
    let detail = document.getElementById('detail').value;

    let erreurSpan = document.getElementById('dateRv');
    let erreurSpan3 = document.getElementById('detailRv');

    if (date===Number(date)) {
        erreurSpan.innerHTML = "Une erreur s'est produite, tapez une date (Ex: 2024-06-12)";
        document.getElementById('date').focus;
    } 
    else if (date===""){
        erreurSpan.innerHTML = "Une erreur s'est produite, tapez une date (Ex: 15 Février 2024)";
        document.getElementById('date').focus;
    } 
    else if (detail===Number(detail)){
        erreurSpan3.innerHTML = "Une erreur s'est produite, tapez votre message";
        document.getElementById('detail').focus;
    } 
    else {
        donnees();
    }
}



// document.addEventListener("DOMContentLoaded", function() {
//     // Agregar un evento de escucha al formulario
//     document.getElementById("form").addEventListener("submit", function(event) {
//         // Evitar el envío del formulario por defecto
//         event.preventDefault();

//         // Obtener los datos del formulario
//         let formData = new FormData(this);

//         // Mostrar los datos en la consola para depuración
//         for (let [key, value] of formData.entries()) {
//             console.log(key + ": " + value);
//         }

//         // Enviar los datos al servidor utilizando Axios
//         axios.post("rendezvouscoteclient.php", formData)
//             .then(function(response) {
//                 // Manejar la respuesta del servidor
//                 console.log(response.data); // Mensaje de éxito o error devuelto por PHP
//                 alert(response.data); // Mostrar mensaje al usuario
//             })
//             .catch(function(error) {
//                 // Manejar errores de la solicitud
//                 console.error("Error:", error);
//                 alert("Error al enviar los datos del formulario");
//             });
//     });
// });

>>>>>>> a6980d88292d460c429dea4d66edcf90a6e13bb2
