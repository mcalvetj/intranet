$(document).ready(function() {
  $.fn.editable.defaults.mode = 'inline'
  $.fn.editable.defaults.toggle = 'dblclick'

  $('.nombre').editable({
    type: 'text',
    url: '../assets/php/update_table/update_contacto.php',
    name: 'nombre'

  })
  $('.sede').editable({
    type: 'text',
    url: '../assets/php/update_table/update_contacto.php',
    name: 'sede'

  })
  $('.cargo').editable({
    type: 'text',
    url: '../assets/php/update_table/update_contacto.php',
    name: 'cargo'

  })
  $('.email').editable({
    type: 'text',
    url: '../assets/php/update_table/update_contacto.php',
    name: 'email'

  })
  $('.telefono').editable({
    type: 'text',
    url: '../assets/php/update_table/update_contacto.php',
    name: 'telefono'

  })
  $('.pais').editable({
    type: 'text',
    url: '../assets/php/update_table/update_contacto.php',
    name: 'pais'

  })
  $('.extension').editable({
    type: 'text',
    url: '../assets/php/update_table/update_contacto.php',
    name: 'extension'

  })
})
