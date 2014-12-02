$(function() {
    var Ric = window.Ric || {};
    Ric.tabWizard = function(tabRoot,validationUrl, autosave) {
        autosave = typeof autosave !== 'undefined' ? autosave : true;
        
        onError = function(model, errors) {
            var firstItem;
            $.each(errors, function(fieldName) {

                for (message in this) {
                    var element = $("#" + model + Ric.camelize(fieldName));

                    if (typeof firstItem === "undefined")
                        firstItem = element;
                    if (element.nextAll('.help-inline').length == 0) {
                        var _insert = $(document.createElement('span')).insertAfter(element);
                        _insert.addClass('help-inline').text(this[message]);
                        _insert.closest('.control-group').addClass('error');
                    }
                }
            });

            firstItem.focus();


        };
        checkValid = function(tab, navigation, index) {
            
            $('.help-inline').remove();
            var valid = false;
            var $current;
            var tabContent = $(tab.find('a').attr('href'));
          
            var dataCheck=tabContent.find('.input, .checkbox,.radio').children().serializeArray();
            dataCheck.push({name:'autosave',value:autosave})
          //  console.log(dataCheck);
            validationUrl = typeof validationUrl !== 'undefined' ? validationUrl : tab.closest('form').attr('action') + '/../checkValidation';
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: validationUrl,
                async: false,
                data: dataCheck,
                success: (function(data) {
                  
                    if (data.errors) {
                        
                        onError(data.model, data.errors);

                    }
                    else {
                        valid = true;

                    }
                })

            })
            return valid

        }
        
    
        $(tabRoot).bootstrapWizard({
           
            onTabShow:function(tab,navigation,index){
                
                var $total = navigation.find('li').length;
                
              
               
                if(index==0) {
                   // alert('firist')
			$(tabRoot).find('.prev-next .previous').hide();
			
		}
                else{
                    $(tabRoot).find('.prev-next .previous').show();
                }
                if(index >= $total-1) {
			$(tabRoot).find('.prev-next .next').hide();
			//$('#rootwizard').find('.prev-next .submit').show();
			//$('#rootwizard').find('.prev-next .submit').removeClass('disabled');
		} else {
			$(tabRoot).find('.prev-next .next').show();
			//$('#rootwizard').find('.prev-next .submit').hide();
		}
                
               
                //return this.onTabClick(tab, navigation, index,clickedIndex)
            },
           
            
            onTabClick: function(tab, navigation, index,clickedIndex) {
                $('#flash').children().fadeOut().empty();;
                if (clickedIndex>index) {
                    
                    
                    for(i=index;i<clickedIndex;i++){
                         var tabToValidate=navigation.find('li:eq('+i+')');
                         if(!checkValid(tabToValidate, navigation, i)){
                          $(tabRoot).bootstrapWizard('show',i);
                          return false;
                      }
                    }
                    
                }
                 $('button[type="submit"]').click(function() {
                     return checkValid(tab, navigation, index);
                });
                 return true

            },
            onNext: function(tab, navigation, index) {
                return checkValid(tab, navigation, index)
              // this.onTabClick(tab, navigation, index,clickedIndex)
            }
        });
       
      



    }

})