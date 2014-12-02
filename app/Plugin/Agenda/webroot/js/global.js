$(function(){
    /* favorite*/
   
Ric.addToFavorite('evenement');

/* search */
 searchConfig = {
        prefix: 'Agenda',
        formElement: '#EvenementSearchForm',
        formSubmitElement: '#searchFormSubmit',
        getCountUrl: jsBase + "/evenements/getCount",
        getGenresByActiviteIdUrl:jsBase+"/Genres/getListByActiviteId",
      inputsFieldsToShowOnAdvancedSearch:"#SearchImplantation,#SearchStartAndEndDate,#SearchGenre"
   

    };
    if(typeof Ric.searchActionsManager=='function')    Ric.searchActionsManager(searchConfig);
    

})

