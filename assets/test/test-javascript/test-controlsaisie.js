<<<<<<< HEAD


function controlSaisie(date, detail){

    if (date===Number(date)) {
        return "Une erreur s'est produite, tapez une date (Ex: 15 Février 2024)";
    } 
    else if (date===""){
       return "Une erreur s'est produite, tapez une date (Ex: 15 Février 2024)";
    } 
    else if (detail===Number(detail)){
       return "Une erreur s'est produite, tapez votre message";
    } 
    else {
        return "donnees()";
    }
}
    
    
const {test} = QUnit;
    test('T1a - cas nominal', function(assert) {
        assert.equal(controlSaisie(10, 'aucun'), "Une erreur s'est produite, tapez une date (Ex: 15 Février 2024)");
    });
    test('T2 - cas nominal', function(assert) {
        assert.equal(controlSaisie("", 'aucun'), "Une erreur s'est produite, tapez une date (Ex: 15 Février 2024)");
    });
    test('T3 - cas nominal', function(assert) {
        assert.equal(controlSaisie('15 Février', 5), "Une erreur s'est produite, tapez votre message");
    });
    test('T4 - cas nominal', function(assert) {
        assert.equal(controlSaisie('15 Février', 'aucun'), "donnees()");
=======


function controlSaisie(date, detail){

    if (date===Number(date)) {
        return "Une erreur s'est produite, tapez une date (Ex: 15 Février 2024)";
    } 
    else if (date===""){
       return "Une erreur s'est produite, tapez une date (Ex: 15 Février 2024)";
    } 
    else if (detail===Number(detail)){
       return "Une erreur s'est produite, tapez votre message";
    } 
    else {
        return "donnees()";
    }
}
    
    
const {test} = QUnit;
    test('T1a - cas nominal', function(assert) {
        assert.equal(controlSaisie(10, 'aucun'), "Une erreur s'est produite, tapez une date (Ex: 15 Février 2024)");
    });
    test('T2 - cas nominal', function(assert) {
        assert.equal(controlSaisie("", 'aucun'), "Une erreur s'est produite, tapez une date (Ex: 15 Février 2024)");
    });
    test('T3 - cas nominal', function(assert) {
        assert.equal(controlSaisie('15 Février', 5), "Une erreur s'est produite, tapez votre message");
    });
    test('T4 - cas nominal', function(assert) {
        assert.equal(controlSaisie('15 Février', 'aucun'), "donnees()");
>>>>>>> a6980d88292d460c429dea4d66edcf90a6e13bb2
});