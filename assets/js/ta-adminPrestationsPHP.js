document.addEventListener('DOMContentLoaded', () => {
    "use strict";
    if (document.location.pathname ==='/src/webapp/adminListePrestations.php') {
        function addTextToModal (event) {
            event.preventDefault();
            let modal = document.getElementById('dialogConfirm');
            modal.addEventListener('show.bs.modal', $(document).ready(function () {
                // Get the button that triggered the modal
                let button = event.target;
                let prestation = button.getAttribute('data-prestation');
                let id = button.getAttribute('data-id');
                console.dir(prestation);
                console.dir(id);
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
                    //console.log('Hello!');
                    let form = $('#formSupp' + id);
                    $(form).find('input[name="key"]').val(id);
                    console.dir(form);
                    $(form).submit();
                })
            }));
        }
        let whichPresta = document.querySelectorAll('.bsIconButtonTrash');
        whichPresta.forEach(el => {
            el.addEventListener('click', addTextToModal);
        })
    }        

    if (document.location.pathname ==='/src/webapp/adminPrestation.php') {

        function suppPresta (event) {
            event.preventDefault();
            console.log(event.target.id);
            let modal = document.getElementById('dialogConfirm');
            modal.addEventListener('show.bs.modal', $(document).ready(function () {
                // Get the button that triggered the modal
                let button = event.target;
                let prestation = button.getAttribute('data-prestation');
                let id = button.getAttribute('data-id');
                console.dir(button);
                console.dir(prestation);
                console.dir(id);
                let modalBody = modal.querySelector('.modal-body');
                modalBody.innerHTML = '';
                let fragment = document.createDocumentFragment();
                let elemp = document.createElement('p');
                elemp.appendChild(document.createTextNode('Etes vous sur de vouloir supprimer la prestation : ' + prestation + '?'));
                fragment.appendChild(elemp);
                modalBody.appendChild(fragment);
                let form = $('#formPresta');
                $(form).find('input[name="keyPresta"]').val(id);
                console.dir(form);
                let clikOK = document.getElementById('actionModal');
                clikOK.addEventListener('click' , function () {
                    event.preventDefault();
                    console.log('Hello!');
                    let form = $('#formPresta');
                    $(form).find('input[name="keyPresta"]').val(id);
                    console.dir(form);
                    $(form).submit();
                })
            }));
        }
        let whichPresta = document.getElementById('buttonSupp');
        whichPresta.addEventListener('click', suppPresta);
    }
});