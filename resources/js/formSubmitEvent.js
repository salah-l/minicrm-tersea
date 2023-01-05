import {delay} from './functions.js';
$(document).ready(function(){

        //Handles all the form submissions in the app
        $(document).on('submit', 'form', function(event){
            event.preventDefault();
            const formData = $('form').serializeArray();
            const url = $('form').attr('action');
            const entity = $('form').data('entity');
            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                success : function(data){
                    if(entity){
                        $(`.${entity}-message-alert`).html(data);//prints the error message in the alert div.
                    }

                    //invitation process
                    if(data[0] == 'newLocation'){
                        window.location.href = data[1];
                    }
                
                },
                error: function (err) {
                      $("span[id$='-error']").addClass('invalid-feedback');//hide all error messages before getting new errors.
                      delay(500).then(function(){//a delay to make the errors updates smoother
                        var errors = err.responseJSON.errors;//retrives the errors
                        // Display the errors in the form.
                        $.each(errors, function (key, value) {
                            $(`#${key}-error`).html(value[0]);//prints the error message in the coresponding div
                            $(`#${key}-error`).removeClass('invalid-feedback');//removes invalid-feedback class that has display none
                            $(`#${key}-error`).addClass('feedback');//adds feedback class for error message styles
                        });

                      });

                    
                }
            });
            
    });





});