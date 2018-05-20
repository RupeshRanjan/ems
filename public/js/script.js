$(document).on('click','[data-request="ajax-submit"]',function(){
    /*REMOVING PREVIOUS ALERT AND ERROR CLASS*/
    $('#popup').show();  $('.alert').remove(); $(".has-error").removeClass('has-error');$('.error-message').remove();
    var $this       = $(this);
    var $target     = $this.data('target');
    var $url        = $($target).attr('action');
    var $method     = $($target).attr('method');
    var $modal      = $this.data('modal');
    var $data       = new FormData($($target)[0]);
    if(!$method){ $method = 'get'; }
    
    $.ajax({
        url: $url, 
        data: $data,
        cache: false, 
        type: $method, 
        dataType: 'json',
        contentType: false, 
        processData: false,
        success: function($response){

            if ($response.reCaptcha === true) {
                $("#reCaptchaLogin").show();
            }else{
                $("#reCaptchaLogin").hide();
            }

            if ($response.status === true) {
                if($response.redirect){ 
                    if($response.modal){
                        $($target).trigger('reset');
                        $($modal).attr('data-success',$response.redirect);
                        swal({
                            html: $response.message,
                            showLoaderOnConfirm: false,
                            showCancelButton: false,
                            showCloseButton: true,
                            showConfirmButton: false,
                            allowEscapeKey: false,
                            allowOutsideClick:false,
                            imageUrl :  $response.successimage,
                            imageClass: 'success-image-popup',
                            customClass: 'success-popup-custom-class',
                            confirmButtonText: 'X',
                            confirmButtonColor: '#ffffff',
                            preConfirm: function (res) {
                                if($response.redirect != true){
                                    setTimeout(function(){
                                        window.location.href = $response.redirect;
                                    },1000);
                                }
                            }
                        }).then(function(isConfirm){},function (dismiss){}).catch(swal.noop);
                        
                        if($response.redirect !=true){
                            setTimeout(function(){
                                window.location.href = $response.redirect;
                            },1000);
                        }
                        $($modal).trigger('click');
                    }else{
                        if($response.redirect != true){
                            window.location.href=$response.redirect;
                        }
                    }
                }
            }else{
                if($response.message.length > 0 && $response.message !== 'M0000'){
                    $('.messages').html($response.message);
                }

                if (Object.size($response.data) > 0) {
                    /*TO DISPLAY FORM ERROR USING .has-error class*/
                    if(typeof grecaptcha != 'undefined'){
                        grecaptcha.reset();
                    }
                    // onloadCallback();
                    show_validation_error($response.data);
                    if($('[data-toggle="collapse"]').length > 0){
                        if ($.isPlainObject($response.data)) {
                            $data = $response.data;
                        }else {
                            $data = $.parseJSON($response.data);
                        }

                        $.each($data, function (index, value) {
                            var name    = index.replace(/\./g, '][');
                            
                            if (index.indexOf('.') !== -1) {
                                name = name + ']';
                                name = name.replace(']', '');
                            }

                            $fieldname = name.split('[');
                            $("#"+$fieldname[0]).trigger('click');
                        });                        
                    }

                    if($('#reCaptchaCompany,#reCaptchaLogin,#reCaptchaContact,#reCaptchaCandidate').length > 0){
                        $.ajax({
                            url:base_url+'/recaptcha-render',
                            success:function($reCaptcharesponse){
                                $('#reCaptchaCompany,#reCaptchaLogin,#reCaptchaContact,#reCaptchaCandidate').html($reCaptcharesponse);
                            }
                        }) 
                    }
                }
            }
            $('#popup').hide();
        }
    }); 
});