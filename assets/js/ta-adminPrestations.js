import * as util from './ta-utilities.js';
import * as datas from './data.js';


console.log(`Where are we? : ${document.location.pathname}`);

if (document.location.pathname ==='/html/adminListePrestations.html'){
    showPrestationsList(datas.prestations);
    //document.getElementById('nav1').addEventListener('click', goToAdminListePresta);
    console.log(document.URL);
}

if (document.location.pathname ==='/html/adminPrestation.html'){
    console.log(document.URL);
    let paramPrestation = util.parseURL(document.URL);
    let comeFromPrestaList;
    console.log(paramPrestation);
    if (paramPrestation !== null) {
        let form = document.getElementById('form1');
        form.name.disabled = true;
        comeFromPrestaList  = true;
        if (paramPrestation.name !== undefined) {
            form.name.value = paramPrestation.name;
        } else {
            comeFromPrestaList = false;
            form.name.disabled = false;
        }
        if (paramPrestation.duration !== undefined) {
            form.duration.value = Number(paramPrestation.duration);
        } else {
            form.duration.value = '';
        }
        if(paramPrestation.description !== undefined) {
            form.description.value = paramPrestation.description;
        } else {
            form.description.value = '';
        }
        if (paramPrestation.price !== undefined){
           form.price.value = paramPrestation.price;
        } else {
            form.price.value = '';
        }
    }
    if (comeFromPrestaList){
        document.getElementById('btn1').addEventListener('click', modifyPrestaToList);    
    } else {
        document.getElementById('btn1').addEventListener('click', addPrestaToList);
    }
}

/******************Liste les prestations dans admin************************/
function showPrestationsList (prestations){

    let tab = document.getElementById('tab1');
    tab.innerHTML = '';
    
    let fragment = document.createDocumentFragment();

    let tabHeaders = new Array();
    tabHeaders.push('Intitulé'); 
    tabHeaders.push('Description');
    tabHeaders.push('Création date');
    tabHeaders.push('Modif date');
    tabHeaders.push('Modifier');
    tabHeaders.push('Supprimer');

    let elemtr = document.createElement('tr');
    fragment.appendChild(elemtr);
    tabHeaders.forEach( header=> {
        let elemth = document.createElement('th');
        elemtr.appendChild(elemth);
        elemth.appendChild(document.createTextNode(`${header}`));       
    });
    prestations.forEach (presta => {
        let elemtr = document.createElement('tr');
        let elemtd = document.createElement('td');
        fragment.appendChild(elemtr);
        elemtr.appendChild(elemtd);
        elemtd.appendChild(document.createTextNode(presta.nom));
        elemtd = document.createElement('td');
        fragment.appendChild(elemtr);
        elemtr.appendChild(elemtd);
        elemtd.appendChild(document.createTextNode(presta.description));
        elemtd = document.createElement('td');
        fragment.appendChild(elemtr);
        elemtr.appendChild(elemtd);
        elemtd.appendChild(document.createTextNode(presta.creationDate.toLocaleDateString()));
        elemtd = document.createElement('td');
        fragment.appendChild(elemtr);
        elemtr.appendChild(elemtd);
        elemtd.appendChild(document.createTextNode(presta.modifDate.toLocaleDateString()));
        elemtd = document.createElement('td');
        fragment.appendChild(elemtr);
        elemtr.appendChild(elemtd);
        let elemmod = document.createElement('i');
        let id = 'mod'.concat(presta.id);
        elemmod.setAttribute('id', `${id}`);
        elemmod.setAttribute('class','bi-pencil p-0');
        elemtd.appendChild(elemmod);
        elemtd = document.createElement('td');
        fragment.appendChild(elemtr);
        elemtr.appendChild(elemtd);
        let elemsupp = document.createElement('i');
        elemsupp.setAttribute('id', 'supp'.concat(presta.id));
        elemsupp.setAttribute('class','bi-trash p-0');
        elemtd.appendChild(elemsupp);
    })
    tab.appendChild(fragment);
    
    prestations.forEach (item => {
        document.getElementById('mod'.concat(item.id)).addEventListener('click',modifPrestaFromList);
        document.getElementById('supp'.concat(item.id)).addEventListener('click',suppPrestaFromList);
    })   
    document.getElementById('btn2').addEventListener('click', goToAdminPresta);
}    
    
/******************Go to the selected prestation dans admin************************/
function goToAdminPresta(event){
    event.preventDefault();
    console.log('going going to adminPresta!');
    console.log(datas.prestations);
    console.log(sessionStorage.getItem('jsonString'));
    let queryString = '';
     document.location.href = `./adminPrestation.html?prestas=${sessionStorage.getItem('jsonString')}`;
}

/******************************************/
function modifPrestaFromList (event) {
    console.log(event.target.id);
    console.log('coucou! je modifie');
    console.log(datas.prestations);
    let ind = datas.prestations.findIndex(item => item.id === Number(event.target.id.substr(3)));
    console.log(ind);
    document.location.href = `./adminPrestation.html?name=${datas.prestations[ind].nom}&duration=${datas.prestations[ind].duration}&description=${datas.prestations[ind].description}&price=${datas.prestations[ind].price}`;
}

