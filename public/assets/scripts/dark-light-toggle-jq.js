$(document).ready(function(){
		
		
    // Check local storage and set theme
    if(localStorage.theme) {

        $('body').addClass( localStorage.theme );

    } 
    else{

        $('body').addClass('light-mode'); // set default theme. No need to set via php now

    }



    //Switch theme and store in local storage ...

    $("#themeToggle").click(function(){

         if ($('body').hasClass( 'light-mode')){

            $('body').removeClass('light-mode').addClass('dark-mode');
            localStorage.theme = 'dark-mode';


         }
         else  {

            $('body').removeClass('dark-mode').addClass('light-mode');
            localStorage.theme = 'light-mode';

         }
       });

});