import * as util from './ta-utilities.js';
import * as datas from './data.js';

console.log(`Where are we? : ${document.location.pathname}`);

if (document.location.pathname === '/html/clientPaniers.html') {
    console.log('hello paniers');
    console.log(document.URL);
    let parampanier = util.parseURL(document.URL);
    console.log(parampanier);
    if (parampanier !== null) {
        console.log(datas.paniersDeleted);
        if (parampanier.delete) {
            datas.reservations.forEach((item, index, self) => {
                if (item.id === Number(parampanier.delete)) {
                    datas.paniersDeleted.push(item);
                    self.splice(index,1);
                }
            });
        }
        if (parampanier.rdv) {
            parampanier.rdv.split(',').forEach((item) => {
                datas.reservations.forEach((elem, index, self) => { if (elem.id === Number(item)) {datas.paniersDeleted.push(elem);self.splice(index,1);}})
            })
            if (datas.paniersDeleted.length > 0) {
                datas.reservations.forEach((item, index, self) => {
                    datas.paniersDeleted.forEach((elem) => {
                        try {
                            if (item.id == elem.id) {
                                self.splice(index);
                            }
                        }
                        catch (error) {
                            console.log('In the try!');
                            console.dir(error);
                        }     
                    })
                })
            }
        } else if (datas.paniersDeleted.length > 0) {
            datas.reservations.forEach((item, index, self) => {
                datas.paniersDeleted.forEach(elem => {
                    if (item.id === elem.id) self.splice(index,1);
                })
            })
        }
    }
    let salonsList = new Array();
    datas.reservations.forEach (item => salonsList.push(item.salon));
    let uniqueSalonsList = salonsList.filter((value, index, self) => {return self.indexOf(value) === index;});
    showClientPaniers(datas.reservations, uniqueSalonsList);
}

if (document.location.pathname === '/html/clientDetailPanier.html'){
    console.log(document.URL);
    let parampanier = util.parseURL(document.URL);
    console.log(parampanier);
    let reservation = {};
    if (parampanier !== null) {
        if (parampanier.reservationID) {
            datas.reservations.forEach((item, index, self) => {if (item.id === Number(parampanier.reservationID)) reservation = self[index];});
            showClientPanier(reservation);
        }
        // console.log(datas.paniersDeleted);
        // console.log(reservation);
        // if (parampanier.rdv) {parampanier.rdv.split(',').forEach((item,index) => {datas.paniersDeleted.push(datas.reservations[Number(item)]);datas.reservations.splice(index,1);})};
        // datas.showClientPanier(reservation);
    } else { 
        console.log('total despair!');
        if (datas.paniersDeleted.length > 0) datas.paniersDeleted = {};
        console.log(datas.paniersDeleted);
        console.log(datas.reservations);
        console.log(window.location.URL);
        let salonsList = new Array();
        datas.reservations.forEach (item => salonsList.push(item.salon));
        let uniqueSalonsList = salonsList.filter((value, index, self) => {return self.indexOf(value) === index;});
        console.log(uniqueSalonsList);
        showClientPaniers(datas.reservations, uniqueSalonsList)
    }
}