/******************supprime une prestation de la liste dans admin************************/
function suppPrestaFromList (event) {
    console.log(event.target.id);
    console.log('coucou! je supprime');
    console.log(datas.prestations);
    let ind = datas.prestations.findIndex(item => item.id === Number(event.target.id.substr(4)));
    console.log(ind);
    if (ind !== -1) {
        datas.prestations.splice(ind,1);
    }
    console.log(event);
    let params = new Array();
        datas.prestations.forEach (item => {
            params += `{"id":"${item.id}","nom":"${item.nom}","duration":"${item.duration}","description":"${item.description}","prix":"${item.price}"},`;
        });
    if (params.length > 0) {  
        params = params.substring(0,params.length-1);
    }
    params = `[${params}]`;
    sessionStorage.setItem('jsonString',params);
    showPrestationsList(datas.prestations, 'toto');
    console.log(datas.prestations);
}

/******************Modifie une prestation existante dans admin************************/
function modifyPrestaToList () {
    console.log('Modifying Presta!');
    let form = document.getElementById('form1');
    let flagErrorInput = false;
    let errorCount = 0;
    let presta;
    let nom;
    let description;
    let duration;
    let price;
    
    console.log(form.description.value);
    console.log(form.duration.value);
    console.log(form.price.value);
    console.log(util.isValidTextField(form.name.value));
    console.log(util.isValidTextField(form.description.value));
    form.name.value = form.name.value.trim();
    nom = form.name.value;
    if (util.isValidTextField(form.description.value)) {
        form.description.value = form.description.value.trim();
        description = form.description.value;
        console.log(description);
        flagErrorInput = false;
    } else {form.description.setAttribute('placeholder', 'Il y a une erreur!');flagErrorInput = true; errorCount++;}
    console.log(util.isNumeric(Number(form.duration.value)));
    if (util.isNumeric(Number(form.duration.value)) && (Number(form.duration.value) !== 0)) { 
        duration = Number(form.duration.value);
        console.log(duration); 
        flagErrorInput = false;
    } else {form.duration.setAttribute('placeholder', 'Il y a une erreur!'); flagErrorInput = true; errorCount++;}
    if (util.isNumeric(Number(form.price.value)) && (Number(form.price.value) !== 0)) {
        price = Number(form.price.value); 
        console.log(price); 
        flagErrorInput = false;
    } else {form.price.setAttribute('placeholder', 'Il y a une erreur!'); flagErrorInput = true; errorCount++;}

    console.log(!flagErrorInput);
    console.log(errorCount);
    if(!flagErrorInput && errorCount === 0) {
        let ind = datas.prestations.findIndex(item => item.nom === nom);
        presta = datas.prestations[ind];
        console.log(presta);
        presta.description = description;
        presta.duration = duration;
        presta.price = price;
        presta.modifDate = new Date();
        //datas.prestations.splice(ind,1);
        //datas.prestations.push(presta);
        console.log(datas.prestations);
    }
}

/******************Ajoute une nouvelle prestation dans admin************************/
function addPrestaToList() {
    console.log('Adding Presta!');
    let form = document.getElementById('form1');
    let flagErrorInput = false;
    let errorCount = 0;
    let presta;
    let nom;
    let description;
    let duration;
    let price;
    
            
    if (util.isValidTextField(form.name.value)) {
        form.name.value = form.name.value.trim();
        nom = form.name.value;
        let ind = datas.prestations.findIndex(item => item.nom === nom);
        console.log(ind);
        if (ind !== -1) {
            form.name.value = '';
            form.name.setAttribute('placeholder', 'cette prestation existe déjà!');
            flagErrorInput = true;
             errorCount++;
        } else {
            form.name.value = form.name.value.trim();
            nom = form.name.value;
            console.log(nom);
            flagErrorInput = false;
        }
    } else {
        form.name.value = '';
        form.name.setAttribute('placeholder', 'Il y une erreur!');
        flagErrorInput = true; 
        errorCount++;
    }
    console.log(util.isNumeric(Number(form.duration.value)));
    if (util.isNumeric(Number(form.duration.value)) && Number(form.duration.value) !== 0) { 
        duration = Number(form.duration.value);
        console.log(duration); 
        flagErrorInput = false;
    } else {
        form.duration.value = '';
        form.duration.setAttribute('placeholder', 'Il y a une erreur!'); 
        flagErrorInput = true; 
        errorCount++;
    }
    if (util.isValidTextField(form.description.value)) {
        form.description.value = form.description.value.trim();
        description = form.description.value;
        console.log(description);
        flagErrorInput = false;
    } else {
        form.description.value = '';
        form.description.setAttribute('placeholder', 'Il y une erreur!');
        flagErrorInput = true;
        errorCount++;
    }
    if (util.isNumeric(Number(form.price.value)) && Number(form.price.value) !== 0) {
        price = Number(form.price.value); 
        console.log(price); 
        flagErrorInput = false;
    } else {
        form.price.setAttribute('placeholder', 'Il y a une erreur!'); 
        flagErrorInput = true; 
        errorCount++;
    }
    console.log(!flagErrorInput);
    console.log(errorCount);
    if(!flagErrorInput && errorCount === 0) {
        presta = new datas.SalonPrestation(nom, duration,description,price);
        datas.prestations.push(presta);
        console.log(datas.prestations);
    }
}



