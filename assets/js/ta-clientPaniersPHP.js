document.addEventListener('DOMContentLoaded', () => {
    "use strict";
    if (document.location.pathname ==='/src/webapp/clientPaniers.php') {
        let $popUps = document.querySelectorAll('#popUpSalon');
        $popUps.forEach( popup => {
            popup.addEventListener('click', popUpSalon);
        });
        function popUpSalon(event) {
            event.preventDefault(); // Prevent the default action of the link
            //console.dir(event.target.attributes.value.nodeValue);
            // Parameters to pass to the new window
            let $salonID = event.target.attributes.value.nodeValue;
        
            // Construct the URL with parameters
            let $url = '../webapp/popUpSalon.php?salonID=' + encodeURIComponent($salonID);
        
            // Open the new window
            window.open($url, 'PopupWindow', 'width=600,height=400');
        }
    }
    if (document.location.pathname ==='/src/webapp/popUpSalon.php') {
        document.getElementById('closePopup').addEventListener('click', function() { window.close();});
    }
});