/******************Functions******************************************/
/******************Liste des paniers du client************************/
function showClientPaniers(reservations=datas.reservations, salonsList=salons, dateBefore='', dateAfter='', salonID=0) {
    console.log('789 ds mes paniers neufs');
    let formSearch = document.getElementById('formSearch');
    let fragment7 = document.createDocumentFragment();
    formSearch.setAttribute('id', 'formSearch');
    formSearch.setAttribute('name', 'search');
    formSearch.setAttribute('action', '#');
    let searchdiv = document.createElement('div');
    searchdiv.setAttribute('class', 'd-inline');
    let elemh1 = document.createElement('h1');
    elemh1.setAttribute('class', 'h4 text-dark text-start mx-auto');
    let elemtxt1 = document.createTextNode('Mes paniers');
    elemh1.appendChild(elemtxt1);
    searchdiv.appendChild(elemh1);
    fragment7.appendChild(searchdiv);
    searchdiv = document.createElement('div');
    searchdiv.setAttribute('class', 'd-inline');
    let elemlab1 = document.createElement('label');
    elemlab1.setAttribute('for', 'salonSelect');
    elemlab1.setAttribute('class', 'mx-1');
    let elemtxt2 = document.createTextNode('Sélectionnez un salon ou 2 dates:');
    elemlab1.appendChild(elemtxt2);
    searchdiv.appendChild(elemlab1);
    let elems1 = document.createElement('select');
    elems1.setAttribute('id', 'salonSelect');
    let opthint = document.createElement('option');
    opthint.setAttribute('value', 'salon0');
    opthint.appendChild(document.createTextNode('--Choisissez une option--'));
    elems1.appendChild(opthint);
    console.log(salonsList);
    salonsList.forEach(item => { 
        let elemopt = document.createElement('option');
        elemopt.appendChild(document.createTextNode(`${item.nomSalon}`));
            elemopt.setAttribute('value', `salon${item.id}`);
            console.log(salonID);
            if (salonID === item.id) elemopt.setAttribute('selected', 'true');
            elems1.appendChild(elemopt);
    });
    searchdiv.appendChild(elems1);
    fragment7.appendChild(searchdiv);
    searchdiv = document.createElement('div');
    searchdiv.setAttribute('class', 'd-inline');
    elemlab1 = document.createElement('label');
    elemlab1.setAttribute('for', 'panierDateAfter');
    elemlab1.setAttribute('class', 'mx-1');
    elemlab1.appendChild(document.createTextNode('Après le :'));
    searchdiv.appendChild(elemlab1);
    let elemdiag1= document.createElement('input');
    elemdiag1.setAttribute('type', 'date');
    elemdiag1.setAttribute('id', 'panierDateAfter');
    elemdiag1.setAttribute('class', 'rounded-2');
    if (dateAfter) elemdiag1.setAttribute('value', `${dateAfter}`)
    searchdiv.appendChild(elemdiag1);
    fragment7.appendChild(searchdiv);
    searchdiv = document.createElement('div');
    searchdiv.setAttribute('class', 'd-inline');
    elemlab1 = document.createElement('label');
    elemlab1.setAttribute('for', 'panierDateAfter');
    elemlab1.setAttribute('class', 'mx-1');
    elemlab1.appendChild(document.createTextNode('Avant le :'));
    searchdiv.appendChild(elemlab1);
    fragment7.appendChild(searchdiv);
    elemdiag1= document.createElement('input');
    elemdiag1.setAttribute('type', 'date');
    elemdiag1.setAttribute('id', 'panierDateBefore');
    elemdiag1.setAttribute('class', 'rounded-2');
    if (dateBefore) elemdiag1.setAttribute('value', `${dateBefore}`)
    searchdiv.appendChild(elemdiag1);
    fragment7.appendChild(searchdiv);
    searchdiv = document.createElement('div');
    searchdiv.setAttribute('class', 'd-inline');
    let elembutton7 = document.createElement('button');
    elembutton7.setAttribute('id', 'bt1');
    elembutton7.setAttribute('class', 'btn bsbtn1 btn-outline-primary');
    let elemicon7 = document.createElement('i');
    elemicon7.setAttribute('class', 'bi bi-search');
    elemicon7.appendChild(document.createTextNode('Trouvez moi'));
    elembutton7.appendChild(elemicon7);
    searchdiv.appendChild(elembutton7);
    fragment7.appendChild(searchdiv);

    if (formSearch) formSearch.innerHTML = ''; formSearch.appendChild(fragment7); console.log(fragment7);

    let form = document.getElementById('formPaniers');
    let fragment1 = document.createDocumentFragment();

    if (reservations.length > 0){
        
        let elemdiv = document.createElement('div');
        elemdiv.setAttribute('class', 'grid-container bandeau boldfonts align-items-center p-3 col-sm');
    
        let elemdiv1 = document.createElement('div');
        elemdiv1.setAttribute('class','grid-item');
        let elemspan1 = document.createElement('span');
        elemspan1.setAttribute('class','p1');
        elemspan1.appendChild(document.createTextNode('Nom:'));
        elemdiv1.appendChild(elemspan1);

        elemdiv.appendChild(elemdiv1);
        
        let elemdiv2 = document.createElement('div');
        elemdiv2.setAttribute('class','grid-item');
        let elemspan2 = document.createElement('span');
        elemspan2.setAttribute('class','p1');
        elemspan2.appendChild(document.createTextNode('Salon:'));
        elemdiv2.appendChild(elemspan2);
        
        elemdiv.appendChild(elemdiv2);
        
        let elemdiv3 = document.createElement('div');
        elemdiv3.setAttribute('class','grid-item');
        let elemspan3 = document.createElement('span');
        elemspan3.setAttribute('class','p1');
        elemspan3.appendChild(document.createTextNode('RDV le :'));
        elemdiv3.appendChild(elemspan3);
        
        elemdiv.appendChild(elemdiv3);
        
        let elemdiv5 = document.createElement('div');
        elemdiv5.setAttribute('class','grid-item');
        let elemspan5 = document.createElement('span');
        elemspan5.setAttribute('class','p1');
        elemspan5.appendChild(document.createTextNode(''));
        elemdiv5.appendChild(elemspan5);
        
        elemdiv.appendChild(elemdiv5);
        
        let elemdiv6 = document.createElement('div');
        elemdiv6.setAttribute('class','grid-item');
        let elemspan6 = document.createElement('span');
        elemspan6.setAttribute('class','p1');
        elemspan6.appendChild(document.createTextNode(''));
        elemdiv6.appendChild(elemspan6);
        
        elemdiv.appendChild(elemdiv6);

        fragment1.appendChild(elemdiv);

        reservations.forEach(data => {
            let elemdivdet = document.createElement('div');
            elemdivdet.setAttribute('id','det'.concat(data.id));
            elemdivdet.setAttribute('class','grid-container bg-light border border-primary justify-content-between align-items-center border p-3 col-sm rounded-2');
            
            let elemdiv1 = document.createElement('div');
            elemdiv1.setAttribute('class', 'grid-item');
            let elemspan1 = document.createElement('span');
            elemspan1.setAttribute('class', 'p1');
            elemspan1.appendChild(document.createTextNode(data.nom));
            elemdiv1.appendChild(elemspan1);
            elemdivdet.appendChild(elemdiv1);
            
            let elemdiv2 = document.createElement('div');
            elemdiv2.setAttribute('class', 'grid-item');
            let elemspan2 = document.createElement('span');
            elemspan2.setAttribute('class', 'p1');
            let elemhref2 = document.createElement('a');
            elemhref2.setAttribute('href', '#');
            let elemtext = document.createTextNode(data.salon.nomSalon);
            elemhref2.appendChild(elemtext);
            elemspan2.appendChild(elemhref2);
            elemdiv2.appendChild(elemspan2);
            elemdivdet.appendChild(elemdiv2);

            let elemdiv3 = document.createElement('div');
            elemdiv3.setAttribute('class', 'grid-item');
            let elemspan3 = document.createElement('span');
            elemspan3.setAttribute('class', 'p1');
            elemspan3.appendChild(document.createTextNode(data.date.toLocaleDateString()));
            elemdiv3.appendChild(elemspan3);
            elemdivdet.appendChild(elemdiv3);

            // let elemdiv4 = document.createElement('div');
            // elemdiv4.setAttribute('class', 'grid-item');
            // let elemspan4 = document.createElement('span');
            // elemspan4.setAttribute('class', 'p1');
            // elemspan4.appendChild(document.createTextNode(data.dateModif.toLocaleDateString()));
            // elemdiv4.appendChild(elemspan4);
            // elemdivdet.appendChild(elemdiv4);

            let elemdiv5 = document.createElement('div');
            elemdiv5.setAttribute('class', 'grid-item');
            let elembtn5 = document.createElement('button');
            elembtn5.setAttribute('id', 'v'.concat(data.id));
            elemdiv5.appendChild(elembtn5);
            let elemicon5 = document.createElement('i');
            elemicon5.setAttribute('id', 'vbt'.concat(data.id));
            elemicon5.setAttribute('class', 'bi bi-pencil bipencil p-1');
            elembtn5.appendChild(elemicon5);
            elemdivdet.appendChild(elemdiv5);

            let elemdiv6 = document.createElement('div');
            elemdiv6.setAttribute('class', 'grid-item');
            let elembtn6 = document.createElement('button');
            elembtn6.setAttribute('id', 's'.concat(data.id));
            elemdiv6.appendChild(elembtn6);
            let elemicon6 = document.createElement('i');
            elemicon6.setAttribute('id', 'sbt'.concat(data.id));
            elemicon6.setAttribute('class', 'bi bi-x bicross p-1');
            elembtn6.appendChild(elemicon6);
            elemdivdet.appendChild(elemdiv6);

            fragment1.appendChild(elemdivdet);
        });    
        
       } else {
            let elemdiv = document.createElement('div');
            let elemp = document.createElement('p');
            elemp.setAttribute('class','text-strong');
            elemp.appendChild(document.createTextNode('Pas de panier, pas de CHOCOLAT!'));
            elemdiv.appendChild(elemp);
            fragment1.appendChild(elemdiv);
    }
    

    let elemdivb = document.createElement('div');
    let elembutton2 = document.createElement('button');
    elembutton2.setAttribute('class', 'bsbtn1 btn mx-2 rounded-2');
    elembutton2.setAttribute('id', 'btres');
    let elemicon2 = document.createElement('i');
    elemicon2.setAttribute('class', 'bi bi-scissors');
    elemicon2.appendChild(document.createTextNode('Réservation'));
    elembutton2.appendChild(elemicon2);
    elemdivb.appendChild(elembutton2);
    fragment1.appendChild(elemdivb);

    if (form) {
            form.innerHTML = '';
            form.appendChild(fragment1);
            console.log(form);
    }
    document.getElementById('salonSelect').addEventListener('input', salonSelect);
    document.getElementById('bt1').addEventListener('click', dateSelect);
    reservations.forEach(elem => document.getElementById(`${'v'.concat(elem.id)}`).addEventListener('click', goToPanier));
    reservations.forEach(elem => document.getElementById(`${'s'.concat(elem.id)}`).addEventListener('click', supprimeReservation));
    document.getElementById('btres').addEventListener('click', goToReservation);
}

