$(function(){
    /* favorite*/
Ric.addToFavorite('ficheoeuvre');

/* search */
 searchConfig = {
        prefix: 'Oeuvre',
        formElement: '#FicheoeuvreSearchForm',
        formSubmitElement: '#searchFormSubmit',
        getCountUrl: jsBase + "/ficheoeuvres/getCount",
        inputsFieldsToShowOnAdvancedSearch:"#SearchPrix,#SearchJauge,#SearchDuree, #SearchImplantation"
    };
       if(typeof Ric.searchActionsManager=='function')    Ric.searchActionsManager(searchConfig);
    $('.level_1').parent('.checkbox').addClass('level_1');
})
