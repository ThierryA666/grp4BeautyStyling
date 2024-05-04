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
                let form = $('#suppPresta');
                $(form).find('input[name="keyPresta"]').val(id);
                let clikOK = document.getElementById('actionModal');
                clikOK.addEventListener('click' , function () {
                    event.preventDefault();
                    let form = $('#suppPresta');
                    $(form).find('input[name="keyPresta"]').val(id);
                    $(form).submit();
                })
            }));
        }
        let whichPresta = document.getElementById('buttonSupp');
        whichPresta.addEventListener('click', suppPresta);
    }
    if (document.location.pathname ==='/src/salonreservecalendrier') {
        $(function () {
            // ACTIVATION DU DATEPICKER 
            $('.datepicker').datepicker({
                showButtonPanel:true,
                showWeek:true,
                beforeShowDay: function(date) {
                    var day = date.getDay();
                    return [(day != 0), ''];
                },
                altField: "#alternate",
                altFormat: "DD, d MM yy",  
                format: "dd/mm/yyyy",
                regional: "fr"
            });
        });
        $( function() {
            $( "#date" ).datepicker($.datepicker.regional[ "fr" ]);
        });
        $.datepicker.regional['fr'] = {
            dateFormat: 'dd-mm-yy',
            closeText: 'Fermer',
            prevText: '&#x3c;Préc',
            nextText: 'Suiv&#x3e;',
            currentText: 'Aujourd\'hui',
            monthNames: ['Janvier','Fevrier','Mars','Avril','Mai','Juin',
            'Juillet','Aout','Septembre','Octobre','Novembre','Decembre'],
            monthNamesShort: ['Jan','Fev','Mar','Avr','Mai','Jun',
            'Jul','Aou','Sep','Oct','Nov','Dec'],
            dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
            dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
            dayNamesMin: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
            //dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
            weekHeader: 'Sem',
            firstDay: 1,
            showMonthAfterYear: false,
            yearSuffix: '',
            minDate: 0,
            maxDate: '+12M +0D',
            };
        $.datepicker.setDefaults($.datepicker.regional['fr']);
        $('#date').datepicker();

        let timeButton = document.getElementById('timeButton');
        timeButton.addEventListener('click', $(document).ready(function () {  
            $('.clockpicker').clockpicker()
                .find('input').change(function(){
                    //console.log(this.value);
                });
            var input = $('#single-input').clockpicker({
                placement: 'top',
                align: 'right',
                left: '100px',
                top: '50px',
                min: '09:00',
                max: '19:00',
                step: '00:30',
                autoclose: true,
                'default': 'now'
            });
        }));

        function updateTime() {
            var currentTime = new Date();
            var hours = currentTime.getHours();
            var minutes = currentTime.getMinutes();
            var timeString = ('0' + hours).slice(-2) + 'h' + ('0' + minutes).slice(-2); // Format hours and minutes (add leading zeros if needed)
            document.getElementById('timeDisplay').textContent = timeString; // Update the time display
        }
        
        // Call updateTime function immediately to display the current time
        updateTime();
        
        // Update the displayed time every second (1000 milliseconds)
        setInterval(updateTime, 1000);
    }
    let salonSelect = document.getElementById('salons');
    salonSelect.addEventListener('change', selectSalon);
    function selectSalon(event) {
        event.preventDefault;
        console.dir(event);
        console.dir(event.target);
        console.dir(this.value);
        let form = $('#formSalon');
        $(form).find('input[name="salons"]').val(this.value);
        $(form).submit();
    }
    let prestaSelect = document.getElementById('prestations');
    prestaSelect.addEventListener('change', selectPresta);
    function selectPresta(event) {
        event.preventDefault;
        console.dir(event);
        console.dir(event.target);
        console.dir(this.value);
        let form = $('#formSalon');
        $(form).find('input[name="prestations"]').val(this.value);
        $(form).submit();
    }
})
