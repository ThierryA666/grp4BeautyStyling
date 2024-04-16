<<<<<<< HEAD
import * as data from './data-rendez-vous.js';

document.getElementById("button2").addEventListener("click", suprimer);
let detailsRv = document.getElementById("rendez-vous");

data.clients.forEach(reservation => {
    detailsRv.innerHTML += `<ul id="selection" class="list-group">
                                <li class="list-group-item ps-5 pt-3"> 
                                  ${reservation.date}, ${reservation.heure}, ${reservation.services}, ${reservation.details}, ${reservation.client} 
                                </li>
                            </ul>`;
});

let elements = document.querySelectorAll("li");

elements.forEach((element) => {
    element.addEventListener('click', function() {
        this.classList.toggle('active');
    });
});

function suprimer(){
   detailsRv.removeChild(detailsRv.children[0]);
}

// let form2 = JSON.parse(window.localStorage.getItem('form'));

// console.log(form2);

=======
import * as data from './data-rendez-vous.js';

document.getElementById("button2").addEventListener("click", suprimer);
let detailsRv = document.getElementById("rendez-vous");

data.clients.forEach(reservation => {
    detailsRv.innerHTML += `<ul id="selection" class="list-group">
                                <li class="list-group-item ps-5 pt-3"> 
                                  ${reservation.date}, ${reservation.heure}, ${reservation.services}, ${reservation.details}, ${reservation.client} 
                                </li>
                            </ul>`;
});

let elements = document.querySelectorAll("li");

elements.forEach((element) => {
    element.addEventListener('click', function() {
        this.classList.toggle('active');
    });
});

function suprimer(){
   detailsRv.removeChild(detailsRv.children[0]);
}

// let form2 = JSON.parse(window.localStorage.getItem('form'));

// console.log(form2);

>>>>>>> a6980d88292d460c429dea4d66edcf90a6e13bb2
// ligne 26 et 28 sert à recevoir les données du formulaire et à les afficher via la console