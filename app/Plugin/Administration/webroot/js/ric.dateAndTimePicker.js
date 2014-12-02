/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 $(function() {
                var Ric = window.Ric || {};
                Ric.dateAndTimePicker = function() {
                   
                        var $searchStartDate = $('.searchStartDateComponent');
                        var $searchEndDate = $('.searchEndDateComponent');
                        console.log();
                        function formatDate($dateArray){
                            $.each($dateArray, function (i,item){
                                  var input=$(item).find('input');
                                  var unformatedStartDate=input.val();
                                  var formatedStartDate=$.datepicker.formatDate('dd-mm-yy',new Date(unformatedStartDate));
                                  input.val(formatedStartDate);
                            });
                            
                            
                        }
                        
                        function bindEvents(){
                            var startDate = $searchStartDate.datepicker({
                            language: "fr",
                                autoclose:true,
                                todayBtn: 'linked',
                                todayHighlight: true,
                                format:'dd-mm-yyyy',
                                startDate:Ric.today
                            });
                             var endDate = $searchEndDate.datepicker({
                                language: "fr",
                                        autoclose:true,
                                        todayBtn: 'linked',
                                        todayHighlight: true,
                                        format:'dd-mm-yyyy',
                                        startDate:Ric.today,
                                });
                                    $('.searchEndDateComponent').on('click',function(){console.log('click')})
                                startDate.on('changeDate', function(ev){

                                if (ev.date > $searchEndDate.datepicker('getDate')){
                                var newDate = new Date(ev.date);
                                        newDate.setDate(newDate.getDate());
                                        $searchEndDate.datepicker('setDate', newDate);
                                }
                                });
                                endDate.on('changeDate', function(ev){
                               
                                        if (ev.date < $searchStartDate.datepicker('getDate')){
                                var newDate = new Date(ev.date);
                                        newDate.setDate(newDate.getDate());
                                        $searchStartDate.datepicker('setDate', newDate);
                                }
                                });
                            };
                         function init() {
                                formatDate($searchStartDate);
                                formatDate($searchEndDate);
                                bindEvents();
                         }
                         init();
                                
                };

   

});

;



