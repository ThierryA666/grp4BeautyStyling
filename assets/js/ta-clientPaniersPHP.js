document.addEventListener('DOMContentLoaded', () => {
    "use strict";
    if ((document.location.pathname ==='/src/panier/suppression') || (document.location.pathname ==='/src/paniers')) {
        function suppPanier (event) {
            event.preventDefault();
            let modal = document.getElementById('dialogConfirm');
            modal.addEventListener('show.bs.modal', $(document).ready(function () {
                // Get the button that triggered the modal
                let button = event.target;
                let reservation = button.getAttribute('data-reservation');
                let id = button.getAttribute('data-id');
                let modalBody = modal.querySelector('.modal-body');
                modalBody.innerHTML = '';
                let fragment = document.createDocumentFragment();
                let elemp = document.createElement('p');
                elemp.appendChild(document.createTextNode('Etes vous sur de vouloir supprimer la réservation : ' + reservation + '?'));
                fragment.appendChild(elemp);
                modalBody.appendChild(fragment);
                let clikOK = document.getElementById('actionModal');
                clikOK.addEventListener('click' , function () {
                    let form = document.getElementById('suppReservation' + id);
                    $(form).submit();
                })
            }));
        }
        let whichReservation = document.querySelectorAll('.bsIconButtonTrash');
        whichReservation.forEach(el => {
            el.addEventListener('click', suppPanier);
        })
    }        
    if (document.location.pathname ==='/src/panierDetail') {
        function suppReservation (event) {
            event.preventDefault();
            let modal = document.getElementById('dialogConfirm');
            modal.addEventListener('show.bs.modal', $(document).ready(function () {
                // Get the button that triggered the modal
                let button = event.target;
                let reservation = button.getAttribute('data-reservation');
                let id = button.getAttribute('data-id');
                let modalBody = modal.querySelector('.modal-body');
                modalBody.innerHTML = '';
                let fragment = document.createDocumentFragment();
                let elemp = document.createElement('p');
                elemp.appendChild(document.createTextNode('Etes vous sur de vouloir supprimer la réservation : ' + reservation + '?'));
                fragment.appendChild(elemp);
                modalBody.appendChild(fragment);
                let form = $('#reservationSupp');
                $(form).find('input[name="suppReservation"]').val(id);
                let clikOK = document.getElementById('actionModal');
                clikOK.addEventListener('click' , function () {
                    let form = $('#reservationSupp');
                    console.dir($(form).find('input[name="reservation"]')[0].value);
                    //console.dir(form);
                    $(form).submit();
                })
            }));
        }
        let whichResa = document.getElementById('suppReservation');
        whichResa.addEventListener('click', suppReservation);
    }
    function popUpSalon(event) {
        event.preventDefault(); // Prevent the default action of the link
        //console.dir(event.target.attributes.value.nodeValue);
        // Parameters to pass to the new window
        let $salonID = event.target.attributes.value.nodeValue;
        // Construct the URL with parameters
        let $url = 'popupsalon?salonID=' + encodeURIComponent($salonID);
        // Open the new window
        window.open($url, 'PopupWindow', 'width=600,height=400');
    }

    if (document.location.pathname ==='/src/paniers') {
        let $popUps = document.querySelectorAll('#popUpSalon');
        $popUps.forEach( popup => {
            popup.addEventListener('click', popUpSalon);
        });
    }
    if (document.location.pathname ==='/src/popupsalon') {
        document.getElementById('closePopup').addEventListener('click', function() { window.close();});
    }

    if (document.location.pathname ==='/src/panierDetail') {
        document.getElementById('popUpSalon').addEventListener('click', popUpSalon);
    };
    
});

