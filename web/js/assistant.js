console.log('assistant.js');
/*
 * assistant front function
 */
$(document).ready(function() {


    /*
     *      fullpage.js instance
     *      https://github.com/alvarotrigo/fullPage.js/
     */


    $('#fullpage').fullpage({

        //disable arrow for slides
        controlArrows: false,
        //change scroll speed
        scrollingSpeed: 500,
        //disabling horizontal loop for slides
        loopHorizontal: false,
        //disable use of keyboard
        keyboardScrolling: false,

        // defining anchor object
        anchors: ['find'],
        afterSlideLoad: function(anchorLink, index, slideAnchor, slideIndex) {

            /*
             *      navigation changes from slide to slide
             */

            // changing active navigation dot
            $('.nav__item.active').removeClass('active');
            $('.nav__item').eq(slideIndex - 1).addClass('active');

            // disable preventDefault for visited slides
            $('.slides_button').eq(slideIndex - 1).off('click');

            // remove class "slides_active" from previous button
            $('.slides_button.slides_active').removeClass('slides_active');

            // remove class "slides_inactive" from actual button
            $('.slides_button').eq(slideIndex - 1).removeClass('slides_inactive');

            // add class "slides_active" to actual button
            $('.slides_button').eq(slideIndex - 1).addClass('slides_active');

            /*
             *      disabling slide menu form the home page + global menu
             */

            if (slideIndex === 0) {
                $('#find_slides_menu').css('display', 'none');
                $('#find_global_menu').css('display', 'none');
            } else {
                $('#find_slides_menu').css('display', 'block');
                $('#find_global_menu').css('display', 'block');
            }

        },

        onSlideLeave: function(anchorLink, index, slideIndex, direction, nextSlideIndex) {

        },
        afterRender: function() {

        }

    });


    /*
     *      prevent navigation by scrolling / keyboarding / clicking slides menu
     */

    //disabling scrolling (mouse/touch)
    $.fn.fullpage.setAllowScrolling(false, 'all');
    //disabling all keyboard scrolling
    $.fn.fullpage.setKeyboardScrolling(false);
    //disable slides link until answer
    $('.slides_inactive').on('click', function(e) {
        e.preventDefault();
    });


    /*
     *      Answers form validation
     */

    /*
     // disable event on all validation button
     $('.btn.disabled').on('click', function(e){
     e.preventDefault();
     });
     */

    // first question validation H/F
    $('.optionsHF').on('click', function() {

        if (this.checked) {
            console.log('clickchecked');
            // go to the other slide
            $.fn.fullpage.moveSlideRight();
        }
    });
    $('.optionsHF').on('change', function(e) {

        console.log('change');

        // remove active class from previous selection
        $('.optionsHF').parent().removeClass();

        if (this.checked) {

            // writing answer in final form
            $('#finder_gender').attr('value', this.value);

            // add checked cladd
            $(this).parent().addClass('checkedHF');

            // go to the other slide
            $.fn.fullpage.moveSlideRight();

            //$('.btnHF').removeClass('disabled');
            //$('.btnHF').off('click');

        }
    });


    // second question validation -> AGE

    $('.selectnumber').on('click', function(e) {

        console.log('click select number');
        //this.addClass('activeAGE');

    });
    $('.previousnumber_one').on('click', function(e) {
        console.log('click select number');

    });


    // THIRD question validation -> AVIS

    $('.optionAVIS').on('click', function() {

        if (this.checked) {
            console.log('clickchecked');
            // go to the other slide
            $.fn.fullpage.moveSlideRight();
        }
    });

    $('.optionAVIS').on('change', function(e) {

        console.log('change');

        // remove active class from previous selection
        $('.optionAVIS').parent().removeClass();

        if (this.checked) {

            // writing answer in final form
            $('#finder_avis').attr('value', this.value);

            // add checked cladd
            $(this).parent().addClass('checkedAVIS');

            // go to the other slide
            $.fn.fullpage.moveSlideRight();

            //$('.btnHF').removeClass('disabled');
            //$('.btnHF').off('click');

        }
    });

    // 4

    $('.optionDISTANCE').on('click', function() {

        if (this.checked) {
            console.log('clickchecked');
            // go to the other slide
            $.fn.fullpage.moveSlideRight();
        }
    });


    $('.optionDISTANCE').on('change', function(e) {

        console.log('change');

        // remove active class from previous selection
        $('.optionDISTANCE').parent().removeClass();

        if (this.checked) {

            // writing answer in final form
            $('#finder_distance').attr('value', this.value);

            // add checked cladd
            $(this).parent().addClass('checkedDISTANCE');

            // go to the other slide
            $.fn.fullpage.moveSlideRight();

            //$('.btnHF').removeClass('disabled');
            //$('.btnHF').off('click');

        }
    });



    // 5

    $('.optionCLIMAT').on('click', function() {

        if (this.checked) {
            console.log('clickchecked climat');
            // go to the other slide
            //$.fn.fullpage.moveSlideLeft();
            $.fn.fullpage.moveSlideRight();

            //$.fn.fullpage.moveTo(1, 7);

        }
    });



    $('.optionCLIMAT').on('change', function(e) {

        console.log('change');

        // remove active class from previous selection
        $('.optionCLIMAT').parent().removeClass();

        if (this.checked) {

            // writing answer in final form
            $('#finder_climat').attr('value', this.value);

            // add checked cladd
            $(this).parent().addClass('checkedCLIMAT');

            // go to the other slide
            $.fn.fullpage.moveSlideRight();

            //$.fn.fullpage.moveTo(1, 7);


            //$('.btnHF').removeClass('disabled');
            //$('.btnHF').off('click');

        }
    });




    /*
     *      little tweak for the title separator
     */

    if ($(window).width() < 991) {
        $('.titleseparator').css('display', 'none');
        console.log('<991')
    } else {
        $('.titleseparator').css('display', 'block');
        console.log('>991')
    }

    if ($(window).width() < 991) {
        $('.titleseparatorbis').css('display', 'block');
        console.log('<991')
    } else {
        $('.titleseparatorbis').css('display', 'none');
        console.log('>991')
    }




});