/******************Go to a selected panier************************/
function goToPanier(event){
    console.log('4 5 6');
    console.log(event.target.id);
    let id = Number(event.target.id.substr(3));
    console.log('coucou! je vais au panier wouf wouf');
    console.log(datas.reservations);
    event.preventDefault();
    console.log(datas.paniersDeleted);
    let goToURL = `./clientDetailPanier.html`;
    if (id) {
        datas.reservations.forEach((item) => {
            if (item.id === Number(id)) {
                goToURL += `?reservationID=${item.id}`;
            }
        })
        let parampanier = util.parseURL(document.URL);
        if (parampanier !== null) {
            if(parampanier.delete) {goToURL += `&delete=${parampanier.delete}`;}

            try {
                if (parampanier.rdv) {
                    console.log('WTF');
                    goToURL += `&rdv=`;
                    parampanier.rdv.split(',').forEach(item => goToURL += `${item},`);
                    goToURL = goToURL.substring(0,goToURL.length-1);
                    if (datas.paniersDeleted.length > 0) {
                        let uniquepaniersDeleted = datas.paniersDeleted.filter((value, index, self) => {return self.indexOf(value) === index;});
                        console.log(uniquepaniersDeleted);
                        let stringID = '';
                        uniquepaniersDeleted.forEach((item) => {
                            console.log(item);
                            if (item) {
                                stringID += `${item.id},`;
                            }
                        })
                        console.log(parampanier.rdv);
                        stringID = stringID.substring(0,stringID.length-1);
                        console.log(stringID);
                        console.log(util.findDifference(stringID, parampanier.rdv));
                        if (util.findDifference(stringID, parampanier.rdv).length !== 0) {
                            goToURL += `,${util.findDifference(stringID, parampanier.rdv)[0]}`;
                        }
                    }
                } else if (datas.paniersDeleted.length > 0) {
                    console.log(datas.paniersDeleted);
                    goToURL += '&rdv=';
                    datas.paniersDeleted.forEach((item,self) => {
                        console.log(item);
                        console.log(self);
                        goToURL += `${item.id},`;
                    })
                    goToURL = goToURL.substring(0,goToURL.length-1);
                }
            } catch (error) { console.log(error);
            } finally {
            }
        } else if (datas.paniersDeleted.length > 0) {
            console.log(datas.paniersDeleted);
            goToURL += '&rdv=';
            datas.paniersDeleted.forEach((item) => {
                goToURL += `${item.id},`;
            })
            goToURL = goToURL.substring(0,goToURL.length-1);
        }
        console.log(goToURL);
        document.location.href = goToURL;
    }
}

