function popUpMessageShow( message, needTitle , neededConfirmButton, confirmButtonId, confirmButtonClass ){

    if( needTitle !==false  ){
        var popUpBtnTitle = ' <h2>Popup Card Title</h2>';
    }else{
        popUpBtnTitle = '';
    }
    if( neededConfirmButton !==false ){
        var btnNeed = '<div class="popupconfirmBtn-container">\
                            <span class="popupconfirmButton '+confirmButtonClass+'" id='+confirmButtonId+'>Yes</span>\
                            <span class="popupNoButton" id="popupconfirmButton">No</span>\
                        </div>'
    }else{
        btnNeed = '';
    }
    let displayPopUp = '<div id="popupContainer" class="popup-container">\
                            <div class="popup-card">\
                                <span class="close-btn" id="closePopupBtn">&times;</span>\
                               '+popUpBtnTitle+'\
                                <p>'+message+'</p>\
                                '+btnNeed+'\
                            </div>\
                        </div>';
    $("body").append( displayPopUp );
}

function hidePopUpMessage(){
    $("#popupContainer").fadeOut();
}
function showPopUpMessage( message, needTitle , neededConfirmButton, confirmButtonId, confirmButtonClass ){
    popUpMessageShow( message, needTitle , neededConfirmButton, confirmButtonId, confirmButtonClass);
    $("#popupContainer").fadeIn();
}

$("body").on("click", "#closePopupBtn", function ( event ) {
    $("#popupContainer").fadeOut();
});
$("body").on("click", "#popupconfirmButton", function ( event ) {
    $("#popupContainer").fadeOut();
});