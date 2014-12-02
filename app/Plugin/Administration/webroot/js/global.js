/*$('#tabs a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
*/
    // store the currently selected tab in the hash value
    $("ul.nav-tabs > li > a").on("shown.bs.tab", function (e) {
        var id = $(e.target).attr("href").substr(1);
        window.location.hash = id;
        window.scrollTo(0,0);
    });

    // on load of the page: switch to the currently selected tab
   $(function(){
       
       var hash = window.location.hash;
    $('#tabs a[href="' + hash + '"]').tab('show');
    $('body').scrollTop();
    $("[data-toggle='popover']").popover(); 
    $('.level_1').parent('.checkbox').addClass('level_1');
   
   });
    
    
    