/******************permet la recherche des paniers par date************************/
function dateSelect(event) {
    console.log('Selecting Dates');
    event.preventDefault();
    console.log(event);
    let salons = new Array();
    let resaList = new Array();
    let dateAfter = event.srcElement.parentElement.form.panierDateAfter.value;
    let dateBefore = event.srcElement.parentElement.form.panierDateBefore.value;
    datas.reservations.forEach(item =>{
        salons.push(item.salon);
        if (dateAfter && dateBefore) {
            let dateAfterObj = new Date(dateAfter);
            let dateBeforeObj = new Date(dateBefore);
            if (item.date >= dateAfterObj && item.date <= dateBeforeObj) resaList.push(item);
        } else if (dateAfter) {
            let dateAfterObj = new Date(dateAfter);
            if (item.date >= dateAfterObj) resaList.push(item);
        } else if (dateBefore) {
            let dateBeforeObj = new Date(dateBefore);
            if (item.date <= dateBeforeObj) resaList.push(item);
        } else {resaList.push(item);}
    })
    console.log(resaList);
    let uniqueSalonsList = salons.filter((value, index, self) => {return self.indexOf(value) === index;});
    showClientPaniers(resaList,uniqueSalonsList, dateBefore, dateAfter);
}

/******************selectionne un salon et liste les paniers de ce salon************************/
function salonSelect(event){
    console.log('Selecting salon');
    console.log(event.target.value);
    let salonID = Number(event.target.value.substr(5));
    console.log(salonID);
    let resaList = new Array();
    let salons = new Array();
    let parampanier = util.parseURL(document.URL);
    console.log(parampanier);
    console.log(datas.reservations);
    if (parampanier !== null) {
        console.log(datas.paniersDeleted);
        datas.reservations.forEach((item, index, self) => {
            if (item.id === Number(parampanier.delete)) {
                datas.paniersDeleted.push(datas.reservations[Number(parampanier.delete)]);
                self.splice(index,1);
            }
        })
        if (parampanier.rdv) {
            datas.reservations.forEach((item, index, self) => {
                parampanier.rdv.split(',').forEach (elem => {
                    if (item.id === Number(elem)) {
                        datas.paniersDeleted.push(item);
                        self.splice(index,1);
                    }
                })
            })
        }
    } else if (datas.paniersDeleted.length > 0) {
        datas.reservations.forEach((item, index, self) => { 
            datas.paniersDeleted.forEach(elem => {
                if (item.id === elem.id) {
                    self.splice(index,1);
                }
            })
        })
    }
    if (salonID !== 0) {
        datas.reservations.forEach (elem => {
            console.log(elem);
            salons.push(elem.salon);
            if(elem.salon.id == salonID) resaList.push(elem);
        });
        console.log(`resaList : ${resaList}`);
        let uniqueSalonsList = salons.filter((value, index, self) => {return self.indexOf(value) === index;});
        console.log(uniqueSalonsList);
        showClientPaniers(resaList,uniqueSalonsList, '', '', salonID);
    }
}

