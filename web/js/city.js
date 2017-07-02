$(document).ready(function() {


    /*
     *      fullpage.js instance
     *      https://github.com/alvarotrigo/fullPage.js/
     */


    $('#fullpage').fullpage({});


    /*
     *      slide down
     */


    $('#cityNext').on('click', function(){

        $.fn.fullpage.moveSectionDown();

    });


});