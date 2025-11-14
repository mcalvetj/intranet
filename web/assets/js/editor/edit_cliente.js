$(document).ready(function() {
  $.fn.editable.defaults.mode = 'inline'
  $.fn.editable.defaults.toggle = 'dblclick'
  $('.nombre_completo').editable({
    type: 'text',
    url: '../assets/php/update_table/update_cliente.php',
    name: 'nombre_completo'

  })

  $('.nombre_comercial').editable({
    type: 'text',
    url: '../assets/php/update_table/update_cliente.php',
    name: 'nombre_comercial'

  })
  $('.telefono').editable({
    type: 'text',
    url: '../assets/php/update_table/update_cliente.php',
    name: 'telefono'

  })
  $('.email').editable({
    type: 'text',
    url: '../assets/php/update_table/update_cliente.php',
    name: 'email'

  })
  $('.ciudad_facturacion').editable({
    type: 'text',
    url: '../assets/php/update_table/update_cliente.php',
    name: 'ciudad_facturacion'

  })
  $('.codigo_postal_facturacion').editable({
    type: 'text',
    url: '../assets/php/update_table/update_cliente.php',
    name: 'codigo_postal_facturacion'

  })
  $('.calle_facturacion').editable({
    type: 'text',
    url: '../assets/php/update_table/update_cliente.php',
    name: 'calle_facturacion'

  })
  $('.numero_facturacion').editable({
    type: 'text',
    url: '../assets/php/update_table/update_cliente.php',
    name: 'numero_facturacion'

  })
  $('.ciudad_envio').editable({
    type: 'text',
    url: '../assets/php/update_table/update_cliente.php',
    name: 'ciudad_envio'

  })
  $('.codigo_postal_envio').editable({
    type: 'text',
    url: '../assets/php/update_table/update_cliente.php',
    name: 'codigo_postal_envio'

  })
  $('.calle_envio').editable({
    type: 'text',
    url: '../assets/php/update_table/update_cliente.php',
    name: 'calle_envio'

  })
  $('.numero_envio').editable({
    type: 'text',
    url: '../assets/php/update_table/update_cliente.php',
    name: 'numero_envio'

  })
  $('.IBAN').editable({
    type: 'text',
    url: '../assets/php/update_table/update_cliente.php',
    name: 'IBAN'

  })
  $('.SEPA').editable({
    type: 'text',
    url: '../assets/php/update_table/update_cliente.php',
    name: 'SEPA'

  })
 })
