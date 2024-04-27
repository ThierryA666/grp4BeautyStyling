document.addEventListener('DOMContentLoaded', () => {
    "use strict";
    if ((document.location.pathname ==='/src/prestations/suppression') || (document.location.pathname ==='/src/prestations')) {
        function addTextToModal (event) {
            event.preventDefault();
            let modal = document.getElementById('dialogConfirm');
            modal.addEventListener('show.bs.modal', $(document).ready(function () {
                // Get the button that triggered the modal
                let button = event.target;
                let prestation = button.getAttribute('data-prestation');
                let id = button.getAttribute('data-id');
                let modalBody = modal.querySelector('.modal-body');
                modalBody.innerHTML = '';
                let fragment = document.createDocumentFragment();
                let elemp = document.createElement('p');
                elemp.appendChild(document.createTextNode('Etes vous sur de vouloir supprimer la prestation : ' + prestation + '?'));
                fragment.appendChild(elemp);
                modalBody.appendChild(fragment);
                let clikOK = document.getElementById('actionModal');
                clikOK.addEventListener('click' , function () {
                    event.preventDefault();
                    let form = $('#formSupp' + id);
                    $(form).find('input[name="key"]').val(id);
                    $(form).submit();
                })
            }));
        }
        let whichPresta = document.querySelectorAll('.bsIconButtonTrash');
        whichPresta.forEach(el => {
            el.addEventListener('click', addTextToModal);
        })
    }        
    if ((document.location.pathname ==='/src/prestation/edition') || (document.location.pathname ==='/src/prestation/suppression')) {
        function suppPresta (event) {
            event.preventDefault();
            let modal = document.getElementById('dialogConfirm');
            modal.addEventListener('show.bs.modal', $(document).ready(function () {
                // Get the button that triggered the modal
                let button = event.target;
                let prestation = button.getAttribute('data-prestation');
                let id = button.getAttribute('data-id');
                let modalBody = modal.querySelector('.modal-body');
                modalBody.innerHTML = '';
                let fragment = document.createDocumentFragment();
                let elemp = document.createElement('p');
                elemp.appendChild(document.createTextNode('Etes vous sur de vouloir supprimer la prestation : ' + prestation + '?'));
                fragment.appendChild(elemp);
                modalBody.appendChild(fragment);
                let form = $('#formPresta');
                $(form).find('input[name="keyPresta"]').val(id);
                let clikOK = document.getElementById('actionModal');
                clikOK.addEventListener('click' , function () {
                    event.preventDefault();
                    let form = $('#formPresta');
                    $(form).find('input[name="keyPresta"]').val(id);
                    $(form).submit();
                })
            }));
        }
        let whichPresta = document.getElementById('buttonSupp');
        whichPresta.addEventListener('click', suppPresta);
    }
});