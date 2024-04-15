

class Reservation {
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
       
const {test} = QUnit;

test('T1 - assert.false()', assert => {
    const bool = false;
    assert.false(bool, false);
});     // Passed


// comparaison de type 1 == '1'  vrai
test('T2a - assert.equal()', assert => {
    const nb = '1';
    assert.equal(nb,'1');
});     // Passed
test('T2b - assert.equal()', assert => {
    const nb = '1';
    assert.equal(nb,1);
});

// comparaison de type 1 === '1'   faux
test('T3a - assert.deepEqual()', assert => {
    const nb = '1';
    assert.deepEqual(nb,'1');
});     // Passed
test('T3b - assert.deepEqual()', assert => {
    const nb = '1';
    assert.deepEqual(nb,1);
});     // Failed

test('T4 - assert.propContains()', assert => {
    const user1 = new User('Paul','Durand');
    assert.propContains(user1,{nom : 'Durand'});
});     // Passed