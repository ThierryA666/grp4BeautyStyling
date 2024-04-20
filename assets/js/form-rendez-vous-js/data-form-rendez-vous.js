/******************Classe SalonPrestation (Thierry)******************************************/
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

//class Salon (Takako)

class SalonData{
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
        this,creationDate = creationDate;
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
        this. motDePasse = motDePasse;
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

    set creationDate(creationDate)  {this.#creationDate = creationDate}
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

    toString(){return `Salon ID: ${this.#id}, Date de création: ${this.#creationDate}, Nom: ${this.#nom}, Prénom:${this.#prenom}, Aderesse1:${this.#ad1}, Aderesse2: ${this.#ad2}, Email: ${this.#email}, Tel: ${this.#tel}, Code Postale: ${this.#codePostale}, Ville: ${this.#ville}, Nom de Salon: ${this.#nomSalon}, URL: ${this.#url} `};
}

let salon001 = new SalonData (new Date('08/02/2024'),"CLAIR","Agathe","140 Rue de Créqui","","abc@gmail.com","0611223344","69006","Lyon","Julie Borne Coiffure Création ","","salon1.jpg","dnPf5z9OQz07CBv");
let salon002 = new SalonData (new Date('08/02/2024'),"Théberge","Channing ","27, Avenue De Marlioz","","ChanningTheberge@rhyta.com","0125547928","92160","ANTONY","Salon Antony","www.ComedyDiary.fr","salon2.jpg","Jee1ceeXin");
let salon003 = new SalonData (new Date('08/02/2024'),"Aupry","Guy","81, rue Marie de Médicis","","GuyAupry@dayrep.com","0458098057","34500","BÉZIERS","Salon Guy","www.guy-salon.fr","salon3.jpg","EeW7iechu");
let salon004 = new SalonData (new Date('08/02/2024'),"Tessier","Laurent","3 Rue Neuve","","LaurentTessier@rhyta.com","0461124244","69001","Lyon","Red Studio","","salon4.jpg","eichia4ahS");
let salon005 = new SalonData (new Date('08/02/2024'),"Magnolia","Sciverit","77, quai Saint-Nicolas","","MagnoliaSciverit@rhyta.com","0365847757","59200","TOURCOING","Frédéric Moréno","","salon5.jpg","IeNgangu4u");


export var salons = [salon001,salon002,salon003,salon004,salon005]