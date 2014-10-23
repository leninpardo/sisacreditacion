/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
(function( $ ){
  $.fn.required = function() {

    if ( $(this).val() == '' ) {
        $(this).addClass('required');
        //$(this).focus();
        return false;
    }else {
        $(this).removeClass('required')
        return true;
    }
  };
})( jQuery );



