$(document).ready(function() {

    console.log('reco.js');


    $('.radioHommeFemmeLabel').on('click', function(e){

        $('.radioHommeFemmeLabel').each(function(index){
            $(this).removeClass('radioHommeFemmeLabelChecked');
        });

        $(this).addClass('radioHommeFemmeLabelChecked');

    });


    /*
     *  Building pills
     */


    // when click happen on pill

    /*
     $(window).on('click', function(e) {

     if (e.target.classList.contains('tagsBarItemP')) {

     if (e.target.parentNode.classList.contains('tagsBarItemEmpty')) {
     return false;
     } else {

     var pillValo = e.target.innerHTML.trim();

     $('.pillSelector.tagSelect').each(function(index, value) {
     var selectorVallo = $(this).children().children()[0].innerHTML;

     if (pillValo === selectorVallo.trim()) {

     $(this).removeClass('tagSelect');

     }

     });

     e.target.parentNode.remove();

     }

     }

     });
    */


    // when a click happen on a pill selector

    /*

    $('.pillSelector').on('click', function(e){

        //console.log('click selector');
        var pillHTML = $(this).children().children().children().children()[2].innerHTML.trim();
        //console.log(pillHTML);

        // if selector is already selected -> delete it else add it
        if($(this).hasClass('tagSelect')){

            //$('#nextCounter').html(($('#nextCounter').html) - 1);
            //console.log('already clicked');
            // removing pull selector little class
            $(this).removeClass('tagSelect');
            // loop on filled pills
            $('.tagsBarItem').each(function(index, value){
                var pillValue = $(this).children().html();
                if(typeof pillHTML !== "undefined" && typeof pillValue !== "undefined"){
                    if(pillValue.trim() === pillHTML.trim()){
                        $(this).remove();
                    }
                }
            });

        }else{

            //console.log('no clicked');
            // adding pull selector little class
            $(this).addClass('tagSelect');
            // loop on empty pills
            $('.tagsBarItemEmpty').each(function(index, value){
                // building the first empty pill on the list
                if(index === 0){
                    // remove empty class and build pill
                    $(this).removeClass('tagsBarItemEmpty');
                    $(this).html('<p class="tagsBarItemP">'+pillHTML+'</p>');
                }
            });
        }

        if($('.tagsBarItemEmpty').length === 0){
            $('.tagsBarInside').append('<div class="tagsBarItem tagsBarItemEmpty"><p></p></div>');
        }

        // only one pill left -> put default text
        */
        /*
        if($('.tagsBarItem').length === 1){
            $('.tagsBarItem').children().html('Choisissez votre premier critère');
        }
        */



    /*
    });
    */




    /*
     * prevent form post
     */

    $('#submitUserScorePop').on('click', function(e){
        e.preventDefault();
    });


    var counterCheck = 0;

    /*
     *  Building recommendation form
     */

    $('.recoInput').on('change', function(e){

        if($(this).is(':checked')){

            //console.log($(this).attr('value') + ' is checked');
            $recoInputValue = $(this).attr('value');
            $('.recoPost').each(function(index){
                if($(this).attr('name') === $recoInputValue){
                    $(this).attr('value', 'checked');
                    $(this).trigger('change');
                }
            });

            // style "selected for the selector
            $(this).parent().parent().parent().parent().addClass('tagSelect');
            var pillHTML = $(this).parent().children()[2].innerHTML.trim();
            //building the pills
            $('.tagsBarItemEmpty').each(function(index, value){
                // building the first empty pill on the list
                if(index === 0){
                    // remove empty class and build pill
                    $(this).removeClass('tagsBarItemEmpty');
                    $(this).html('<p class="tagsBarItemP animated fadeIn">'+pillHTML+'</p>');
                }
            });

            counterCheck = counterCheck + 1;
            console.log(counterCheck);
            if(counterCheck >= 5){
                $('#submitUserScorePop').html('Suivant');
                $('#submitUserScorePop').off('click');
                $('#submitUserScorePop').addClass('nextGo');
                console.log($('#submitUserScorePop').parent());
                $('#submitUserScorePop').parent().removeClass('tagsBarNextDisable');

                //#modal_register_user
                //data-target
                $('#submitUserScorePop').attr('data-target', '#modal_register_user');


            }else if(counterCheck < 5){
                $('#submitUserScorePop').html((5 - counterCheck)+' Restant');
                $('#submitUserScorePop').removeClass('nextGo');
                console.log($('#submitUserScore').parent());
                $('#submitUserScorePop').parent().addClass('tagsBarNextDisable');

                $('#submitUserScorePop').attr('data-target', '');

                $('#submitUserScorePop').on('click', function(e){
                    e.preventDefault();
                });
            }

        }else{

            //console.log($(this).attr('value') + ' is unchecked');
            $recoInputValue = $(this).attr('value');
            $('.recoPost').each(function(index){
                if($(this).attr('name') === $recoInputValue){
                    $(this).attr('value', 'notchecked');
                    $(this).trigger('change');
                }
            });

            // style "selected for the selector
            $(this).parent().parent().parent().parent().removeClass('tagSelect');
            var pillHTML = $(this).parent().children()[2].innerHTML.trim();
            //building the pills
            $('.tagsBarItem').each(function(index, value){
                var pillValue = $(this).children().html();
                if(typeof pillHTML !== "undefined" && typeof pillValue !== "undefined"){
                    if(pillValue.trim() === pillHTML.trim()){
                        $(this).remove();
                    }
                }
            });

            counterCheck = counterCheck - 1;
            console.log(counterCheck);
            if(counterCheck >= 5){
                $('#submitUserScorePop').html('Suivant');
                $('#submitUserScorePop').off('click');
                $('#submitUserScorePop').addClass('nextGo');
                console.log($('#submitUserScorePop').html());
                console.log($('#submitUserScorePop').parent());
                $('#submitUserScorePop').parent().removeClass('tagsBarNextDisable');
                $('#submitUserScorePop').attr('data-target', '#modal_register_user');


            }else if(counterCheck < 5){

                if(counterCheck === 0){
                    $('.tagsBarItemEmpty').each(function(index, value){
                        // building the first empty pill on the list
                        if(index === 0){
                            // remove empty class and build pill
                            $(this).addClass('tagsBarItemEmpty');
                            $(this).html('<p class="tagsBarItemP animated fadeIn">Choisissez votre premier critère ci - dessous</p>');
                        }
                    });
                }

                $('#submitUserScorePop').attr('data-target', '');

                console.log($('#submitUserScorePop').html());
                $('#submitUserScorePop').html((5 - counterCheck)+' Restant');
                $('#submitUserScorePop').removeClass('nextGo');
                console.log($('#submitUserScorePop'));
                console.log($('#submitUserScorePop').parent());
                $('#submitUserScorePop').parent().addClass('tagsBarNextDisable');
                $('#submitUserScorePop').on('click', function(e){
                    e.preventDefault();
                });
            }

        }

        // if there is no empty pill left , create one
        if($('.tagsBarItemEmpty').length === 0){
            $('.tagsBarInside').append('<div class="tagsBarItem tagsBarItemEmpty  animated fadeInDown"><p></p></div>');
        }


    });


    /*
     *  Building user score
     */

    $('.recoPost').on('change', function(){

        console.log('hidden input change');

        if($(this).attr('value') === 'checked') {

            switch ($(this).attr('name')) {
                case'artvivre':

                    //console.log('artvivre');

                    //eclat
                    var oldeclatPost = parseInt($('#eclatPost').attr('value'));
                    var neweclatPost = oldeclatPost + 3;

                    //invest
                    var oldinvestPost = parseInt($('#investPost').attr('value'));
                    var newinvestPost = oldinvestPost + 0;

                    //culture
                    var oldculturePost = parseInt($('#culturePost').attr('value'));
                    var newculturePost = oldculturePost + 4;

                    //humanitaire
                    var oldhumaPost = parseInt($('#humaPost').attr('value'));
                    var newhumaPost = oldhumaPost + 3;

                    $('#eclatPost').attr('value', neweclatPost);
                    $('#investPost').attr('value', newinvestPost);
                    $('#culturePost').attr('value', newculturePost);
                    $('#humaPost').attr('value', newhumaPost);

                    break;

                case'solidarite':
                    //console.log('solidarite');
                    //eclat
                    var oldeclatPost = parseInt($('#eclatPost').attr('value'));
                    var neweclatPost = oldeclatPost + 0;

                    //invest
                    var oldinvestPost = parseInt($('#investPost').attr('value'));
                    var newinvestPost = oldinvestPost + 1;

                    //culture
                    var oldculturePost = parseInt($('#culturePost').attr('value'));
                    var newculturePost = oldculturePost + 2;

                    //humanitaire
                    var oldhumaPost = parseInt($('#humaPost').attr('value'));
                    var newhumaPost = oldhumaPost + 7;

                    $('#eclatPost').attr('value', neweclatPost);
                    $('#investPost').attr('value', newinvestPost);
                    $('#culturePost').attr('value', newculturePost);
                    $('#humaPost').attr('value', newhumaPost);
                    break;
                case'bienetre':
                    //console.log('bienetre');
                    //eclat
                    var oldeclatPost = parseInt($('#eclatPost').attr('value'));
                    var neweclatPost = oldeclatPost + 4;

                    //invest
                    var oldinvestPost = parseInt($('#investPost').attr('value'));
                    var newinvestPost = oldinvestPost + 3;

                    //culture
                    var oldculturePost = parseInt($('#culturePost').attr('value'));
                    var newculturePost = oldculturePost + 3;

                    //humanitaire
                    var oldhumaPost = parseInt($('#humaPost').attr('value'));
                    var newhumaPost = oldhumaPost + 0;

                    $('#eclatPost').attr('value', neweclatPost);
                    $('#investPost').attr('value', newinvestPost);
                    $('#culturePost').attr('value', newculturePost);
                    $('#humaPost').attr('value', newhumaPost);
                    break;
                case'divertissement':
                    //console.log('divertissement');
                    //eclat
                    var oldeclatPost = parseInt($('#eclatPost').attr('value'));
                    var neweclatPost = oldeclatPost + 4;

                    //invest
                    var oldinvestPost = parseInt($('#investPost').attr('value'));
                    var newinvestPost = oldinvestPost + 2;

                    //culture
                    var oldculturePost = parseInt($('#culturePost').attr('value'));
                    var newculturePost = oldculturePost + 4;

                    //humanitaire
                    var oldhumaPost = parseInt($('#humaPost').attr('value'));
                    var newhumaPost = oldhumaPost + 0;

                    $('#eclatPost').attr('value', neweclatPost);
                    $('#investPost').attr('value', newinvestPost);
                    $('#culturePost').attr('value', newculturePost);
                    $('#humaPost').attr('value', newhumaPost);
                    break;
                case'histoireculture':
                    //console.log('histoireculture');
                    //eclat
                    var oldeclatPost = parseInt($('#eclatPost').attr('value'));
                    var neweclatPost = oldeclatPost + 1;

                    //invest
                    var oldinvestPost = parseInt($('#investPost').attr('value'));
                    var newinvestPost = oldinvestPost + 1;

                    //culture
                    var oldculturePost = parseInt($('#culturePost').attr('value'));
                    var newculturePost = oldculturePost + 5;

                    //humanitaire
                    var oldhumaPost = parseInt($('#humaPost').attr('value'));
                    var newhumaPost = oldhumaPost + 3;

                    $('#eclatPost').attr('value', neweclatPost);
                    $('#investPost').attr('value', newinvestPost);
                    $('#culturePost').attr('value', newculturePost);
                    $('#humaPost').attr('value', newhumaPost);
                    break;
                case'amoureux':
                    //console.log('amoureux');
                    //eclat
                    var oldeclatPost = parseInt($('#eclatPost').attr('value'));
                    var neweclatPost = oldeclatPost + 3;

                    //invest
                    var oldinvestPost = parseInt($('#investPost').attr('value'));
                    var newinvestPost = oldinvestPost + 3;

                    //culture
                    var oldculturePost = parseInt($('#culturePost').attr('value'));
                    var newculturePost = oldculturePost + 3;

                    //humanitaire
                    var oldhumaPost = parseInt($('#humaPost').attr('value'));
                    var newhumaPost = oldhumaPost + 1;

                    $('#eclatPost').attr('value', neweclatPost);
                    $('#investPost').attr('value', newinvestPost);
                    $('#culturePost').attr('value', newculturePost);
                    $('#humaPost').attr('value', newhumaPost);
                    break;
                case'arts':
                    //console.log('arts');
                    //eclat
                    var oldeclatPost = parseInt($('#eclatPost').attr('value'));
                    var neweclatPost = oldeclatPost + 3;

                    //invest
                    var oldinvestPost = parseInt($('#investPost').attr('value'));
                    var newinvestPost = oldinvestPost + 1;

                    //culture
                    var oldculturePost = parseInt($('#culturePost').attr('value'));
                    var newculturePost = oldculturePost + 4;

                    //humanitaire
                    var oldhumaPost = parseInt($('#humaPost').attr('value'));
                    var newhumaPost = oldhumaPost + 2;

                    $('#eclatPost').attr('value', neweclatPost);
                    $('#investPost').attr('value', newinvestPost);
                    $('#culturePost').attr('value', newculturePost);
                    $('#humaPost').attr('value', newhumaPost);
                    break;
                case'sports':
                    //console.log('sports');
                    //eclat
                    var oldeclatPost = parseInt($('#eclatPost').attr('value'));
                    var neweclatPost = oldeclatPost + 10;

                    //invest
                    var oldinvestPost = parseInt($('#investPost').attr('value'));
                    var newinvestPost = oldinvestPost + 0;

                    //culture
                    var oldculturePost = parseInt($('#culturePost').attr('value'));
                    var newculturePost = oldculturePost + 0;

                    //humanitaire
                    var oldhumaPost = parseInt($('#humaPost').attr('value'));
                    var newhumaPost = oldhumaPost + 0;

                    $('#eclatPost').attr('value', neweclatPost);
                    $('#investPost').attr('value', newinvestPost);
                    $('#culturePost').attr('value', newculturePost);
                    $('#humaPost').attr('value', newhumaPost);
                    break;
                case'vienocturne':
                    //console.log('vienocturne');
                    //eclat
                    var oldeclatPost = parseInt($('#eclatPost').attr('value'));
                    var neweclatPost = oldeclatPost + 7;

                    //invest
                    var oldinvestPost = parseInt($('#investPost').attr('value'));
                    var newinvestPost = oldinvestPost + 0;

                    //culture
                    var oldculturePost = parseInt($('#culturePost').attr('value'));
                    var newculturePost = oldculturePost + 3;

                    //humanitaire
                    var oldhumaPost = parseInt($('#humaPost').attr('value'));
                    var newhumaPost = oldhumaPost + 0;

                    $('#eclatPost').attr('value', neweclatPost);
                    $('#investPost').attr('value', newinvestPost);
                    $('#culturePost').attr('value', newculturePost);
                    $('#humaPost').attr('value', newhumaPost);
                    break;
                case'aventure':
                    //console.log('aventure');
                    //eclat
                    var oldeclatPost = parseInt($('#eclatPost').attr('value'));
                    var neweclatPost = oldeclatPost + 4;

                    //invest
                    var oldinvestPost = parseInt($('#investPost').attr('value'));
                    var newinvestPost = oldinvestPost + 0;

                    //culture
                    var oldculturePost = parseInt($('#culturePost').attr('value'));
                    var newculturePost = oldculturePost + 3;

                    //humanitaire
                    var oldhumaPost = parseInt($('#humaPost').attr('value'));
                    var newhumaPost = oldhumaPost + 3;

                    $('#eclatPost').attr('value', neweclatPost);
                    $('#investPost').attr('value', newinvestPost);
                    $('#culturePost').attr('value', newculturePost);
                    $('#humaPost').attr('value', newhumaPost);
                    break;
                case'affaires':
                    //console.log('affaires');
                    //eclat
                    var oldeclatPost = parseInt($('#eclatPost').attr('value'));
                    var neweclatPost = oldeclatPost + 0;

                    //invest
                    var oldinvestPost = parseInt($('#investPost').attr('value'));
                    var newinvestPost = oldinvestPost + 7;

                    //culture
                    var oldculturePost = parseInt($('#culturePost').attr('value'));
                    var newculturePost = oldculturePost + 0;

                    //humanitaire
                    var oldhumaPost = parseInt($('#humaPost').attr('value'));
                    var newhumaPost = oldhumaPost + 3;

                    $('#eclatPost').attr('value', neweclatPost);
                    $('#investPost').attr('value', newinvestPost);
                    $('#culturePost').attr('value', newculturePost);
                    $('#humaPost').attr('value', newhumaPost);
                    break;
                default:
                    //console.log('default');
                    break;
            }
        }

            if($(this).attr('value') === 'notchecked'){

                switch ($(this).attr('name')) {
                    case'artvivre':

                        //console.log('artvivre');

                        //eclat
                        var oldeclatPost = parseInt($('#eclatPost').attr('value'));
                        var neweclatPost = oldeclatPost - 3;

                        //invest
                        var oldinvestPost = parseInt($('#investPost').attr('value'));
                        var newinvestPost = oldinvestPost - 0;

                        //culture
                        var oldculturePost = parseInt($('#culturePost').attr('value'));
                        var newculturePost = oldculturePost - 4;

                        //humanitaire
                        var oldhumaPost = parseInt($('#humaPost').attr('value'));
                        var newhumaPost = oldhumaPost - 3;

                        $('#eclatPost').attr('value', neweclatPost);
                        $('#investPost').attr('value', newinvestPost);
                        $('#culturePost').attr('value', newculturePost);
                        $('#humaPost').attr('value', newhumaPost);

                        break;

                    case'solidarite':
                       // console.log('solidarite');
                        //eclat
                        var oldeclatPost = parseInt($('#eclatPost').attr('value'));
                        var neweclatPost = oldeclatPost - 0;

                        //invest
                        var oldinvestPost = parseInt($('#investPost').attr('value'));
                        var newinvestPost = oldinvestPost - 1;

                        //culture
                        var oldculturePost = parseInt($('#culturePost').attr('value'));
                        var newculturePost = oldculturePost - 2;

                        //humanitaire
                        var oldhumaPost = parseInt($('#humaPost').attr('value'));
                        var newhumaPost = oldhumaPost - 7;

                        $('#eclatPost').attr('value', neweclatPost);
                        $('#investPost').attr('value', newinvestPost);
                        $('#culturePost').attr('value', newculturePost);
                        $('#humaPost').attr('value', newhumaPost);
                        break;
                    case'bienetre':
                        //console.log('bienetre');
                        //eclat
                        var oldeclatPost = parseInt($('#eclatPost').attr('value'));
                        var neweclatPost = oldeclatPost - 4;

                        //invest
                        var oldinvestPost = parseInt($('#investPost').attr('value'));
                        var newinvestPost = oldinvestPost - 3;

                        //culture
                        var oldculturePost = parseInt($('#culturePost').attr('value'));
                        var newculturePost = oldculturePost - 3;

                        //humanitaire
                        var oldhumaPost = parseInt($('#humaPost').attr('value'));
                        var newhumaPost = oldhumaPost - 0;

                        $('#eclatPost').attr('value', neweclatPost);
                        $('#investPost').attr('value', newinvestPost);
                        $('#culturePost').attr('value', newculturePost);
                        $('#humaPost').attr('value', newhumaPost);
                        break;
                    case'divertissement':
                        //console.log('divertissement');
                        //eclat
                        var oldeclatPost = parseInt($('#eclatPost').attr('value'));
                        var neweclatPost = oldeclatPost - 4;

                        //invest
                        var oldinvestPost = parseInt($('#investPost').attr('value'));
                        var newinvestPost = oldinvestPost - 2;

                        //culture
                        var oldculturePost = parseInt($('#culturePost').attr('value'));
                        var newculturePost = oldculturePost - 4;

                        //humanitaire
                        var oldhumaPost = parseInt($('#humaPost').attr('value'));
                        var newhumaPost = oldhumaPost - 0;

                        $('#eclatPost').attr('value', neweclatPost);
                        $('#investPost').attr('value', newinvestPost);
                        $('#culturePost').attr('value', newculturePost);
                        $('#humaPost').attr('value', newhumaPost);
                        break;
                    case'histoireculture':
                        //console.log('histoireculture');
                        //eclat
                        var oldeclatPost = parseInt($('#eclatPost').attr('value'));
                        var neweclatPost = oldeclatPost - 1;

                        //invest
                        var oldinvestPost = parseInt($('#investPost').attr('value'));
                        var newinvestPost = oldinvestPost - 1;

                        //culture
                        var oldculturePost = parseInt($('#culturePost').attr('value'));
                        var newculturePost = oldculturePost - 5;

                        //humanitaire
                        var oldhumaPost = parseInt($('#humaPost').attr('value'));
                        var newhumaPost = oldhumaPost - 3;

                        $('#eclatPost').attr('value', neweclatPost);
                        $('#investPost').attr('value', newinvestPost);
                        $('#culturePost').attr('value', newculturePost);
                        $('#humaPost').attr('value', newhumaPost);
                        break;
                    case'amoureux':
                        //console.log('amoureux');
                        //eclat
                        var oldeclatPost = parseInt($('#eclatPost').attr('value'));
                        var neweclatPost = oldeclatPost - 3;

                        //invest
                        var oldinvestPost = parseInt($('#investPost').attr('value'));
                        var newinvestPost = oldinvestPost - 3;

                        //culture
                        var oldculturePost = parseInt($('#culturePost').attr('value'));
                        var newculturePost = oldculturePost - 3;

                        //humanitaire
                        var oldhumaPost = parseInt($('#humaPost').attr('value'));
                        var newhumaPost = oldhumaPost - 1;

                        $('#eclatPost').attr('value', neweclatPost);
                        $('#investPost').attr('value', newinvestPost);
                        $('#culturePost').attr('value', newculturePost);
                        $('#humaPost').attr('value', newhumaPost);
                        break;
                    case'arts':
                        //console.log('arts');
                        //eclat
                        var oldeclatPost = parseInt($('#eclatPost').attr('value'));
                        var neweclatPost = oldeclatPost - 3;

                        //invest
                        var oldinvestPost = parseInt($('#investPost').attr('value'));
                        var newinvestPost = oldinvestPost - 1;

                        //culture
                        var oldculturePost = parseInt($('#culturePost').attr('value'));
                        var newculturePost = oldculturePost - 4;

                        //humanitaire
                        var oldhumaPost = parseInt($('#humaPost').attr('value'));
                        var newhumaPost = oldhumaPost - 2;

                        $('#eclatPost').attr('value', neweclatPost);
                        $('#investPost').attr('value', newinvestPost);
                        $('#culturePost').attr('value', newculturePost);
                        $('#humaPost').attr('value', newhumaPost);
                        break;
                    case'sports':
                        //console.log('sports');
                        //eclat
                        var oldeclatPost = parseInt($('#eclatPost').attr('value'));
                        var neweclatPost = oldeclatPost - 10;

                        //invest
                        var oldinvestPost = parseInt($('#investPost').attr('value'));
                        var newinvestPost = oldinvestPost - 0;

                        //culture
                        var oldculturePost = parseInt($('#culturePost').attr('value'));
                        var newculturePost = oldculturePost - 0;

                        //humanitaire
                        var oldhumaPost = parseInt($('#humaPost').attr('value'));
                        var newhumaPost = oldhumaPost - 0;

                        $('#eclatPost').attr('value', neweclatPost);
                        $('#investPost').attr('value', newinvestPost);
                        $('#culturePost').attr('value', newculturePost);
                        $('#humaPost').attr('value', newhumaPost);
                        break;
                    case'vienocturne':
                        //console.log('vienocturne');
                        //eclat
                        var oldeclatPost = parseInt($('#eclatPost').attr('value'));
                        var neweclatPost = oldeclatPost - 7;

                        //invest
                        var oldinvestPost = parseInt($('#investPost').attr('value'));
                        var newinvestPost = oldinvestPost - 0;

                        //culture
                        var oldculturePost = parseInt($('#culturePost').attr('value'));
                        var newculturePost = oldculturePost - 3;

                        //humanitaire
                        var oldhumaPost = parseInt($('#humaPost').attr('value'));
                        var newhumaPost = oldhumaPost - 0;

                        $('#eclatPost').attr('value', neweclatPost);
                        $('#investPost').attr('value', newinvestPost);
                        $('#culturePost').attr('value', newculturePost);
                        $('#humaPost').attr('value', newhumaPost);
                        break;
                    case'aventure':
                        //console.log('aventure');
                        //eclat
                        var oldeclatPost = parseInt($('#eclatPost').attr('value'));
                        var neweclatPost = oldeclatPost - 4;

                        //invest
                        var oldinvestPost = parseInt($('#investPost').attr('value'));
                        var newinvestPost = oldinvestPost - 0;

                        //culture
                        var oldculturePost = parseInt($('#culturePost').attr('value'));
                        var newculturePost = oldculturePost - 3;

                        //humanitaire
                        var oldhumaPost = parseInt($('#humaPost').attr('value'));
                        var newhumaPost = oldhumaPost - 3;

                        $('#eclatPost').attr('value', neweclatPost);
                        $('#investPost').attr('value', newinvestPost);
                        $('#culturePost').attr('value', newculturePost);
                        $('#humaPost').attr('value', newhumaPost);
                        break;
                    case'affaires':
                        //console.log('affaires');
                        //eclat
                        var oldeclatPost = parseInt($('#eclatPost').attr('value'));
                        var neweclatPost = oldeclatPost - 0;

                        //invest
                        var oldinvestPost = parseInt($('#investPost').attr('value'));
                        var newinvestPost = oldinvestPost - 7;

                        //culture
                        var oldculturePost = parseInt($('#culturePost').attr('value'));
                        var newculturePost = oldculturePost - 0;

                        //humanitaire
                        var oldhumaPost = parseInt($('#humaPost').attr('value'));
                        var newhumaPost = oldhumaPost - 3;

                        $('#eclatPost').attr('value', neweclatPost);
                        $('#investPost').attr('value', newinvestPost);
                        $('#culturePost').attr('value', newculturePost);
                        $('#humaPost').attr('value', newhumaPost);
                        break;
                    default:
                        //console.log('default');
                        break;
                }

        }

    });

});