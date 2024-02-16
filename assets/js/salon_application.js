import *as data from "./data.js";
console.log(data.salons);

// -------formulaire inscription-------

//Password zone DOM
let formPW1 = document.getElementById("inputPW1");
let formPW2 = document.getElementById("inputPW2");
let chk1 =document.getElementById("chk1");
let chk2 =document.getElementById("chk2")



// afficher le password avec check box
chk1.addEventListener("change", function () {
    if (chk1.checked) {
      formPW1.type = "text";
    } else {
      inputPW1.type = "password";
    }
  });

chk2.addEventListener("change", function () {
    if (chk2.checked) {
      formPW2.type = "text";
    } else {
      inputPW2.type = "password";
    }
});  


//Après avoir saisi le code postal, des villes correspondante s'affiche.
let inputZip=document.getElementById("inputZip")

const apiZip ="https://geo.api.gouv.fr/communes"

inputZip.addEventListener("change",(event)=>{
  event.preventDefault();
  fetch(apiZip)
    .then((response)=>{
    if(!response.ok) throw new Error('Il y a une erreur de saisie.' + response.status);
      return response.json()
    })  
    .then(communes =>getOption(communes))
    .catch(error => affMsg(error.message));
}) 
   
function affMsg(message){
  console.log("affiche message" + message);
  const errZip = document.getElementById("errZip");
  errZip.innerHTML = message;
}

function getOption (datas){
  let zip =String(inputZip.value);
  console.log(zip);
  let listCity = datas.filter(city =>city.codesPostaux.indexOf(zip)!==-1);
  console.log(listCity);
  if(listCity.length==0) throw new Error ('Il y a une erreur de saisie sur code postale.');
  inputCity.innerHTML=""
  listCity.forEach(com =>{
  inputCity.innerHTML += `<option value ="${com.code}">${com.nom}</option>`;  
  })
} 
// inputPW1.addEventListener("change", (event)=>{
//   event.preventDefault();
//   if(!inputPW1.value.match(/^([a-zA-Z0-9]{8,})$/)){
//     errPW1.innerHTML = "Veuillez saisir un mot de passe d'au moins 8 caractères.";
//     errPW1.className = "text-warning border-warning";
//   } else {
//       errPW1.innerHTML ="";
//       errPW1.className = "d-none";
//     }
// });

// inputEmail.addEventListener("change",(event)=>{
//   event.preventDefault();
//   if(!inputEmail.value.match(/.+@.+\..+/)) {
//     errEmail.innerHTML = "Veuillez saisir votre mail dans le bon format";
//    errEmail.className = "text-warning border-warning";
//    return;
//   } else {
//       errEmail.innerHTML ="";
//       errEmail.className ="d-none";
//     }
   
// });


// // le moment ou mot de passe à confirmer est saisie, comparer avec &er mot de passe
// inputPW2.addEventListener("change", (event)=>{
//   event.preventDefault();
//   if(inputPW1.value!==inputPW2.value) {
//     const errPW2 = document.getElementById("errPW2");
//     errPW2.innerHTML = "Le mot de passe saisi ne correspond pas au mot de passe de confirmation.";
//     errPW2.className= "text-warning border-warning";
//     return;
//     } else{
//       errPW2.innerHTML = "";
//       errPW2.className="d-none";
//     }
// })

//=======Control de saisie par utilisateur=====
//saisies obligatoires: nom prenom tel email aderesse1 nomSalon mot de passe code postale ville
const btnSubmit = document.getElementById("inscriptionBtn");
btnSubmit.addEventListener("click",(event)=>{
  event.preventDefault();
  let isValid = true;
  if(!inputName.value){
    const errNom=document.getElementById("errNom");
    errNom.innerHTML = "Champ obligatoire"
    errNom.className = "text-warning border-warning";
    isValid =  false;
    
    } else {
        errNom.className = "d-none"; 
      }
   
  if(!inputFirstName.value){
   const errPrenom=document.getElementById("errPrenom");
   errPrenom.innerHTML = "Champ obligatoire"
   errPrenom.className = "text-warning border-warning";
   isValid =  false;
   } else {
    errPrenom.className = "d-none";
    }

  if(!inputAddress.value){
    const errAd=document.getElementById("errAd");
    errAd.innerHTML = "Champ obligatoire"
    errAd.className = "text-warning border-warning";
    isValid = false;
    } else {
      errAd.className = "d-none";
      }  

  if(!inputEmail.value){
    const errEmail=document.getElementById("errEmail");
    errEmail.innerHTML = "Champ obligatoire"
    errEmail.className = "text-warning border-warning";
    isValid =  false;
     } else {
      errEmail.className = "d-none";
       } 

  if(!inputTel.value){
    const errTel=document.getElementById("errTel");
    errTel.innerHTML = "Champ obligatoire"
    errTel.className = "text-warning border-warning";
    isValid =  false;
    } else {
      errTel.className = "d-none";
      
      } 

  if(!inputSalon.value){
    const errNomSalon=document.getElementById("errNomSalon");
    errNomSalon.innerHTML = "Champ obligatoire"
    errNomSalon.className = "text-warning border-warning";
    isValid =  false;
    } else {
      errNomSalon.className = "d-none";
      }     
      
  if(!inputZip.value){
    const errZip=document.getElementById("errZip");
    errZip.innerHTML = "Champ obligatoire"
    errZip.className = "text-warning border-warning";
    isValid =  false;
    } else {
      errZip.className = "d-none";
      }   

  if(!inputCity.value){
    const errVille=document.getElementById("errVille");
    errVille.innerHTML = "Champ obligatoire"
    errVille.className = "text-warning border-warning";
    isValid =  false;
    } else {
      errVille.className = "d-none";
      } 

  if(!inputPW1.value){
    const errPW1=document.getElementById("errPW1");
    errPW1.innerHTML = "Champ obligatoire"
    errPW1.className = "text-warning border-warning";
    isValid = false;
  } else if(!inputPW1.value.match(/^([a-zA-Z0-9]{8,})$/)){
         errPW1.innerHTML = "Veuillez saisir un mot de passe d'au moins 8 caractères.";
         errPW1.className = "text-warning border-warning";
         isValid =  false;
         
  }else if(inputPW1.value!==inputPW2.value) {
          const errPW2 = document.getElementById("errPW2");
          errPW2.innerHTML = "Le mot de passe saisi ne correspond pas au mot de passe de confirmation.";
          errPW2.className= "text-warning border-warning"  
          isValid =  false
          
    } else {
            errPW1.innerHTML ="";
            errPW2.innerHTML ="";
            errPW1.className = "d-none";
            errPW1.className = "d-none";
            isValid =  false;
          };
  if (isValid=true) addSalonAccount();        

});