/******************Supprime une reservation de la liste des paniers************************/
function supprimeReservation(event){
    console.log('10 11 12');
    console.log(event.target.id);
    console.log(event.target.id.substr(3));
    let id = event.target.id.substr(3);
    console.log('coucou! je supprime la réservation');
    console.log(datas.reservations);
    let storeURL = document.URL;
    let parampanier = util.parseURL(document.URL);
    datas.reservations.forEach((item, index, self) => {
        if (item.id === Number(id)) {
            console.log(item);
            datas.paniersDeleted.push(item);
            self.splice(index,1);
        }
    })
    if (parampanier !== null) {
        if (parampanier.rdv) {
            parampanier.rdv = parampanier.rdv.concat(`,${Number(id)}`);
            console.log(parampanier);
        }
    }
    console.log(datas.paniersDeleted);
    let salonsList = new Array();
    datas.reservations.forEach (item => salonsList.push(item.salon));
    let uniqueSalonsList = salonsList.filter((value, index, self) => {return self.indexOf(value) === index;});
    showClientPaniers(datas.reservations, uniqueSalonsList);
}

/******************Montre le panier d'un client************************/
function showClientPanier(reservation, modif=false){
    console.log('coucou Manchester! client Pas nier')
    console.log(reservation);
    let formHead = document.getElementById('actionPanier');
    formHead.setAttribute('name', 'actionPanier');
    formHead.setAttribute('method', 'get');
    formHead.setAttribute('class', 'd-inline');
    let fragment = document.createDocumentFragment();
    let elemh1 = document.createElement('h1');
    elemh1.setAttribute('id', 'titleDetailPanier');
    elemh1.setAttribute('class', 'h4 text-dark text-center d-inline mx-auto');
    let elemtxt1 = document.createTextNode('Détail de mon panier chez ');
    elemh1.appendChild(elemtxt1);
    let elemhref1 = document.createElement('a');
    elemhref1.setAttribute('href', '#');
    elemhref1.appendChild(document.createTextNode(`${reservation.salon.nomSalon}`));
    elemh1.appendChild(elemhref1);
    let elemtxt2 = document.createTextNode(` modifié le ${reservation.dateModif.toLocaleDateString()}`);
    elemh1.appendChild(elemtxt2);
    
    fragment.appendChild(elemh1);

    let elembuttondiv = document.createElement('div');
    let elembutton3 = document.createElement('button');
    elembutton3.setAttribute('id', 'bt1');
    elembutton3.setAttribute('class', 'd-inline-flex bsbtn2 btn mx-5 rounded-2');
    let elemicon3 = document.createElement('i');
    elemicon3.setAttribute('class', 'bi bi-trash-fill');
    let elemtxt3 = document.createTextNode('Supprimer la réservation');
    elemicon3.appendChild(elemtxt3);
    elembutton3.appendChild(elemicon3);

    //fragment.appendChild(elembutton3);
    
    let elembutton4 = document.createElement('button');
    elembutton4.setAttribute('id', 'bt4');
    elembutton4.setAttribute('class', 'd-inline-flex bsbtn2 btn mx-5 rounded-2');
    let elemicon4 = document.createElement('i');
    elemicon4.setAttribute('class', 'bi bi-view-list');
    let elemtxt4 = document.createTextNode('Retour à la liste');
    elemicon4.appendChild(elemtxt4);
    elembutton4.appendChild(elemicon4);

    elembuttondiv.appendChild(elembutton3);
    elembuttondiv.appendChild(elembutton4);
    //fragment.appendChild(elembutton4);

    fragment.appendChild(elembuttondiv);

    if (formHead) formHead.innerHTML = '';formHead.appendChild(fragment); console.log(formHead);

    let formDetail = document.getElementById('formDetailPanier');
        
    let fragment1 = document.createDocumentFragment();
    let elembr = document.createElement('br');
    
    console.log(reservation.services);
    reservation.services.forEach(data => {
        let elemdivdet = document.createElement('div');
        elemdivdet.setAttribute('class', 'grid-container justify-content-between p-3 col-sm border bg-light border-primary rounded-2 m-1');
        let elemdiv1 = document.createElement('div');
        elemdiv1.setAttribute('class', 'grid-item col-form-label col-form-label-sm');
        let elemlab1 = document.createElement('label');
        elemlab1.setAttribute('for', `s${data[0].id}1`);
        elemlab1.appendChild(document.createTextNode('Prestation:'));
        elemdiv1.appendChild(elemlab1);
        let elemselect1 = document.createElement('select');
        elemselect1.setAttribute('id', `s${data[0].id}1`);
        elemselect1.setAttribute('liste', 'prestations');
        elemselect1.setAttribute('name', 'prestas');
        elemselect1.setAttribute('class', 'rounded-2');
        elemselect1.setAttribute('disabled', 'true');
        let elemopt1 = document.createElement('option');
        elemopt1.appendChild(document.createTextNode('--prestations--'));
        elemopt1.setAttribute('value', '');
        elemselect1.appendChild(elemopt1);
        datas.prestations.forEach (item => {
            let elemopt2 = document.createElement('option');
            elemopt2.appendChild(document.createTextNode(`${item.nom}`));
            elemopt2.setAttribute('value', `prest${item.id}`);
            if (data[0].id === item.id) elemopt2.setAttribute('selected', 'true');
            elemselect1.appendChild(elemopt2);
        })
        elemdiv1.appendChild(elemselect1)
        elemdivdet.appendChild(elemdiv1);

        let elemdiv2 = document.createElement('div');
        elemdiv2.setAttribute('class', 'grid-item col-form-label col-form-label-sm');
        let elemlab2 = document.createElement('label');
        elemlab2.setAttribute('for', `p${data[0].id}2`);
        elemlab2.appendChild(document.createTextNode('Prix:'));
        elemdiv2.appendChild(elemlab2);
        elembr = document.createElement('br');
        elemdiv2.appendChild(elembr);
        let elemspan2 = document.createElement('span');
        elemspan2.setAttribute('id', `p${data[0].id}2`)
        elemspan2.setAttribute('class', 'p-1');
        elemspan2.appendChild(document.createTextNode(`${data[0].price}€`));
        elemdiv2.appendChild(elemspan2);
        elemdivdet.appendChild(elemdiv2);

        let elemdiv3 = document.createElement('div');
        elemdiv3.setAttribute('class', 'grid-item col-form-label col-form-label-sm');
        let elemlab3 = document.createElement('label');
        elemlab3.setAttribute('for', `p${data[0].id}3`);
        elemlab3.appendChild(document.createTextNode('Quantité:'));
        elemdiv3.appendChild(elemlab3);
        let eleminp3 = document.createElement('input');
        eleminp3.setAttribute('type', 'number');
        eleminp3.setAttribute('id', `p${data[0].id}3`);
        eleminp3.setAttribute('size', '2');
        eleminp3.setAttribute('min', '1');
        eleminp3.setAttribute('class', 'rounded-2 text-center');
        eleminp3.setAttribute('value', `${data[1]}`);
        elemdiv3.appendChild(eleminp3);
        elemdivdet.appendChild(elemdiv3);
        

        let elemdiv4 = document.createElement('div');
        elemdiv4.setAttribute('class', 'grid-item col-form-label col-form-label-sm');
        let elemlab4 = document.createElement('label');
        elemlab4.setAttribute('for', `p${data[0].id}4`);
        elemlab4.appendChild(document.createTextNode('Date-heure:'));
        elemdiv4.appendChild(elemlab4);
        elembr = document.createElement('br');
        elemdiv4.appendChild(elembr);
        let elemspan4 = document.createElement('span');
        elemspan4.setAttribute('id', `p${data[0].id}4`)
        elemspan4.setAttribute('class', 'p-1');
        elemspan4.appendChild(document.createTextNode(`${reservation.date}`));
        elemdiv4.appendChild(elemspan4);
        elemdivdet.appendChild(elemdiv4);
       

        let elemdiv5 = document.createElement('div');
        elemdiv5.setAttribute('class', 'grid-item col-form-label col-form-label-sm');
        let elemlab5 = document.createElement('label');
        elemlab5.setAttribute('for', `p${data[0].id}5`);
        elemlab5.appendChild(document.createTextNode('Option:'));
        elemdiv5.appendChild(elemlab5);
        elembr = document.createElement('br');
        elemdiv5.appendChild(elembr);
        let elemspan5 = document.createElement('span');
        elemspan5.setAttribute('id', `p${data[0].id}5`)
        elemspan5.setAttribute('class', 'p-1');
        elemspan5.appendChild(document.createTextNode(`${data[0].option}`));
        elemdiv5.appendChild(elemspan5);
        elemdivdet.appendChild(elemdiv5);
        
        let elemdiv6 = document.createElement('div');
        elemdiv6.setAttribute('class', 'grid-item col-form-label col-form-label-sm');
        let elemlab6 = document.createElement('label');
        elemlab6.setAttribute('for', `p${data[0].id}6`);
        elemlab6.appendChild(document.createTextNode('Total:'));
        elemdiv6.appendChild(elemlab6);
        elembr = document.createElement('br');
        elemdiv6.appendChild(elembr);
        let elemspan6 = document.createElement('span');
        elemspan6.setAttribute('id', `p${data[0].id}6`)
        elemspan6.setAttribute('class', 'p-1');
        elemspan6.appendChild(document.createTextNode(`${data[2]}€`));
        elemdiv6.appendChild(elemspan6);
        elemdivdet.appendChild(elemdiv6);

        let elemdiv7 = document.createElement('div');
        elemdiv7.setAttribute('class', 'grid-item col-form-label col-form-label-sm');
        let elemlab7 = document.createElement('label');
        elemlab7.setAttribute('for', `p${data[0].id}7`);
        elemlab7.appendChild(document.createTextNode('Modifier la ligne:'));
        elemdiv7.appendChild(elemlab7);
        elembr = document.createElement('br');
        elemdiv7.appendChild(elembr);
        if (modif) {
            let elemicon7 = document.createElement('i');
            elemicon7.setAttribute('id', `p${data[0].id}7`)
            elemicon7.setAttribute('class', 'bi bi-pencil bipencil p-1 col-sm');
            elemdiv7.appendChild(elemicon7);
        }
        elemdivdet.appendChild(elemdiv7);

        let elemdiv8 = document.createElement('div');
        elemdiv8.setAttribute('class', 'grid-item col-form-label col-form-label-sm');
        let elemlab8 = document.createElement('label');
        elemlab8.setAttribute('for', `p${data[0].id}8`);
        elemlab8.appendChild(document.createTextNode('Supprimer la ligne:'));
        elemdiv8.appendChild(elemlab8);
        elembr = document.createElement('br');
        elemdiv8.appendChild(elembr);
        let elemicon8 = document.createElement('i');
        elemicon8.setAttribute('id', `p${data[0].id}8`)
        elemicon8.setAttribute('class', 'bi bi-x bicross p-1 col-sm');
        elemdiv8.appendChild(elemicon8);
        elemdivdet.appendChild(elemdiv8);
                   
        fragment1.appendChild(elemdivdet);
        
    });
    let elemdiv = document.createElement('div');
    elemdiv.setAttribute('class', 'boldfonts d-flex justify-content-end text-decoration-underline');
    let elemp = document.createElement('p');
    let totalPanier = 0;
    reservation.services.forEach(data => totalPanier += data[2] );
    elemp.appendChild(document.createTextNode(`Total du panier : ${totalPanier}€`));
    elemdiv.appendChild(elemp);
    fragment1.appendChild(elemdiv);

    elemdiv = document.createElement('div');
    elemdiv.setAttribute('class', 'd-flex justify-content-end');

    let elembutton1 = document.createElement('button');
    elembutton1.setAttribute('class', 'bsbtn1 btn mx-auto rounded-2');
    elembutton1.setAttribute('id', 'bt2');
    let elemicon1 = document.createElement('i');
    elemicon1.setAttribute('class', 'bi bi-bag-plus');
    elemicon1.appendChild(document.createTextNode(`Ajouter une ligne`));
    elembutton1.appendChild(elemicon1);
    elemdiv.appendChild(elembutton1);

    let elembutton2 = document.createElement('button');
    elembutton2.setAttribute('class', 'bsbtn1 btn mx-auto rounded-2');
    elembutton2.setAttribute('id', 'bt3');
    let elemicon2 = document.createElement('i');
    elemicon2.setAttribute('class', 'bi bi-scissors');
    elemicon2.appendChild(document.createTextNode('Confirmer réservation'));
    elembutton2.appendChild(elemicon2);
    elemdiv.appendChild(elembutton2);

    fragment1.appendChild(elemdiv);
   
    if (formDetail) {
        formDetail.innerHTML = '';
        formDetail.appendChild(fragment1);
        console.log(formDetail);
        if (modif) {
            reservation.services.forEach(elem => document.getElementById(`${'p'.concat(elem[0].id)}7`).addEventListener('click', modifLignePanier));
        }
        reservation.services.forEach(elem => document.getElementById(`${'p'.concat(elem[0].id)}8`).addEventListener('click', supprimeLignePanier));
        reservation.services.forEach(elem => document.getElementById(`${'p'.concat(elem[0].id)}3`).addEventListener('input', updateLignePanier));
        document.getElementById('bt2').addEventListener('click', addLineToReservation);
        document.getElementById('bt3').addEventListener('click', goToReservation);
        document.getElementById('bt1').addEventListener('click', deleteReservation);
        document.getElementById('bt4').addEventListener('click', goToReservationsList);
    }
}

