$(function() {
    var Ric = window.Ric || {};
    //window.maps = typeof window.maps !== 'undefined' ? window.maps : new Array();
    Ric.addressPicker = function(container,addressFields) {
       var container = typeof container !== 'undefined' ? container : '';
       var latitude=container + " [data-element='latitude']";
       var longitude=container + " [data-element='longitude']";
       var latlong=container+ " .latlong";
       
       var options={
            regionBias: "fr",
            componentsFilter: 'country:FR',
            updateCallback: assignAdress,
            autocomplete: 'default',
            mapOptions: {
                zoom: 8,
                center: new google.maps.LatLng(43.5, 6),
                scrollwheel: false,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            },
            elements: {
                map: container + " .map",
                lat: latitude,
                lng: longitude,
                street_number: container + " #street_number",
                route: addressFields + " [data-element='street_address']",
                locality: addressFields + " [data-element='ville']",
                administrative_area_level_2: addressFields + " #administrative_area_level_2",
                administrative_area_level_1: addressFields + " #administrative_area_level_1",
                country: addressFields + " [data-element='pays']",
                postal_code: addressFields + " [data-element='code_postal']",
                type: 'type'
            }
        }
       
        var addresspickerMap = $(container + " [data-element='addresspicker']").addresspicker(options);
         
        var gmarker = addresspickerMap.addresspicker("marker");
        var map= addresspickerMap.addresspicker("map");
        //window.maps.push(map);

        gmarker.setVisible(true);
        addresspickerMap.addresspicker("updatePosition");
       // un peu cracra...
        $('a[href="#sessions"]').on('shown.bs.tab', function (e) {
                               google.maps.event.trigger(map, 'resize');
        });
        $('a[href="#coordonnees"]').on('shown.bs.tab', function (e) {
                               google.maps.event.trigger(map, 'resize');
        });
        
        
        
        $(latlong).on('change',function(){
            
          gmarker.setPosition(new google.maps.LatLng($(latitude).val(), $(longitude).val()));
          gmarker.setVisible(true);
          map.setCenter(gmarker.getPosition());
          addresspickerMap.addresspicker("updatePosition");

        });
        

        function assignAdress(geocodeResult, parsedGeocodeResult) {
            /*
            var streetNumber = (parsedGeocodeResult.street_number == false) ? '' : parsedGeocodeResult.street_number + ' ';
           if( $(addressFields+ " [data-element]").val()=='false') {$(addressFields+ " [data-element]").val('')}
            $(addressFields+ " [data-element='street_address']").val(streetNumber + parsedGeocodeResult.route)
            $(addressFields+ " [data-element]").trigger('change');
           /* $(addressFields+ "[data-element='code_postal']").val(parsedGeocodeResult.postal_code)
            */
           
        }

    }
});



