(function( $ ) {
	'use strict';

    $(document).ready(function() {
        $('#colorpicker1').hide();
        $('#colorpicker1').farbtastic("#color1");
        $("#color1").click(function(){$('#colorpicker1').slideToggle()});
    });

    $(document).ready(function() {
        $('#colorpicker2').hide();
        $('#colorpicker2').farbtastic("#color2");
        $("#color2").click(function(){$('#colorpicker2').slideToggle()});
    });

    $(document).ready(function() {
        $('#colorpicker3').hide();
        $('#colorpicker3').farbtastic("#color3");
        $("#color3").click(function(){$('#colorpicker3').slideToggle()});
    });
    
})( jQuery );
