// import *as data from "./data.js";
// console.log(data.salons);

let btnDel = document.getElementById('btnsupprimer') ;



//-----------Afficher data gestion de comptes-----------
//DOM
const btnPen = document.getElementsByClassName("bi bi-pencil");
const btnX = document.getElementsByClassName("bi bi-x");
const btnSearchSalonAccount = document.getElementById("btnSearchSalonAccount")
const listSalonAccount = document.getElementById("listSalonAccount")

btnSearchSalonAccount.addEventListener("click",(event)=>{
  event.preventDefault();
  let keyword = document.getElementById("inputKeyword").value.toUpperCase();
  console.log(keyword);
  let results = data.salons.filter(salon=>salon.nomSalon.toUpperCase().indexOf(keyword)!==-1);
  console.log(results)
  listSalonAccount.innerHTML="";
  results.forEach(salon =>{
  listSalonAccount.innerHTML += `<tr>
    <th scope="row"><input class="form-check-input" type="checkbox" value="select"></th>
    <td id="nameSalon">${salon.nomSalon}</td>
    <td id="nameRep">${salon.nom} ${salon.prenom}</td>
    <td id="telSalon">${salon.tel}</td>
    <td id="emailSalon">${salon.email}</td>
    <td> <a href="salon_profile.html?id=${salon.id}"> <i class="bi bi-pencil" style="color:blue;"></i></a> / <i class="bi bi-x" style="color:red;"></i></td>
    </tr>`
    });  
  });