$(document).ready(function() {



    // With JQuery
    $('#sliderMONEY').slider({
        tooltip: 'always',
        formatter: function(value) {

            $('#finder_budget').attr('value', value);

            console.log(value);
            return value + ' euros';

        }

    });


});



$(function() {

    var gate = $(window),
        cog = $('#rotator'),
        digit = cog.find('span'),
        slot = digit.eq(0).height(),
        base = 1.5 * slot,
        output = $('#result'),
        up;


    cog.fadeTo(0, 0);

    digit.eq(1).removeClass();
    digit.eq(2).removeClass();
    digit.eq(3).removeClass();
    digit.eq(4).removeClass();
    digit.eq(5).removeClass();

    digit.eq(3).addClass('selectnumber');
    digit.eq(2).addClass('previousnumber_one');
    digit.eq(1).addClass('previousnumber_two');
    digit.eq(4).addClass('nextnumber_one');
    digit.eq(5).addClass('nextnumber_two');

    gate.on('load', function() {

        setTimeout(interAction, 50);
    });

    function interAction() {

        output.text(0);

        cog.scrollTop(base).fadeTo(0, 1).mousewheel(function(turn, delta) {

            if (isBusy()) return false;

            delta < 0 ? up = true : up = false;

            newNumber();

            return false;
        });

        digit.on('touchstart', function(e) {

            var touch = e.originalEvent.touches,
                begin = touch[0].pageY,
                swipe;

            digit.on('touchmove', function(e) {

                var contact = e.originalEvent.touches,
                    end = contact[0].pageY,
                    distance = end - begin;

                if (isBusy()) return;

                if (Math.abs(distance) > 30) {
                    swipe = true;
                    distance > 30 ? up = true : up = false;
                }
            })
                .add(gate).one('touchend', function() {

                if (swipe) {
                    swipe = false;
                    newNumber();
                }

                digit.off('touchmove').add(gate).off('touchend');
            });
        })
            .on('mousedown touchstart', function(e) {

                //console.log('mousedown touchstart');

                if (e.which && e.which != 1) return;

                var item = $(this).index();

                if (item == 1 || item == 3) {

                    digit.one('mouseup touchend', function() {

                        //console.log(' if (item == 1 || item == 3)');

                        if (item == 3) {
                            /*
                             console.log('selectedNUMBER');
                             console.log(item);
                             console.log(this);
                             */


                            $('.activeAGE').removeClass('activeAGE');
                            $(this).addClass('activeAGE');

                            //add in form
                            $('#finder_age').attr('value', $(this).text());
                            //console.log()

                            // go to the other slide
                            $.fn.fullpage.moveSlideRight();

                        }

                        var same = item == $(this).index();

                        if (isBusy() || !same) return cancelIt();

                        item == 1 ? up = true : up = false;

                        //newNumber();

                        return cancelIt();
                    });
                }

                return false;
            });
    }

    function isBusy() {

        return cog.is(':animated');
    }

    function cancelIt() {

        digit.off('mouseup touchend');

        return false;
    }

    function newNumber() {

        var aim = base;

        up ? aim -= slot : aim += slot;

        cog.animate({
            scrollTop: aim
        }, 100, function() {

            up ? digit.eq(95).prependTo(cog) : digit.eq(0).appendTo(cog);

            cog.scrollTop(base);

            digit = cog.find('span');

            output.text(digit.eq(3).text());


            digit.eq(1).removeClass('selectnumber previousnumber_one previousnumber_two nextnumber_one nextnumber_two');
            digit.eq(2).removeClass('selectnumber previousnumber_one previousnumber_two nextnumber_one nextnumber_two');
            digit.eq(3).removeClass('selectnumber previousnumber_one previousnumber_two nextnumber_one nextnumber_two');
            digit.eq(4).removeClass('selectnumber previousnumber_one previousnumber_two nextnumber_one nextnumber_two');
            digit.eq(5).removeClass('selectnumber previousnumber_one previousnumber_two nextnumber_one nextnumber_two');


            digit.eq(3).addClass('selectnumber');

            digit.eq(2).addClass('previousnumber_one');
            digit.eq(1).addClass('previousnumber_two');

            digit.eq(4).addClass('nextnumber_one');
            digit.eq(5).addClass('nextnumber_two');

            $('#selectedAGE').text(digit.eq(3).text());
            $('#optionAGE').attr('value', digit.eq(3).text());


        });
    }
});