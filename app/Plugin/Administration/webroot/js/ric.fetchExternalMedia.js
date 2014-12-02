/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function () {
    var Ric = window.Ric || {};

    Ric.fetchExtMedia = function (filelist) {
        var basename = 'AdministrationUserAjaxGetExtMedia';
        var etxMediaGetForm = $("#" + basename + 'EditForm');
        etxMediaGetForm.submit(function () {
            var that = $(this);
            if ($("#" + basename + 'Url').val()) {
                $.ajax({
                    type: that.attr('method'),
                    // dataType: 'json',
                    url: that.attr('action'),
                    data: that.serialize(),
                    success: function (data) {

                        if (data.error) {
                            console.log(' pas ok')
                            alert(data.error);
                            return false;
                        }
                        else {
                            var response = $.parseJSON(data);
                            $('#' + filelist).prepend(response.content);
                            $("#" + basename + 'Url').val('');


                        }
                    }, error: function (jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR);
                        console.log(errorThrown);
                    }
                })
            }
            return false;
        });

        $('#' + filelist).on('click', 'a.deleteMedia', function (e) {
            e.preventDefault();
            elem = $(this);
            BootstrapDialog.confirm('Voulez vous supprimer ce media externe?\nTous les liens existants seront supprimés', function (confirmation) {
                if (confirmation) {
                    $.post(elem.attr('href'), {}, function (data) {
                        elem.parents('.file').slideUp();
                    })
                }
            });


        });

        $('a[data-toggle="collapse"]').attr('data-parent', '#' + filelist);
    }
})
