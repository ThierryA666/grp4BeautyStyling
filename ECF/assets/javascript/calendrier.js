let monthNames = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre','Octobre', 'Novembre', 'Décembre'];

let currentDate = new Date(); //pour prendre la date de l'ordinateur comme référence
let currentDay = currentDate.getDate();  //pour obtenir le jour de la semaine
let monthNumber = currentDate.getMonth();  //pour obtenir un nombre compris entre 0 et 11. 0 correspond à janvier et 11 à décembre
let currentYear = currentDate.getFullYear();

let dates = document.getElementById('dates');
let month = document.getElementById('month');
let year = document.getElementById('year');

let prevMonthDOM = document.getElementById('prev-month'); 
let nextMonthDOM = document.getElementById('next-month');

// pour afficher le mois et l'année sans avoir à les taper dans le code HTML:
month.textContent = monthNames[monthNumber];
year.textContent = currentYear.toString();  // on utilise toString parce que currentYear est un nombre et il faut le convertir en string

prevMonthDOM.addEventListener('click', ()=>lastMonth());
nextMonthDOM.addEventListener('click', ()=>nextMonth());


// fonction pour écrire les mois
const writeMonth = (month) => {

    for(let i = startDay(); i>0;i--){ //pour éviter que le 1er de chaque mois soit toujours un lundi
        dates.innerHTML += ` <div class="calendar__date calendar__item calendar__last-days">
            ${getTotalDays(monthNumber-1)-(i-1)}
        </div>`;
    }

    for(let i=1; i<=getTotalDays(month); i++){
        if(i===currentDay) { //pour que je sache que c'est aujourd'hui et que je puisse le marquer différemment avec css
            dates.innerHTML += ` <div class="calendar__date calendar__item calendar__today">${i}</div>`;
        }else{
            dates.innerHTML += ` <div class="calendar__date calendar__item">${i}</div>`;
        }
    }
}

// fonction pour écrire les jours de chaque mois
const getTotalDays = month => {
    if(month === -1) month = 11;

    if (month == 0 || month == 2 || month == 4 || month == 6 || month == 7 || month == 9 || month == 11) {
        return  31;

    } else if (month == 3 || month == 5 || month == 8 || month == 10) {
        return 30;

    } else {

        return isLeap() ? 29:28;
    }
}

// fonction pour savoir si l'année est bissextile ou non.
//Si A n'est pas divisible par 4, l'année n'est pas bissextile. 
//Si A est divisible par 4, l'année est bissextile sauf si A est divisible par 100 et pas par 400
const isLeap = () => {
    return ((currentYear % 100 !==0) && (currentYear % 4 === 0) || (currentYear % 400 === 0));
} // si return est true l'année est bissextile


// pour savoir quel jour de la semaine commence
const startDay = () => {
    let start = new Date(currentYear, monthNumber, 1); //pour créer une nouvelle date et savoir quel jour tombe le 1er du mois
    return ((start.getDay()-1) === -1) ? 6 : start.getDay()-1; // la référence est le calendrier anglo-saxon (0 pour le dimanche et 6 pour le samedi). 
} // si return est -1 (si le jour -1 n'existe pas) on le dire que return est 6 c'est dimanche. Et si n'est pas dimanche ( start.getDay()-1)


// est chargé d'écrire le mois précédent
const lastMonth = () => {
    if(monthNumber !== 0){
        monthNumber--;
    }else{
        monthNumber = 11;
        currentYear--;
    }

    setNewDate();
}

// est chargé d'écrire le mois suivant
const nextMonth = () => {
    if(monthNumber !== 11){
        monthNumber++;
    }else{
        monthNumber = 0;
        currentYear++;
    }

    setNewDate();
}

// pour définir la nouvelle date lors du déplacement du calendrier
const setNewDate = () => {
    currentDate.setFullYear(currentYear,monthNumber,currentDay);
    month.textContent = monthNames[monthNumber];
    year.textContent = currentYear.toString();
    dates.textContent = ''; // pour éviter qu'on n'affiche le mois sans effacer le précédent
    writeMonth(monthNumber);
}

writeMonth(monthNumber);