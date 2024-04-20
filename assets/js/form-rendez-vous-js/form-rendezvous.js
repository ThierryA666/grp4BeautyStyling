<<<<<<< HEAD
import * as data from './data-form-rendez-vous.js';

document.getElementById("button").addEventListener("click", controlSaisie);


let prestaRv = document.getElementById("service");

data.prestations.forEach(pres => {
    prestaRv.innerHTML += ` <<option value=${pres.nom}, ${pres.description}>${pres.nom}, ${pres.description}</option>`;
});
// console.log(prestaRv);

let salonRv = document.getElementById("salons");

data.salons.forEach(sal => {
    salonRv.innerHTML += ` <<option value=${sal.nomSalon}>${sal.nomSalon}</option>`;
});

let nouveauClient = [];
function donnees(){
    let client = {
        date: document.getElementById('date').value,
        Heure: document.getElementById('heure').value,
        service: document.getElementById("service").value,
        detail: document.getElementById("detail").value,
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

    if (date=Number(date)) {
        erreurSpan.innerHTML = "Une erreur s'est produite, tapez une date (Ex: 15 Février 2024)";
        document.getElementById('date').focus;
    } 
    else if (date=""){
        erreurSpan.innerHTML = "Une erreur s'est produite, tapez une date (Ex: 15 Février 2024)";
        document.getElementById('date').focus;
    } 
    else if (detail=Number(detail)){
        erreurSpan3.innerHTML = "Une erreur s'est produite, tapez votre message";
        document.getElementById('detail').focus;
    } 
    else {
        donnees();
    }
=======
import * as data from './data-form-rendez-vous.js';

document.getElementById("button").addEventListener("click", controlSaisie);


let prestaRv = document.getElementById("service");

data.prestations.forEach(pres => {
    prestaRv.innerHTML += ` <<option value=${pres.nom}, ${pres.description}>${pres.nom}, ${pres.description}</option>`;
});
// console.log(prestaRv);

let salonRv = document.getElementById("salons");

data.salons.forEach(sal => {
    salonRv.innerHTML += ` <<option value=${sal.nomSalon}>${sal.nomSalon}</option>`;
});

let nouveauClient = [];
function donnees(){
    let client = {
        date: document.getElementById('date').value,
        Heure: document.getElementById('heure').value,
        service: document.getElementById("service").value,
        detail: document.getElementById("detail").value,
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

    if (date=Number(date)) {
        erreurSpan.innerHTML = "Une erreur s'est produite, tapez une date (Ex: 15 Février 2024)";
        document.getElementById('date').focus;
    } 
    else if (date=""){
        erreurSpan.innerHTML = "Une erreur s'est produite, tapez une date (Ex: 15 Février 2024)";
        document.getElementById('date').focus;
    } 
    else if (detail=Number(detail)){
        erreurSpan3.innerHTML = "Une erreur s'est produite, tapez votre message";
        document.getElementById('detail').focus;
    } 
    else {
        donnees();
    }
>>>>>>> b3737144e9af770f87c5acb1ac273df8b56038c9
}