$(document).ready(function() {
  $.fn.editable.defaults.mode = 'inline'
  $.fn.editable.defaults.toggle = 'dblclick'
  $('.nombre').editable({
    type: 'text',
    url: '../assets/php/update_table/update_sede.php',
    name: 'nombre'

  })
  $('.ubicacion').editable({
    type: 'text',
    url: '../assets/php/update_table/update_sede.php',
    name: 'ubicacion'

  })
  $('.ciudad').editable({
    type: 'text',
    url: '../assets/php/update_table/update_sede.php',
    name: 'ciudad'

  })
  $('.codigo_postal').editable({
    type: 'text',
    url: '../assets/php/update_table/update_sede.php',
    name: 'codigo_postal'

  })
  $('.calle').editable({
    type: 'text',
    url: '../assets/php/update_table/update_sede.php',
    name: 'calle'

  })
  $('.numero').editable({
    type: 'text',
    url: '../assets/php/update_table/update_sede.php',
    name: 'numero'

  })
  $('.telefono').editable({
    type: 'text',
    url: '../assets/php/update_table/update_sede.php',
    name: 'telefono'

  })
  
})
