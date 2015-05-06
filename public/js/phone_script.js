(function( $ ){

//// ---> Проверка на существование элемента на странице
    jQuery.fn.exists = function() {
        return jQuery(this).length;
    }

//	Phone Mask
    $(function() {

        if($('#user_phone').exists()){

            $('#user_phone').each(function(){
                $(this).mask("(999) 99-99-99");
            });

        }

        if($('.phone_form').exists()){

            var form = $('.phone_form'),
                btn = form.find('.btn_submit');

            form.find('.rfield').addClass('empty_field');

            setInterval(function(){

                if($('#user_phone').exists()){
                    var pmc = $('#user_phone');
                    if ( (pmc.val().indexOf("_") != -1) || pmc.val() == '' ) {
                        pmc.addClass('empty_field');
                    } else {
                        pmc.removeClass('empty_field');
                    }
                }

                var sizeEmpty = form.find('.empty_field').size();

                if(sizeEmpty > 0){
                    if(btn.hasClass('disabled')){
                        return false
                    } else {
                        btn.addClass('disabled')
                    }
                } else {
                    btn.removeClass('disabled')
                }

            },200);

            btn.click(function(){
                if($(this).hasClass('disabled')){
                    return false
                } else {
                    form.submit();
                }
            });

        }

    });


    //	Phone Mask
    $(function() {



        if($('#user_phone2').exists()){

            $('#user_phone2').each(function(){
                $(this).mask("(999) 99-99-99");
            });

        }

        if($('.phone_form2').exists()){

            var form = $('.phone_form2'),
                btn = form.find('.btn_submit');

            form.find('.rfield').addClass('empty_field');

            setInterval(function(){

                if($('#user_phone2').exists()){
                    var pmc = $('#user_phone2');
                    if ( (pmc.val().indexOf("_") != -1) || pmc.val() == '' ) {
                        pmc.addClass('empty_field');
                    } else {
                        pmc.removeClass('empty_field');
                    }
                }

                var sizeEmpty = form.find('.empty_field').size();

                if(sizeEmpty > 0){
                    if(btn.hasClass('disabled')){
                        return false
                    } else {
                        btn.addClass('disabled')
                    }
                } else {
                    btn.removeClass('disabled')
                }

            },200);

            btn.click(function(){
                if($(this).hasClass('disabled')){
                    return false
                } else {
                    form.submit();
                }
            });

        }

    });


    //	Phone Mask
    $(function() {



        if($('#user_phone3').exists()){

            $('#user_phone3').each(function(){
                $(this).mask("(999) 99-99-99");
            });

        }

        if($('.phone_form3').exists()){

            var form = $('.phone_form3'),
                btn = form.find('.btn_submit');

            form.find('.rfield').addClass('empty_field');

            setInterval(function(){

                if($('#user_phone3').exists()){
                    var pmc = $('#user_phone3');
                    if ( (pmc.val().indexOf("_") != -1) || pmc.val() == '' ) {
                        pmc.addClass('empty_field');
                    } else {
                        pmc.removeClass('empty_field');
                    }
                }

                var sizeEmpty = form.find('.empty_field').size();

                if(sizeEmpty > 0){
                    if(btn.hasClass('disabled')){
                        return false
                    } else {
                        btn.addClass('disabled')
                    }
                } else {
                    btn.removeClass('disabled')
                }

            },200);

            btn.click(function(){
                if($(this).hasClass('disabled')){
                    return false
                } else {
                    form.submit();
                }
            });

        }

    });






    //	Phone Mask
    $(function() {



        if($('#phone_otziv').exists()){

            $('#phone_otziv').each(function(){
                $(this).mask("(999) 99-99-99");
            });

        }

        if($('.form_otziv').exists()){

            //var form = $('.form_otziv'),
            //    btn = form.find('.btn_submit');

            //form.find('.rfield').addClass('empty_field');

            /*setInterval(function(){

                if($('#phone_otziv').exists()){
                    var pmc = $('#phone_otziv');
                    if ( (pmc.val().indexOf("_") != -1) || pmc.val() == '' ) {
                        pmc.addClass('empty_field');
                    } else {
                        pmc.removeClass('empty_field');
                    }
                }

                var sizeEmpty = form.find('.empty_field').size();

                if(sizeEmpty > 0){
                    if(btn.hasClass('disabled')){
                        return false
                    } else {
                        btn.addClass('disabled')
                    }
                } else {
                    btn.removeClass('disabled')
                }

            },200);*/

            /*btn.click(function(){
                if($(this).hasClass('disabled')){
                    return false
                } else {
                    form.submit();
                }
            });*/

        }

    });


    //	Phone Mask
    $(function() {



        if($('#phone_reg').exists()){

            $('#phone_reg').each(function(){
                $(this).mask("(999) 99-99-99");
            });

        }

        if($('.form_reg').exists()){

            var form = $('.form_reg'),
                btn = form.find('.btn_submit');

            //form.find('.rfield').addClass('empty_field');

            /*setInterval(function(){

             if($('#phone_otziv').exists()){
             var pmc = $('#phone_otziv');
             if ( (pmc.val().indexOf("_") != -1) || pmc.val() == '' ) {
             pmc.addClass('empty_field');
             } else {
             pmc.removeClass('empty_field');
             }
             }

             var sizeEmpty = form.find('.empty_field').size();

             if(sizeEmpty > 0){
             if(btn.hasClass('disabled')){
             return false
             } else {
             btn.addClass('disabled')
             }
             } else {
             btn.removeClass('disabled')
             }

             },200);*/

            btn.click(function(){
             if($(this).hasClass('disabled')){
             return false
             } else {
             form.submit();
             }
             });

        }

    });

})( jQuery );
