$(function(){
    /* favorite*/
Ric.addToFavorite('ficheactivite');

/* search */
 searchConfig = {
        prefix: 'Annuaire',
        formElement: '#FicheactiviteSearchForm',
        formSubmitElement: '#searchFormSubmit',
        getCountUrl: jsBase + "/ficheactivites/getCount",
        getGenresByActiviteIdUrl:jsBase+"/Genres/getListByActiviteId",
        getDisciplinesListByActiviteIdAndGenreId:jsBase+"/Disciplines/getListByActiviteIdAndGenreId",
        inputsFieldsToShowOnAdvancedSearch:"#SearchContact,#SearchNomComplet,  #SearchImplantation,#SearchBassinPopulations,#SearchCommunauteCommunes,#SearchPays"
    };
       if(typeof Ric.searchActionsManager=='function')    Ric.searchActionsManager(searchConfig);
    $('.level_1').parent('.checkbox').addClass('level_1');
})
