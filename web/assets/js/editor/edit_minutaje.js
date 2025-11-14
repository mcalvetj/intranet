$(document).ready(function() {
  $.fn.editable.defaults.mode = 'inline'
  $.fn.editable.defaults.toggle = 'dblclick'
  
  $('.hora_entrada').editable({
    type: 'text',
    url: '../assets/php/update_table/update_minutaje.php',
    name: 'hora_entrada'
  })
  $('.hora_salida').editable({
    type: 'text',
    url: '../assets/php/update_table/update_minutaje.php',
    name: 'hora_salida'
  })
    $('.comentario').editable({
        type: 'text',
        url: '../assets/php/update_table/update_minutaje.php',
        name: 'comentario'
    })
})