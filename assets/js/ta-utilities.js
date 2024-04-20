<<<<<<< HEAD
//utilities functions

export function findDifference(str1, str2) {
    const set1 = new Set(str1);
    const set2 = new Set(str2);
  
    const uniqueChars1 = [...set1].filter(char => !set2.has(char));
    const uniqueChars2 = [...set2].filter(char => !set1.has(char));
  
    const difference = uniqueChars1.concat(uniqueChars2).join('');

    return [...difference];
}
  
export function isValidTextField(ch) {
    let bool = false;
    if ((typeof ch === "string") && (ch.length > 1) && isAlphaString(ch)) {bool = true};
    return bool;
}

export function isNumeric(nbr) {
    return /^[0-9]+$/.test(nbr);
}

function isAlphaString(str) {
    return /^[a-zA-Z0-9 éèêôàùïîç]+$/.test(str);
}

export function parseURL(url) {
    let queryString = window.location.search;
    // Créez un objet pour stocker les paramètres
    let params = {};
    const urlParams = new URLSearchParams(window.location.search);
    console.log(urlParams);
    // Supprimez le point d'interrogation du début de la chaîne de requête
    queryString = queryString.substring(1);
    if (queryString !== '') {
        console.log(`queryString : ${queryString}`);
        // Divisez la chaîne de requête en paires clé-valeur
        let queryParams = queryString.split('&');
        console.log(queryParams);
        
        if (queryParams.length > 1){
        // Parcourez les paires clé-valeur et ajoutez-les à l'objet params
            queryParams.forEach(param => {
                let [key, value] = param.split('=');
                params[key] = decodeURIComponent(value);
                console.log(`paramsif : ${params[key]}`);
            });
        } else {
            let [key,value] = queryString.split('=');
            params[key] = decodeURIComponent(value);
            console.log(`paramselse : ${params[key]}`);
        }
        // Maintenant, vous avez les valeurs des paramètres dans l'objet params
        console.log(`paramsoutside : ${params}`);
    } else {
        console.log(`queryString is empty : ${queryString}`);
        params = null;
    }
    return params;
=======
//utilities functions

export function findDifference(str1, str2) {
    const set1 = new Set(str1);
    const set2 = new Set(str2);
  
    const uniqueChars1 = [...set1].filter(char => !set2.has(char));
    const uniqueChars2 = [...set2].filter(char => !set1.has(char));
  
    const difference = uniqueChars1.concat(uniqueChars2).join('');

    return [...difference];
}
  
export function isValidTextField(ch) {
    let bool = false;
    if ((typeof ch === "string") && (ch.length > 1) && isAlphaString(ch)) {bool = true};
    return bool;
}

export function isNumeric(nbr) {
    return /^[0-9]+$/.test(nbr);
}

function isAlphaString(str) {
    return /^[a-zA-Z0-9 éèêôàùïîç]+$/.test(str);
}

export function parseURL(url) {
    let queryString = window.location.search;
    // Créez un objet pour stocker les paramètres
    let params = {};
    const urlParams = new URLSearchParams(window.location.search);
    console.log(urlParams);
    // Supprimez le point d'interrogation du début de la chaîne de requête
    queryString = queryString.substring(1);
    if (queryString !== '') {
        console.log(`queryString : ${queryString}`);
        // Divisez la chaîne de requête en paires clé-valeur
        let queryParams = queryString.split('&');
        console.log(queryParams);
        
        if (queryParams.length > 1){
        // Parcourez les paires clé-valeur et ajoutez-les à l'objet params
            queryParams.forEach(param => {
                let [key, value] = param.split('=');
                params[key] = decodeURIComponent(value);
                console.log(`paramsif : ${params[key]}`);
            });
        } else {
            let [key,value] = queryString.split('=');
            params[key] = decodeURIComponent(value);
            console.log(`paramselse : ${params[key]}`);
        }
        // Maintenant, vous avez les valeurs des paramètres dans l'objet params
        console.log(`paramsoutside : ${params}`);
    } else {
        console.log(`queryString is empty : ${queryString}`);
        params = null;
    }
    return params;
>>>>>>> b3737144e9af770f87c5acb1ac273df8b56038c9
}   