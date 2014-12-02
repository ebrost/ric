/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    $(function() {

        var form = $("#UserLoginForm");
        form.find('input').focus(function() {
            console.log('focus');
            cleanForm()
        });


        $("#showlogin").click(function() {
           // form.toggleClass('hide');
            if(form.hasClass('hide')){
        form.removeClass('hide', 500);   
    } else {
        form.addClass('hide', 500);
    }
            cleanForm();
            return false;
        });

        function cleanForm() {
            form.find('.help-inline').remove();
            form.find('.error').each(function() {
                $(this).removeClass("error");
            });
        }
        ;

        function onErrors(errors) {
            var element = form.find('button[type="submit"]')
            var _insert = $(document.createElement('span')).insertAfter(element);
            _insert.addClass('help-inline').text(errors);
            _insert.css('color', '#b94a48');
            //_insert.closest('.control-group').addClass('error');
        }

        form.submit(function() {
            cleanForm();
            var that = $(this);
            $.ajax({
                type: that.attr('method'),
                dataType: 'json',
                url: that.attr('action'),
                data: that.serialize(),
                success: function(data) {

                    if (data.errors) {
                        onErrors(data.errors)
                    }
                    else {
                        //var redirectUrl = jsRoot.replace(/\/$/, "") + data.redirectUrl
                        //console.log(jsRoot.replace(/\/$/, "")+data.redirectUrl)

                        window.location.replace(data.redirectUrl)
                    }
                }
            });
            return false;
        });

    });


