<<<<<<< HEAD
export class Reservation {
    #date;
    #heure;
    #services;
    #details;
    #client;
    #salon

    constructor(date, heure, services, details, client, salon){
        this.#date = date;
        this.#heure = heure;
        this.#services = services;
        this.#details = details;
        this.#client = client;
        this.#salon = salon;
    }

    get date()          {return this.#date}
    get heure()         {return this.#heure}
    get services()      {return this.#services}
    get details()       {return this.#details}
    get client()        {return this.#client}
    get salon()         {return this.#salon}

    set date(date)              {this.#date = date}
    set heure(heure)            {this.#heure = heure}
    set services(services)      {this.#services = services}
    set details(details)        {this.#details = details}
    set client(client)          {this.#client = client}
    set salon(salon)            {this.#salon = salon}

}

let client1 = new Reservation(' 15 Février 2024 ', ' 10:30 h ', ' coupe homme ', ' aucun détail ', 'Thierry');
let client2 = new Reservation(' 27 Février 2024 ', ' 11:30 h ', ' coupe femme ', ' aucun détail ', 'Takako');
let client3 = new Reservation(' 15 Mars 2024 ', ' 14:30 h ', ' coupe + brushing femme ', ' aucun détail ', 'Hermine');
let client4 = new Reservation(' 30 Mars 2024 ', ' 16:00 h ', ' coupe + coloration homme ', ' aucun détail ', 'Paul');
let client5 = new Reservation(' 11 Avril 2024 ', ' 10:00 h ', ' coloration femme', ' aucun détail ', 'María');

export let clients = [client1, client2, client3, client4, client5];

=======
export class Reservation {
    #date;
    #heure;
    #services;
    #details;
    #client;
    #salon

    constructor(date, heure, services, details, client, salon){
        this.#date = date;
        this.#heure = heure;
        this.#services = services;
        this.#details = details;
        this.#client = client;
        this.#salon = salon;
    }

    get date()          {return this.#date}
    get heure()         {return this.#heure}
    get services()      {return this.#services}
    get details()       {return this.#details}
    get client()        {return this.#client}
    get salon()         {return this.#salon}

    set date(date)              {this.#date = date}
    set heure(heure)            {this.#heure = heure}
    set services(services)      {this.#services = services}
    set details(details)        {this.#details = details}
    set client(client)          {this.#client = client}
    set salon(salon)            {this.#salon = salon}

}

let client1 = new Reservation(' 15 Février 2024 ', ' 10:30 h ', ' coupe homme ', ' aucun détail ', 'Thierry');
let client2 = new Reservation(' 27 Février 2024 ', ' 11:30 h ', ' coupe femme ', ' aucun détail ', 'Takako');
let client3 = new Reservation(' 15 Mars 2024 ', ' 14:30 h ', ' coupe + brushing femme ', ' aucun détail ', 'Hermine');
let client4 = new Reservation(' 30 Mars 2024 ', ' 16:00 h ', ' coupe + coloration homme ', ' aucun détail ', 'Paul');
let client5 = new Reservation(' 11 Avril 2024 ', ' 10:00 h ', ' coloration femme', ' aucun détail ', 'María');

export let clients = [client1, client2, client3, client4, client5];

>>>>>>> a6980d88292d460c429dea4d66edcf90a6e13bb2
console.log(clients);