// Recuperer la donné par le formulaire 




// function errorCheck(){
//   try{
//   if(inputName.value.length ===0 ||inputName.value.trim()==0) throw new Error( "chaine videe");
//   if(inputFirstName.value.length ===0 ||inputFirstName.value.trim()==0)throw new Error( "chaine vide");
//   if(inputCodeInt.value.length ===0 ||inputCodeInt.value.trim()==0)throw new Error( "chaine vide");
//   if(inputTel.value.length ===0 ||inputTel.value.trim()==0)throw new Error( "chaine vide");
//   if(inputAddress.value.length ===0 ||inputAddres.value.trim()==0)throw new Error( "chaine vide");
//   if(inputEmail.value.length ===0 ||inputEmail.value.trim()==0)throw new Error( "chaine vide");
//   if(inputSalon.value.length ===0 ||inputSalon.value.trim()==0)throw new Error( "chaine vide");  
//   if(inputPW1.value.length ===0 ||inputSalon.value.trim()==0)throw new Error( "chaine vide");
//   if(inputTel.value.length <10) throw new Error( "Erreur de format de saisie");
//   if(inputPW1.value.length <8) throw new Error( "Erreur de format de saisie");
//   if(inputPW2.value.length <8) throw new Error( "Erreur de format de saisie");
  
//   if(inputPW1.value!==inputPW2.value) throw new Error("Erreur mots de passes")
//   if(inputPW1.value!==inputPW2.value) throw new Error("Erreur mots de passes")

//   }catch(error){
//     if (error.message === "chaine vide"){
//       console.error("Champ obligatoire.")
//     }
//     if (error.message ==="Erreur de format de saisie"){
//       console.error("Veuillez saisir le format correct.")
//     }
//     if (error.message ==="Erreur mots de passes"){
//       console.error("Le mot de passe de confirmation ne correspond pas au mot de passe saisi.")
//     }
//   }
//   addSalonAccount();
// }





function addSalonAccount(){
  let inputName = document.getElementById("inputName").value ;
  let inputFirstName =document.getElementById("inputFirstName").value;
  let inputAddress = document.getElementById("inputAddress").value;
  let inputAddress2  = document.getElementById("inputAddress2").value;
  let inputEmail = document.getElementById("inputEmail").value;
  let inputTel = document.getElementById("inputTel").value;
  let inputCodeInt = document.getElementById("inputCodeInt").value
  let inputZip = document.getElementById("inputZip").value;
  let fullNumber = inputCodeInt + inputTel
  let inputCity = document.getElementById("inputCity").value;
  let inputSalon = document.getElementById("inputSalon").value;
  let inputURL = document.getElementById("inputURL").value;
  
  let photoUL = ""
  if(document.getElementById("photoUL").files[0]){
    photoUL = document.getElementById("photoUL").files[0].name;
    console.log(photoUL)}

  let inputPW1 = document.getElementById("inputPW1").value
  let formData = new data.SalonData(new Date(),inputName,inputFirstName,inputAddress,inputAddress2,inputEmail,fullNumber,inputZip,inputCity,inputSalon,inputURL,photoUL, inputPW1);
  console.log(formData);
  data.salons.push(formData);
  console.log(data.salons);
};


// constructor(creationDate, nom, prenom, ad1, ad2, email, tel, codePostale, ville, nomSalon, url, photo, motDePasse)