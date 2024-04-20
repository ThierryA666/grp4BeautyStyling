<<<<<<< HEAD
import * as data from "./data.js";
console.log(data.salons);


let search = window.location.search;
console.dir(search);
let link = search.split("=");
console.dir(link);
let salonID =link[1]
console.log(salonID);

let modifName = document.getElementById("modifName");
let modifFirstName= document.getElementById("modifFirstName");
let modifAddress1 = document.getElementById("modifAddress1");
let modifEmail = document.getElementById("modifEmail");
let modifAddress2 = document.getElementById("modifAddress2");
let modifTel = document.getElementById("modifTel");
let modifZip = document.getElementById("modifZip");
let modifCity = document.getElementById("modifCity");
let modifSalon = document.getElementById("modifSalon");
let modifURL = document.getElementById("modifURL");
let modifPW = document.getElementById("modifPW");

let registeredPhoto = document.getElementById("registeredPhoto");
const chk = document.getElementById("chk");
const btnModif = document.getElementById("btnModif");
const btnEnregist = document.getElementById("btnEnregist");

// afficher le password avec check box
chk.addEventListener("change", function () {
    if (chk.checked) {
        modifPW.type = "text";
    } else {
        modifPW.type = "password";
    }
  });

//Afficher le data du salon
// window.addEventListener('load',(event)=>{
//     event.preventDefault();
    let salonModif = data.salons.filter(salon=>salon.id==salonID)
    console.dir(salonModif);
    salonModif.forEach(item =>{
        console.log(item.nom)
        modifName.value = item.nom;
        modifFirstName.value = item.prenom;
        modifAddress1.value = item.ad1;
        modifAddress2.value = item.ad2;
        modifTel.value = item.tel;
        modifZip.value = item.codePostale;
        modifCity.value = item.ville;
        modifSalon.value = item.nomSalon;
        modifEmail.value = item.email;
        modifURL.value = item.url;
        registeredPhoto.innerHTML =`<img src="/assets/img/photos-salon/${item.photo}" width="250">` ;
        modifPW.value = item.motDePasse;
    })
// });
<<<<<<< HEAD
document.getElementById('btnModif').addEventListener('click', function(event) {
    
    event.preventDefault();
    // enregitrer le nom button
    recordButtonClick('modif');
    // debloquer input
    enableInputFields();
});

// "Enregistrer" ボタンがクリックされたときの処理
document.getElementById('btnEnregist').addEventListener('click', function(event) {
    //
    event.preventDefault();
    //  enregitrer le nom button
    recordButtonClick('update');
    // envoyer le formulaire
    document.getElementById('myForm').submit();
});

// debloquer le champ input
function enableInputFields() {
=======

//button "Modifier"
btnModif.addEventListener("click",(event)=>{
    event.preventDefault();
>>>>>>> e20c71f85c7dde591e2707ad515e9f8256716d3a
    modifName.disabled = false;
    modifFirstName.disabled = false;
    modifAddress1.disabled = false;
    modifAddress2.disabled = false;
    modifTel.disabled = false;
    modifZip.disabled = false;
    modifCity.disabled = false;
    modifEmail.disabled = false;
    modifURL.disabled = false;
    modifPhoto.disabled = false;
    modifPW.disabled = false;
    btnEnregist.disabled = false;
<<<<<<< HEAD
}

// quand le button est clique
function recordButtonClick(buttonName) {
    // enregistre le nom de button
    document.getElementById('clickedButton').value = buttonName;
}


=======
})
>>>>>>> e20c71f85c7dde591e2707ad515e9f8256716d3a

//button "Enregistrer"
btnEnregist.addEventListener("click",(event)=>{
    event.preventDefault();
    salonModif.forEach(item =>{
        item.nom = modifName.value;
        item.prenom = modifFirstName.value;
        item.ad1= modifAddress1.value;
        item.ad2 = modifAddress2.value;
        item.tel =  modifTel.value;
        item.codePostale = modifZip.value;
        item.ville = modifCity.value;
        // modifSalon.value;
        item.email = modifEmail.value;
        item.url = modifURL.value;
        let newPhoto = document.getElementById("modifPhoto").files[0].name
        registeredPhoto.innerHTML =`<img src="${modifPhoto}" width="250">` ;
        item.photo = newPhoto
        item.motDePasse = modifPW.value;
        console.log(salonModif);    
    });
});