/*****************Retourne à la liste des réservations************************/
function goToReservationsList(event) {
    event.preventDefault();
    console.log(event.target.id);
    console.log(`Je retourne à la liste de réservations!`);
    console.log(document.location.pathname);
    let goToURL = `./clientPaniers.html?`;
    let parampanier = util.parseURL(document.URL);
    if (parampanier !== null) {
        if (parampanier.reservationID) goToURL += `reservationID=${(parampanier.reservationID)}`;
        if (parampanier.delete) goToURL += `&delete=${(parampanier.delete)}`;
        if (parampanier.rdv) {
            goToURL += `&rdv=${parampanier.rdv}`;
        }
    } else {
        console.log('oooupppssss!');
        if (datas.paniersDeleted.length > 0) {
            goToURL += '?rdv='; datas.paniersDeleted.forEach((item) => goToURL += `${item.id},`);
            goToURL = goToURL.substring(0,goToURL.length-1);
        }
    }
    console.log(goToURL);
    document.location.href = goToURL;
}


/******************recalcule la ligne de réservation et le total si la quantité change************************/
function updateLignePanier(event) {
    event.preventDefault();
    console.log('Too tired');
    console.log(event.target.id);
    console.log(document.URL);
    let storeURL = document.URL;
    let parampanier = util.parseURL(document.URL);
    if (parampanier !== null) {
        if (event.target.id.substr(0,1) === 'p') {
            datas.reservations.forEach((item) => {
                if (item.id === Number(parampanier.reservationID)) {
                    console.log(item);
                    item.services.forEach((elem) => {
                          if (elem[0].id == Number(event.target.id.substr(1,1))) { 
                            elem[1] = Number(document.getElementById(event.target.id).value);
                            elem[2] = elem[1] * Number(elem[0].price);
                            console.log(elem);
                            showClientPanier(item, true);
                        }    
                    })
                }
            })
        } 
    } else {
        console.log('No params in URL');
        console.log(storeURL);
        document.location.href = storeURL;
    }
}

