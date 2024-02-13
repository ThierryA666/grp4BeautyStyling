/******************Classe Salon******************************************/
export class SalonData{
    #id = this.#newSalonID();
    #creationDate 
    #nom;
    #prenom;
    #ad1;
    #ad2;
    #email;
    #tel;
    #codePostale;
    #ville;
    #nomSalon; 
    #url;
    #photo;
    #motDePasse;
    
    #newSalonID(){
        SalonData.nextSalonID.increment();
        return SalonData.nextSalonID.getValue();
    };

    static nextSalonID= (() => {
        let staticCount = 0;
        return {
          getValue: () => staticCount,
          increment: () => staticCount++,
        };
      })();

    constructor(creationDate, nom, prenom, ad1, ad2, email, tel, codePostale, ville, nomSalon, url, photo, motDePasse){
        this.nom = nom;
        this.prenom = prenom;
        this.ad1 = ad1;
        this.ad2 = ad2;
        this.email = email;
        this.tel = tel;
        this.codePostale = codePostale;
        this.ville = ville;
        this. nomSalon = nomSalon;
        this.url = url;
        this.photo = photo;
        this.motDePasse = motDePasse;
        this.#creationDate = creationDate
    } 
    get id()            {return this.#id;} 
    get creationdate()  {return this.#creationDate;}
    get nom()           {return this.#nom;}
    get prenom()        {return this.#prenom;}
    get ad1()           {return this.#ad1;}
    get ad2()           {return this.#ad2;}
    get email()         {return this.#email;}
    get tel()           {return this.#tel;}
    get codePostale()   {return this.#codePostale;}
    get ville()         {return this.#ville;}
    get nomSalon()      {return this.#nomSalon;}
    get url()           {return this.#url;}
    get photo()         {return this.#photo;}
    get motDePasse()    {return this.#motDePasse;}

    //set creationDate(creationDate)  {this.#creationDate = creationDate}
    set nom(nom)                    {this.#nom = nom}
    set prenom(prenom)              {this.#prenom = prenom}
    set ad1(ad1)                    {this.#ad1 = ad1}
    set ad2(ad2)                    {this.#ad2 = ad2}
    set email(email)                {this.#email = email}
    set tel(tel)                    {this.#tel = tel}
    set codePostale(codePostale)    {this.#codePostale = codePostale}
    set ville(ville)                {this.#ville = ville}
    set nomSalon(nomSalon)          {this.#nomSalon = nomSalon}
    set url(url)                    {this.#url = url}
    set photo(photo)                {this.#photo = photo}
    set motDePasse(motDePasse)      {this.#motDePasse = motDePasse}
    set creationDate(creationDate)  {this.#creationDate = creationDate}

    toString(){return `Salon ID: ${this.#id}, Date de création: ${this.#creationDate}, Nom: ${this.#nom}, Prénom:${this.#prenom}, Aderesse1:${this.#ad1}, Aderesse2: ${this.#ad2}, Email: ${this.#email}, Tel: ${this.#tel}, Code Postale: ${this.#codePostale}, Ville: ${this.#ville}, Nom de Salon: ${this.#nomSalon}, URL: ${this.#url} `};
}

/******************Classe Reservation******************************************/
export class Reservation {
    #id = this.#newReservationID();
    #nom;
    #salon;
    #client = 'toti';
    #dateCreation = new Date('05/03/2021');
    #dateModif;
    #dateRDV;
    #prestations;
    
    #newReservationID() {
        Reservation.nextReservationID.increment();
        return Reservation.nextReservationID.getValue();
    };
    
    static nextReservationID = (() => {
        let staticCount = 0;
        return {
          getValue: () => staticCount,
          increment: () => staticCount++,
        };
      })();
   

    constructor(nom, dateRDV, salon) {
        this.#nom = nom;
        this.#salon = salon;
        this.#prestations = new Array();
        this.#dateRDV = dateRDV;
        this.#dateCreation;
        this.#dateModif = this.#dateCreation;
    }

    //getter
    get id() {return this.#id;}
    get nom() {return this.#nom;}
    get salon() {return this.#salon;}
    get dateCreation() {return this.#dateCreation;}
    get dateModif() {return this.#dateModif;}
    get prestations() {return this.#prestations;}
    get dateRDV() {return this.#dateRDV;}
    get client() {return this.#client}

    //setter
    set nom(nom) {this.nom = nom;}
    set salon(salon) {this.#salon = salon;}
    set dateCreation(dateCreation) {this.#dateCreation = dateCreation;}
    set dateModif(dateModif) {this.#dateModif = dateModif;}
    set prestations(prestations) {this.#prestations = prestations;}
    set client(client) {this.#client = client;}
    set dateRDV(dateRDV) {this.#dateRDV = dateRDV;}
    
    toString() { return `{"id":"${this.#id}","nom":"${this.#nom}","salon":"${this.#salon}","client":"${this.#client}"},"dateCreation":"${this.#dateCreation}","dateModif":"${this.#dateModif}"},"dateRDV":"${this.#dateRDV}"}`};
    addPrestationToReservation(prestation, quantite) {
        let total = Number(prestation.price) * quantite;
        let rdv = [prestation, quantite, total];
        this.#prestations.push(rdv);
    }
}
/******************Classe Panier Client******************************************/
export class PanierClient {
    #id = this.#newPanierID();
    #nom;
    #salon;
    #dateCreation;
    #dateModif;
    #prestations;
    
    #newPanierID() {
        PanierClient.nextPanierID.increment();
        return PanierClient.nextPanierID.getValue();
    };
    
    static nextPanierID = (() => {
        let staticCount = 0;
        return {
          getValue: () => staticCount,
          increment: () => staticCount++,
        };
      })();
   

    constructor(nom, dateCreation, salon, option) {
        this.#nom = nom;
        this.#salon = salon;
        this.#dateCreation = dateCreation;
        this.#dateModif = this.#dateCreation;
        this.#prestations = new Array();
    }

    //getter
    get id() {return this.#id;}
    get nom() {return this.#nom;}
    get salon() {return this.#salon;}
    get dateCreation() {return this.#dateCreation;}
    get dateModif() {return this.#dateModif;}
    get prestations() {return this.#prestations;}

    //setter
    set nom(nom) {this.nom = nom;}
    set salon(salon) {this.#salon = salon;}
    set dateCreation(dateCreation) {this.#dateCreation = dateCreation;}
    set dateModif(dateModif) {this.#dateModif = dateModif;}
    set prestations(prestations) {this.#prestations = prestations;}
    
    toString() { return `{"id":"${this.#id}","nom":"${this.#nom}","salon":"${this.#salon}","dateCreation":"${this.#dateCreation}","dateModif":"${this.#dateModif}"}`};
    addPrestationToPanier(prestation) {
        this.prestations.push(prestation);
    }
}

/******************Classe SalonPrestation******************************************/
export class SalonPrestation {
    #id = this.#newPrestaID();
    #nom;
    #duration;
    #description;
    #price;
    #option;
    #creationDate;
    #modifDate;

    #newPrestaID() {
        SalonPrestation.nextPrestaID.increment();
        return SalonPrestation.nextPrestaID.getValue();
    };
    
    static nextPrestaID = (() => {
        let staticCount = 0;
        return {
          getValue: () => staticCount,
          increment: () => staticCount++,
        };
      })();
   

    constructor(nom, duration, description, price, option) {
        this.#nom = nom;
        this.#duration = duration;
        this.#description = description;
        this.#price = price;
        this.#option = option;
        this.#creationDate = new Date();
        this.#modifDate = this.creationDate;
    }

    //getter
    get id() {return this.#id;}
    get nom() {return this.#nom;}
    get duration() {return this.#duration;}
    get description() {return this.#description;}
    get price() {return this.#price;}
    get option() {return this.#option;}
    get creationDate() {return this.#creationDate;}
    get modifDate() {return this.#modifDate;}
    
    //setter
    set nom(nom) {if (nom.length > 1) {
            this.nom = nom;
        } else {
            this.nom = '';
        }
    }
    set duration(duration) {this.#duration = duration;}
    set description(desc) {this.#description = desc;}
    set price(price) {this.#price = price;}
    set option(option) {this.#option = option;}
    set modifDate(modifDate) {this.#modifDate = modifDate;}

    toString() { return `{"nom":"${this.#nom}","id":"${this.#id}","duration":"${this.#duration}","description":"${this.#description}","price":"${this.#price}"}`};
}

/******************Initialisation des données******************************************/
export let salon001 = new SalonData (new Date('03/04/2017'), "CLAIR","Agathe","140 Rue de Créqui","","abc@gmail.com","0611223344","69006","Lyon","Julie Borne Coiffure Création ","","salon1.jpg","dnPf5z9OQz07CBv");
export let salon002 = new SalonData (new Date('12/01/2020'), "Théberge","Channing ","27, Avenue De Marlioz","","ChanningTheberge@rhyta.com","0125547928","92160","ANTONY","Salon Antony","www.ComedyDiary.fr","salon2.jpg","Jee1ceeXin");
export let salon003 = new SalonData (new Date('01/01/2000'), "Aupry","Guy","81, rue Marie de Médicis","","GuyAupry@dayrep.com","0458098057","34500","BÉZIERS","Salon Guy","www.guy-salon.fr","salon3.jpg","EeW7iechu");
export let salon004 = new SalonData (new Date('09/12/2019'), "Tessier","Laurent","3 Rue Neuve","","LaurentTessier@rhyta.com","0461124244","69001","Lyon","Red Studio","","salon4.jpg","eichia4ahS");
export let salon005 = new SalonData (new Date('03/04/2012'), "Magnolia","Sciverit","77, quai Saint-Nicolas","","MagnoliaSciverit@rhyta.com","0365847757","59200","TOURCOING","Frédéric Moréno","","salon5.jpg","IeNgangu4u");


export var salons = [salon001,salon002,salon003,salon004,salon005]
console.log(salons);

export let prestations = new Array();
let presta1 = new SalonPrestation('Coupe Homme', 1, 'Coupe ciseaux et tondeuse',20, 'Maria');
let presta2 = new SalonPrestation('Coupe Femme', 1, 'Coupe ciseaux et peigne',30, 'Takako');
let presta3 = new SalonPrestation('Shampooing', 1, 'Shampooing et séchage',15,'Thierry');
let presta4 = new SalonPrestation('Meches', 3, 'Balayage de couleurs differentes',40, 'Hermine');
let presta5 = new SalonPrestation('Couleur', 2, 'Couleur integrale',30, 'Maria');
let presta6 = new SalonPrestation('Coupe enfant', 1, 'Coupe ciseaux et tondeuse',15, 'Takako');
let presta7 = new SalonPrestation('Barbe homme', 2, 'Soins pour la barbe',20, 'Hermine');

prestations.push(presta1);
prestations.push(presta2);
prestations.push(presta3);
prestations.push(presta4);
prestations.push(presta5);
prestations.push(presta6);
prestations.push(presta7);

console.log(`Prestations (data.js) : ${prestations}`);

let res1 = new Reservation('rdv1', new Date('01/02/2022 14:00:00'), salon001);
let res2 = new Reservation('rdv2', new Date('01/02/2021 13:00:00'), salon002);
let res3 = new Reservation('rdv3', new Date('12/04/2023 11:00:00'), salon003);
let res4 = new Reservation('MonRdv', new Date('05/31/2023 12:00:00'), salon003);
let res5 = new Reservation('rdv5', new Date('04/15/2022 17:00:00'), salon005);
let res6 = new Reservation('rdvTiti', new Date('04/15/2023 17:00:00'), salon005);

res1.addPrestationToReservation(presta1, 1);
res1.addPrestationToReservation(presta3, 1);
res1.addPrestationToReservation(presta4, 1);

res2.addPrestationToReservation(presta7, 1);
res2.addPrestationToReservation(presta6, 2);

res3.addPrestationToReservation(presta7, 3);
res3.addPrestationToReservation(presta1, 1);

res4.addPrestationToReservation(presta6, 2);

res5.addPrestationToReservation(presta7, 1);

res5.addPrestationToReservation(presta3, 3);
res5.addPrestationToReservation(presta2, 1);

res6.addPrestationToReservation(presta3, 1);

export let reservations = new Array();
reservations.push(res1);
reservations.push(res2);
reservations.push(res3);
reservations.push(res4);
reservations.push(res5);
reservations.push(res6);

console.log(`Réservations (data.js) : ${reservations}`);

export let paniersDeleted = new Array();
console.log(paniersDeleted);