=======
import * as data from "./data.js";
console.log(data.salons);


let search = window.location.search;
console.dir(search);
let link = search.split("=");
console.dir(link);
let salonID =link[1]
console.log(salonID);

let modifName = document.getElementById("modifName");
let modifFirstName= document.getElementById("modifFirstName");
let modifAddress1 = document.getElementById("modifAddress1");
let modifEmail = document.getElementById("modifEmail");
let modifAddress2 = document.getElementById("modifAddress2");
let modifTel = document.getElementById("modifTel");
let modifZip = document.getElementById("modifZip");
let modifCity = document.getElementById("modifCity");
let modifSalon = document.getElementById("modifSalon");
let modifURL = document.getElementById("modifURL");
let modifPW = document.getElementById("modifPW");

let registeredPhoto = document.getElementById("registeredPhoto");
const chk = document.getElementById("chk");
const btnModif = document.getElementById("btnModif");
const btnEnregist = document.getElementById("btnEnregist");

// afficher le password avec check box
chk.addEventListener("change", function () {
    if (chk.checked) {
        modifPW.type = "text";
    } else {
        modifPW.type = "password";
    }
  });

//Afficher le data du salon
// window.addEventListener('load',(event)=>{
//     event.preventDefault();
    let salonModif = data.salons.filter(salon=>salon.id==salonID)
    console.dir(salonModif);
    salonModif.forEach(item =>{
        console.log(item.nom)
        modifName.value = item.nom;
        modifFirstName.value = item.prenom;
        modifAddress1.value = item.ad1;
        modifAddress2.value = item.ad2;
        modifTel.value = item.tel;
        modifZip.value = item.codePostale;
        modifCity.value = item.ville;
        modifSalon.value = item.nomSalon;
        modifEmail.value = item.email;
        modifURL.value = item.url;
        registeredPhoto.innerHTML =`<img src="/assets/img/photos-salon/${item.photo}" width="250">` ;
        modifPW.value = item.motDePasse;
    })
// });
<<<<<<< HEAD
document.getElementById('btnModif').addEventListener('click', function(event) {
    
    event.preventDefault();
    // enregitrer le nom button
    recordButtonClick('modif');
    // debloquer input
    enableInputFields();
});

// "Enregistrer" ボタンがクリックされたときの処理
document.getElementById('btnEnregist').addEventListener('click', function(event) {
    //
    event.preventDefault();
    //  enregitrer le nom button
    recordButtonClick('update');
    // envoyer le formulaire
    document.getElementById('myForm').submit();
});

// debloquer le champ input
function enableInputFields() {
=======

//button "Modifier"
btnModif.addEventListener("click",(event)=>{
    event.preventDefault();
>>>>>>> e20c71f85c7dde591e2707ad515e9f8256716d3a
    modifName.disabled = false;
    modifFirstName.disabled = false;
    modifAddress1.disabled = false;
    modifAddress2.disabled = false;
    modifTel.disabled = false;
    modifZip.disabled = false;
    modifCity.disabled = false;
    modifEmail.disabled = false;
    modifURL.disabled = false;
    modifPhoto.disabled = false;
    modifPW.disabled = false;
    btnEnregist.disabled = false;
<<<<<<< HEAD
}

// quand le button est clique
function recordButtonClick(buttonName) {
    // enregistre le nom de button
    document.getElementById('clickedButton').value = buttonName;
}


=======
})
>>>>>>> e20c71f85c7dde591e2707ad515e9f8256716d3a

//button "Enregistrer"
btnEnregist.addEventListener("click",(event)=>{
    event.preventDefault();
    salonModif.forEach(item =>{
        item.nom = modifName.value;
        item.prenom = modifFirstName.value;
        item.ad1= modifAddress1.value;
        item.ad2 = modifAddress2.value;
        item.tel =  modifTel.value;
        item.codePostale = modifZip.value;
        item.ville = modifCity.value;
        // modifSalon.value;
        item.email = modifEmail.value;
        item.url = modifURL.value;
        let newPhoto = document.getElementById("modifPhoto").files[0].name
        registeredPhoto.innerHTML =`<img src="${modifPhoto}" width="250">` ;
        item.photo = newPhoto
        item.motDePasse = modifPW.value;
        console.log(salonModif);    
    });
});

>>>>>>> b3737144e9af770f87c5acb1ac273df8b56038c9