/******************Lien vers la ligne de réservation , not yet implemented***********************/
function modifLignePanier(event){
    event.preventDefault();
    console.log(`Je modifie ma réservation`);
}

/******************supprime une ligne de la réservation************************/
function supprimeLignePanier(event){
    console.log(`Je supprime une ligne de ma réservation`);
    event.preventDefault();
    console.log(event.target.id);
    console.log(document.URL);
    let storeURL = document.URL;
    let parampanier = util.parseURL(document.URL);
    let id = Number(event.target.id.substr(1,1));
    console.log(id);
    if (parampanier !== null) {
        if (event.target.id.substr(0,1) === 'p') {
            datas.reservations.forEach((item, index, self) => {
                if (item.id === Number(parampanier.reservationID)) {
                    console.log(item);
                    let ind = item.services.findIndex(item => item[0].id === id);
                    console.log(item.services[ind])
                    self[index].services.splice(ind,1);
                    showClientPanier(item);
                }
            })
        } 
    } else {
        console.log('No params in URL');
        console.log(storeURL);
        document.location.href = storeURL;
    }
}

/******************Ajoute une ligne à la réservation, not yet implemented************************/
function addLineToReservation(event) {
    event.preventDefault();
    console.log(`Je m'en vais à la réservation!`);
}

