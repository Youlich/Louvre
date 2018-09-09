// nb de formulaire visiteur en fonction du nombre de billet sélectionné dans la liste
var nbBilletselect = document.querySelector("select#nbBillet");
var nbBillet = document.querySelector("#nbBillet");

nbBillet.addEventListener('change', function () {

    var cont = document.getElementById('visiteur-fields-list');

    while (cont.firstChild) {//tant que la div a un premier enfant...
        cont.removeChild(cont.firstChild);//...on le retire
    }
    for (i = 1; i <= nbBilletselect.value; i++) {
        var list = jQuery(jQuery('#the-list').attr('data-list'));
        var counter = list.children().length;
        var newWidget = list.attr('data-prototype');

        newWidget = newWidget.replace(/__name__/g, (counter + 1));
        counter++;
        // increase the index with one for the next item
        list.data(' widget-counter', counter);

        var newElem = jQuery(list.attr('data-widget-tags')).html(newWidget);
        newElem.appendTo(list);
    }
});

//paramétrage datepicker,affichage dans le panier de la date de visite sélectionnée
//gestion de la langue
var dateVisitePanier = document.querySelector("#dateVisitePanier");

var url = window.location.toString();
var langue = url.substr(-2);

function DisableDay(date){
    var day = date.getDay();
    var jour = date.getDate();
    var month = date.getMonth()+1;
    // jour 2 = mardi
    if (day == 2) {
        return [false] ;
    } else if (jour == 1 && month == 5 || jour == 1 && month == 11 || jour == 25 && month == 12 ) {
        return [false] ;
    }else {
        return [true] ;
    }
}
$(function () {
    $(".datepicker").datepicker({
        //affichage dans le panier de la date de visite sélectionnée
        onSelect: function onSelect(date) {
            dateVisitePanier.innerHTML = date;
        },
        //interdire les réservations sur les jours passés
        minDate: 0,
        //interdire les réservations pour le mardi et jours fériés 1er mai, 1er novembre et 25 décembre.
        beforeShowDay: DisableDay
    });
    if (langue === 'en') {
        $.datepicker.setDefaults({
            dateFormat: 'dd/mm/yy',
            dayNamesShort: [ "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun" ],
            dayNamesMin: ['M', 'T', 'W', 'T', 'F', 'S', 'S']
        });
    } else {
        $.datepicker.setDefaults({
            altField: ".datepicker",
            closeText: 'Fermer',
            prevText: 'Précédent',
            nextText: 'Suivant',
            currentText: 'Aujourd\'hui',
            monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
            dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
            dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
            dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
            weekHeader: 'Sem.',
            dateFormat: 'dd/mm/yy'
        });
    }});


//Gestion du panier
//affichage dans le panier du nombre de billets sélectionné
var nbBilletPanier = document.querySelector('#nbBilletPanier');

//par défaut le message d'alerte (merci de remplir les formulaires visiteurs) est caché
$('.message').css('visibility', 'hidden');

nbBillet.addEventListener('change',function()
{
    nbBilletPanier.innerHTML = nbBilletselect.value;
    $('.message').css('visibility', 'visible');
    var m = document.querySelector('.message');
    window.setInterval(function () {
        m.classList.toggle('red')
    },1500);
});

//affichage dans le panier du type de visite sélectionné
var typeVisite = document.querySelector("#typeVisite");
var typeVisitePanier = document.querySelector("#typeVisitePanier");
typeVisite.addEventListener('change',function()
    {
        typeVisitePanier.innerHTML = typeVisite.value;
        if (langue === 'en') {
            if (typeVisite.value === '1'){
                typeVisitePanier.innerHTML = 'Full day'
            } else {
                typeVisitePanier.innerHTML = 'Half day'
            }
        } else {
            if (typeVisite.value === '1'){
                typeVisitePanier.innerHTML = 'Journée'
            } else {
                typeVisitePanier.innerHTML = 'Demi-journée'
            }
        }
    }
);

//Restrictions cahier des charges
var Hour = $('#dialogHour');
Hour.css('visibility', 'hidden');
var dateNow=new Date();
var heure = dateNow.getHours();


//si la date de visite correspond au jour même >14h pas de billet journée possible
$("#typeVisite").on('change', function () {
    if ( $("#typeVisite").val()== 1 && $(".datepicker").datepicker('getDate').getDate()== dateNow.getDate() && $(".datepicker").datepicker('getDate').getMonth()+1== dateNow.getMonth()+1 && $(".datepicker").datepicker('getDate').getFullYear()== dateNow.getFullYear() && heure>=14) {
        Hour.css('visibility', 'visible');
        Hour.dialog({
            buttons: [
                {
                    text: "Ok",
                    click: function() {
                        Hour.dialog( "close" );
                    }
                }
            ]
        });
    }
});
/*
//Impossible de commander si le jour de la commande est un dimanche, un mardi ou un jour férié (1er mai, 1er novembre ou 25 décembre).
$('#message').css('visibility', 'hidden');
if(dateNow.getDay() === 0 || dateNow.getDay() === 2 || dateNow.getDate() === 1 && dateNow.getMonth() === 11 || dateNow.getDate() === 1 && dateNow.getMonth() === 5 || dateNow.getDate() === 25 && dateNow.getMonth() === 12  ) {
    $(function() {
        $('#containerform').css('visibility', 'hidden');
        $('#panier').css('visibility', 'hidden');
        $('#message').css('visibility', 'visible');
    });
}
*/
//Message d'erreur si le stock disponible = 0
var Stock = $('#dialogStock');
Stock.css('visibility', 'hidden');
var stock = document.querySelector("#stock");

if (stock.innerHTML == 0) {
    Stock.css('visibility', 'visible');
    Stock.dialog({
        buttons: [
            {
                text: "Ok",
                click: function () {
                    Stock.dialog("close");
                }
            }
        ]
    });
}
//le panier était vidé après l'affichage d'un message d'erreur, donc je supprime le panier et n'affiche que le bouton "accéder au paiement"

var error = document.querySelector(".invalid-feedback");

if (error) {
    $('#panier').css('visibility', 'hidden');
    $('#payment').css('visibility', 'visible');
}


