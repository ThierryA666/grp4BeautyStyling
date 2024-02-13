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
    .then((response)=>{return response.json()})
    .then(communes =>getOption(communes))
});

function getOption (datas){
  let zip =String(inputZip.value);
  console.log(zip);
  let listCity = datas.filter(city =>city.codesPostaux.indexOf(zip)!==-1);
  console.log(listCity);
  inputCity.innerHTML=""
  listCity.forEach(com =>{
  inputCity.innerHTML += `<option value ="${com.code}">${com.nom}</option>`;  
  })
} 

//=======Control de saisie par utilisateur=====
//saisies obligatoires: nom prenom tel email aderesse1 nomSalon mot de passe code postale ville
const btnSubmit = document.getElementById("inscriptionBtn");

function errorCheck(){
  try{
  if(inputName.value.length ===0 ||inputName.value.trim()==0) throw new Error( "chaine videe");
  if(inputFirstName.value.length ===0 ||inputFirstName.value.trim()==0)throw new Error( "chaine vide");
  if(inputCodeInt.value.length ===0 ||inputCodeInt.value.trim()==0)throw new Error( "chaine vide");
  if(inputTel.value.length ===0 ||inputTel.value.trim()==0)throw new Error( "chaine vide");
  if(inputAddress.value.length ===0 ||inputAddres.value.trim()==0)throw new Error( "chaine vide");
  if(inputEmail.value.length ===0 ||inputEmail.value.trim()==0)throw new Error( "chaine vide");
  if(inputSalon.value.length ===0 ||inputSalon.value.trim()==0)throw new Error( "chaine vide");  
  if (inputPW1.value.length ===0 ||inputSalon.value.trim()==0)throw new Error( "chaine vide");
  if(inputTel.value.length <10) throw new Error( "Erreur de format de saisie");
  if(inputPW1.value.length <8) throw new Error( "Erreur de format de saisie");
  if(inputPW2.value.length <8) throw new Error( "Erreur de format de saisie");
  
  if(inputPW1.value!==inputPW2.value) throw new Error("Erreur mots de passes")
  if(inputPW1.value!==inputPW2.value) throw new Error("Erreur mots de passes")

  }catch(error){
    if (error.message === "chaine vide"){
      console.error("Champ obligatoire.")
    }
    if (error.message ==="Erreur de format de saisie"){
      console.error("Veuillez saisir le format correct.")
    }
    if (error.message ==="Erreur mots de passes"){
      console.error("Le mot de passe de confirmation ne correspond pas au mot de passe saisi.")
    }
  }
  return true;
}


// Recuperer la donné par le formulaire 


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
let photoUL = document.getElementById("photoUL").files[0].name;
console.log(photoUL)
let inputPW1 = document.getElementById("inputPW1").value

let formData = new data.SalonData(new Date(),inputName,inputFirstName,inputAddress,inputAddress2,inputEmail,fullNumber,inputZip,inputCity,inputSalon,inputURL,photoUL, inputPW1);
console.log(formData);
data.salons.push(formData);
console.log(data.salons);
};


// constructor(creationDate, nom, prenom, ad1, ad2, email, tel, codePostale, ville, nomSalon, url, photo, motDePasse)