/******************Lien vers la réservation, not yet implemented************************/
function goToReservation(event) {
    event.preventDefault();
    console.log(`Je me dirige vers la réservation!`);
}

/******************supprime une réservation************************/
function deleteReservation(event) {
    event.preventDefault();
    console.log(event.target.id);
    console.log(`Je supprime ma réservation!`);
    console.log(document.location.pathname);
    let goToURL = `./clientPaniers.html?`;
    let parampanier = util.parseURL(document.URL);
    if (parampanier !== null) {
        if (parampanier.reservationID) goToURL += `delete=${(parampanier.reservationID)}`;
        if (parampanier.delete) {
            datas.reservations.forEach((item, index, self) => {if (item.id === Number(parampanier.delete)) datas.paniersDeleted.push(self[index]);self.splice(index,1);});
        } 
        if (parampanier.rdv) {
            parampanier.rdv = parampanier.rdv.concat(`,${parampanier.reservationID}`);
            goToURL += `&rdv=${parampanier.rdv}`;
            parampanier.rdv.split(',').forEach((item) => {
                datas.reservations.forEach((elem, index, self) => { if (elem.id === item.id);datas.paniersDeleted.push(self[index]);self.splice(index,1);})
            })
        }
    } else {
        console.log('oooupppssss!');
        if (datas.paniersDeleted.length > 0) {
            goToURL += '&rdv='; datas.paniersDeleted.forEach((item) => goToURL += `${item.id},`);
            goToURL = goToURL.substring(0,goToURL.length-1);
        }
    }
    console.log(goToURL);
    document.location.href = goToURL;
}

/******************Propose les options de prestations************************/
function showPrestationsOptions(prestations) {
    let opt = document.querySelectorAll('[id^="s"]');
    if (opt) console.log(opt);
    opt.forEach(item => {
        item.innerHTML = '';
        let fragment = document.createDocumentFragment();
        item.addEventListener('input',optionPrestaSelected);
        let elemopt = document.createElement('option');
        elemopt.appendChild(document.createTextNode('--prestations--'));
        fragment.appendChild(elemopt);
    
        prestations.forEach(data => {
            elemopt = document.createElement('option');
            elemopt.appendChild(document.createTextNode(`${data.nom}`));
            elemopt.setAttribute('value', `${data.id}`);
            fragment.appendChild(elemopt);
        })
        console.log(fragment);
        console.log(item);
        item.appendChild(fragment);
    });
}
