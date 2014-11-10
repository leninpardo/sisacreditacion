// Hay que recordar la importancia de comenzar
// a ejecutar javascript cuando termine de cargar
// la p�gina para evitar inconscistencias.
$(document).ready(function() {
  var menu = $('#menu');
  var contenedor = $('#menu-contenedor');
  var menu_offset = menu.offset();
  // Cada vez que se haga scroll en la p�gina
  // haremos un chequeo del estado del men�
  // y lo vamos a alternar entre 'fixed' y 'static'.
  $(window).on('scroll', function() {
    if($(window).scrollTop() > menu_offset.top) {
      menu.addClass('menu-fijo');
    } else {
      menu.removeClass('menu-fijo');
    }
  });
});