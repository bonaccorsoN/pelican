$(document).ready(function() {

    console.log('reco.js');



    /*
     *  Building recommendation form
     */

    $('.recoInput').on('change', function(e){
        if($(this).is(':checked')){

            console.log($(this).attr('value') + ' is checked');
            $recoInputValue = $(this).attr('value');
            $('.recoPost').each(function(index){
                if($(this).attr('name') === $recoInputValue){
                    $(this).attr('value', 'checked');
                    $(this).trigger('change');
                }
            });

        }else{

            console.log($(this).attr('value') + ' is unchecked');
            $recoInputValue = $(this).attr('value');
            $('.recoPost').each(function(index){
                if($(this).attr('name') === $recoInputValue){
                    $(this).attr('value', 'notchecked');
                    $(this).trigger('change');
                }
            });

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

                    console.log('artvivre');

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
                    console.log('solidarite');
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
                    console.log('bienetre');
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
                    console.log('divertissement');
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
                    console.log('histoireculture');
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
                    console.log('amoureux');
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
                    console.log('arts');
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
                    console.log('sports');
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
                    console.log('vienocturne');
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
                    console.log('aventure');
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
                    console.log('affaires');
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
                    console.log('default');
                    break;
            }
        }

            if($(this).attr('value') === 'notchecked'){

                switch ($(this).attr('name')) {
                    case'artvivre':

                        console.log('artvivre');

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
                        console.log('solidarite');
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
                        console.log('bienetre');
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
                        console.log('divertissement');
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
                        console.log('histoireculture');
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
                        console.log('amoureux');
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
                        console.log('arts');
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
                        console.log('sports');
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
                        console.log('vienocturne');
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
                        console.log('aventure');
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
                        console.log('affaires');
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
                        console.log('default');
                        break;
                }

        }

    });

});