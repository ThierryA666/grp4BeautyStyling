// import *as data from "./data.js";
// console.log(data.salons);


// let search = window.location.search;
// console.dir(search);
// let link = search.split("=");
// console.dir(link);
// let salonID =link[1]
// console.log(salonID);

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
// const btnEnregist = document.getElementById("btnEnregist");

// afficher le password avec check box
chk.addEventListener("change", function () {
    if (chk.checked) {
        modifPW.type = "text";
    } else {
        modifPW.type = "password";
    }
  });

//Après avoir saisi le code postal, des villes correspondante s'affiche.  
const apiZip ="https://geo.api.gouv.fr/communes"
modifZip.addEventListener("change",(event)=>{
    event.preventDefault();
    fetch(apiZip)
      .then((response)=>{
      if(!response.ok) throw new Error('Il y a une erreur de saisie.' + response.status);
        return response.json()
      })  
      .then(communes =>getOption(communes))
      .catch(error => affMsg(error.message));
  }) 
  const errZip = document.getElementById("errZip");  
  function affMsg(message){
    console.log("affiche message" + message);
    errZip.innerHTML = message;
    errZip.className ="text-danger border-danger"
  }
  
  function getOption (datas){
    let zip =String(modifZip.value);
    console.log(zip);
    let listCity = datas.filter(city =>city.codesPostaux.indexOf(zip)!==-1);
    console.log(listCity);
    if(listCity.length==0) throw new Error ('Il y a une erreur de saisie sur code postale.');
    modifCity.innerHTML = "";
    listCity.forEach(com => {
        let option = document.createElement("option");
        option.value = com.nom;
        option.text = com.nom;
        modifCity.appendChild(option); // ajout option
    });
  } 

//button "Modifier"
  document.getElementById('btnModif').addEventListener('click', function(event) {
    
    event.preventDefault();
    // enregitrer le nom button
    recordButtonClick('modif');
    // debloquer input
    enableInputFields();
});

// button "Enregistrer" 
document.getElementById('btnEnregist').addEventListener('click', function(event) {
    //
    event.preventDefault();
    //  enregitrer le nom button
    recordButtonClick('update');
    // envoyer le formulaire
    let isValid = true;
    let phone = modifTel.value.replace(/\s/g, ''); //enlever des espace
    if(!modifName.value){
        const errNom=document.getElementById("errMNom");
        errMNom.innerHTML = "Champ obligatoire"
        errMNom.className = "text-danger border-danger";
        isValid =  false;
        
        } else {
            errMNom.className = "d-none"; 
          }
       
      if(!modifFirstName.value){
       const errMPrenom=document.getElementById("errMPrenom");
       errMPrenom.innerHTML = "Champ obligatoire";
       errMPrenom.className = "text-danger border-danger";
       isValid =  false;
       } else {
        errMPrenom.className = "d-none";
        }
    
      if(!modifAddress1.value){
        const errMAd=document.getElementById("errMAd");
        errMAd.innerHTML = "Champ obligatoire";
        errMAd.className = "text-danger border-danger";
        isValid = false;
        } else {
          errMAd.className = "d-none";
          }  
    
      if(!modifEmail.value){
        const errMEmail=document.getElementById("errMEmail");
        errMEmail.innerHTML = "Champ obligatoire";
        errMEmail.className = "text-danger border-danger";
        isValid =  false;
         } else if(!modifEmail.value.match(/.+@.+\..+/)){
          errMEmail.innerHTML = "Veuillez saisir votre adresse mail dans le bon format."
          errMEmail.className = "text-danger border-danger";
          isValid =  false;
          }else {
          errMEmail.className = "d-none";
           } 
    
      if(!modifTel.value){
        const errMTel=document.getElementById("errMTel");
        errMTel.innerHTML = "Champ obligatoire";
        errMTel.className = "text-danger border-danger";
        isValid =  false;
      } else if (modifTel.value.length<10 || modifTel.value.length>11) {
          errMTel.innerHTML = "Saisissez votre numéro de téléphone à 10 chiffres"
          errMTel.className = "text-danger border-danger";
          isValid =  false;
         }else errMTel.className = "d-none";
          
               
      if(!modifZip.value){
        let errMZip=document.getElementById("errMZip");
        errMZip.innerHTML = "Champ obligatoire";
        errMZip.className = "text-danger border-danger";
        isValid =  false;
        } else {
          errMZip.className = "d-none";
          }   
    
      if(!modifCity.value){
        const errMVille=document.getElementById("errMVille");
        errMVille.innerHTML = "Champ obligatoire";
        errMVille.className = "text-danger border-danger";
        isValid =  false;
        } else {
          errMVille.className = "d-none";
          } 
      if(!modifPW.value){
        const errMPW=document.getElementById("errMPW");
        errMPW.innerHTML = "Champ obligatoire"
        errMPW.className = "text-danger border-danger";
        isValid = false;
      } else if(!modifPW.value.match(/^([a-zA-Z0-9]{8,})$/)){
             errMPW.innerHTML = "Veuillez saisir un mot de passe d'au moins 8 caractères.";
             errMPW.className = "text-danger border-danger";
             isValid =  false;
                   
        } else {
                errMPW.innerHTML ="";
                errMPW.className = "d-none";
           
              };
      console.log(isValid);       
    if(isValid) document.getElementById('myForm').submit();
});

// quand le button est clique
function recordButtonClick(buttonName) {
    // enregistre le nom de button
    document.getElementById('clickedButton').value = buttonName;
}  

// debloquer le champ input
function enableInputFields() {
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
}


//=======Control de saisie par utilisateur=====
//saisies obligatoires: nom prenom tel email aderesse1 nomSalon mot de passe code postale ville














//Afficher le data du salon
// window.addEventListener('load',(event)=>{
//     event.preventDefault();
    // let salonModif = data.salons.filter(salon=>salon.id==salonID)
    // console.dir(salonModif);
    // salonModif.forEach(item =>{
    //     console.log(item.nom)
    //     modifName.value = item.nom;
    //     modifFirstName.value = item.prenom;
    //     modifAddress1.value = item.ad1;
    //     modifAddress2.value = item.ad2;
    //     modifTel.value = item.tel;
    //     modifZip.value = item.codePostale;
    //     modifCity.value = item.ville;
    //     modifSalon.value = item.nomSalon;
    //     modifEmail.value = item.email;
    //     modifURL.value = item.url;
    //     registeredPhoto.innerHTML =`<img src="/assets/img/photos-salon/${item.photo}" width="250">` ;
    //     modifPW.value = item.motDePasse;
    // })
// });




//button "Enregistrer"
// btnEnregist.addEventListener("click",(event)=>{
//     event.preventDefault();
//     salonModif.forEach(item =>{
//         item.nom = modifName.value;
//         item.prenom = modifFirstName.value;
//         item.ad1= modifAddress1.value;
//         item.ad2 = modifAddress2.value;
//         item.tel =  modifTel.value;
//         item.codePostale = modifZip.value;
//         item.ville = modifCity.value;
//         item.email = modifEmail.value;
//         item.url = modifURL.value;
//         let newPhoto =""
//         if(document.getElementById("modifPhoto").files[0]) newPhoto = document.getElementById("modifPhoto").files[0].name
//         registeredPhoto.innerHTML =`<img src="${modifPhoto}" width="250">` ;
//         item.photo = newPhoto
//         item.motDePasse = modifPW.value;
//         console.log(salonModif);    
//     });
// });

