"use strict";

window.onload = () => {
    CKEDITOR.replace('contenu', {uiColor: '#42a4b9', height: '300px'});
    setTimeout(init, 100);
}

function init() {
    $.ajax({
        url: '/epreuve/ajax/getlesepreuves.php',
        type: 'GET',
        dataType: 'json',
        error: reponse => { msg.innerHTML = Std.genererMessage(reponse.responseText)},
        success: afficher
    });
}

ClassicEditor
    .create(document.querySelector('#editor'))
    .catch(error => {
        console.error(error);
    });