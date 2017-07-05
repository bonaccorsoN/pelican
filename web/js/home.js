$(document).ready(function() {

    /*
     * messenger bot ??
     */

    $(function() {
        var now = new Date();
        $('.screen-content').fbMessenger({
            botName: 'Le Pélican',
            botBannerUrl: '../img/bot/unsplash-presentfinder-banner-luca-upper.jpg',
            botLogoUrl: '../img/bot/profil_pict_lepelican.png',
            loop: false
        })
            .fbMessenger('start', { delay: 0 } )
            .fbMessenger('typingIndicator', { delay: 1000 })
            .fbMessenger('message', 'bot', 'Bonjour Hervé', { timestamp: now, delay: 1000 })
            .fbMessenger('typingIndicator', { delay: 1000 })
            .fbMessenger('message', 'user', 'Bonjour Le Pélican', { timestamp: now, delay: 0 })
            .fbMessenger('typingIndicator', { delay: 1000 })
            .fbMessenger('message', 'bot', 'Nous avons trouvé des offres correspondant à vos critères :', { timestamp: now, delay: 1500 })
            .fbMessenger('showGenericTemplate', [
                {
                    imageUrl: '../bot/img/pattaya2.jpg',
                    title: 'Pattaya - Villa - Laguna Bay',
                    subtitle: 'Find seasonal presents for Christmas.',
                    buttons: [
                        'Sélectionner cette offre'
                    ]
                },
                {
                    imageUrl: '../bot/img/pattaya1.jpg',
                    title: 'Pattaya - Villa - Laguna Bay',
                    subtitle: 'Jolie villa dans la résidence principale<br>700€/mois',
                    buttons: [
                        'Sélectionner cette offre'
                    ]
                },
                {
                    imageUrl: '../bot/img/pattaya3.jpg',
                    title: 'Pattaya - Villa - Laguna Bay',
                    subtitle: 'Find presents for bride and groom.',
                    buttons: [
                        'Sélectionner cette offre'
                    ]
                }
            ], { timestamp: now, delay: 2000 })
            .fbMessenger('scrollGenericTemplate', 1, { delay: 1500 })
            .fbMessenger('scrollGenericTemplate', 2, { delay: 1500 })
            .fbMessenger('scrollGenericTemplate', 1, { delay: 1500 })
            .fbMessenger('message', 'user', 'Je choisis la villa de Laguna Bay', { timestamp: now, delay: 3000 })
            .fbMessenger('typingIndicator', { delay: 500 })
            .fbMessenger('message', 'bot', 'Très bon choix Hervé !', { timestamp: now, delay: 1500 })
            .fbMessenger('run');
    });

    /*
     * smooth scrolling
     */

    // Select all links with hashes
    $('a[href*="#"]')
    // Remove links that don't actually link to anything
        .not('[href="#"]')
        .not('[href="#0"]')
        .click(function(event) {
            // On-page links
            if (
                location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
                &&
                location.hostname == this.hostname
            ) {
                // Figure out element to scroll to
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                // Does a scroll target exist?
                if (target.length) {
                    // Only prevent default if animation is actually gonna happen
                    event.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 1000, function() {
                        // Callback after animation
                        // Must change focus!
                        var $target = $(target);
                        $target.focus();
                        if ($target.is(":focus")) { // Checking if the target was focused
                            return false;
                        } else {
                            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
                            $target.focus(); // Set focus again
                        };
                    });
                }
            }
        });


    /*
     * modals
     */

    $('#modal_video').on('show.bs.modal', function(e){
        $('#explainervideo').get(0).play();
    });

    $('#modal_video').on('hide.bs.modal', function(e){
        $('#explainervideo').get(0).pause();
    });

    $('#modal_close').on('click', function () {
        $('#modal_mail').modal('hide');
    });



    /*
     * effets desktop
     */

    if($(window).width() > 991){

        $(document).scroll(function() {

            var anchor_menu = $('#anchor_menu').offset().top;
            var anchor_service = $('#service').offset().top;

            $(window).on('scroll', function() {

                if ( $(window).scrollTop() > anchor_menu ){

                    $('#manifesto_header').addClass('SlideInDown');
                    $('#manifesto_header').css('display', 'block');
                    $('.manifesto_explainer_txt_container > div').each(function(i){
                        //console.log(i);
                        $(this).addClass('explainerShow'+i);
                    });

                }

                if ( $(window).scrollTop() > anchor_service ){
                }

            });



        });

    }else{
    }


});