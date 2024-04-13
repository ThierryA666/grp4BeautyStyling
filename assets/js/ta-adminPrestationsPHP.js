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
                console.dir(event.target);
                let button = event.target;
                let prestation = button.getAttribute('data-prestation');
                console.dir(prestation);
                let modalBody = modal.querySelector('.modal-body');
                modalBody.innerHTML = '';
                let fragment = document.createDocumentFragment();
                let elemp = document.createElement('p');
                elemp.appendChild(document.createTextNode('Etes vous sur de vouloir supprimer la prestation : ' + prestation + '?'));
                fragment.appendChild(elemp);
                modalBody.appendChild(fragment);
                let clikOK = document.getElementById('actionModal');
                clikOK.addEventListener('click' , function () {
                    $('#formPresta').submit();
                    let $eventData = {
                        Supprimer: 'Supprimer',
                        $display : 'd-none',
                        timestamp: new Date().toISOString()
                    };
                    console.dir($eventData);
                    // Send data to PHP using AJAX
                    let $xhr = new XMLHttpRequest();
                    $xhr.open("POST", "../webapp/adminPrestation.php", true);
                    $xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
                    $xhr.send(JSON.stringify($eventData));
                    $xhr.onreadystatechange = function() {
                    if ($xhr.readyState === XMLHttpRequest.DONE) {
                        if ($xhr.status === 200) {
                            const hostname = window.location.hostname;
                            const port = window.location.port;
                            const url = 'http://' + hostname + ':' + port + '/src/webapp/adminPrestation.php';
                            window.location.href = url;
                        }
                    }
                }
                //$('#formPresta').submit();
            });
        }));
    }   
        // let whichPresta = document.getElementById('buttonSupp');
        // whichPresta.addEventListener('click', suppPresta);
    }
});