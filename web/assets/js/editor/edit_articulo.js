$(document).ready(function() {
  $.fn.editable.defaults.mode = 'inline'
  $.fn.editable.defaults.toggle = 'dblclick'
  $('.nombre').editable({
    type: 'text',
    url: '../assets/php/update_table/update_articulo.php',
    name: 'nombre'

  })
  $('.descripcion').editable({
    type: 'text',
    url: '../assets/php/update_table/update_articulo.php',
    name: 'descripcion'

  })
  $('.NIF_mayorista').editable({
    type: 'text',
    url: '../assets/php/update_table/update_articulo.php',
    name: 'NIF_mayorista'

  })
  $('.descripcion').editable({
    type: 'text',
    url: '../assets/php/update_table/update_articulo.php',
    name: 'descripcion'

  })
  $('.codigo_producto_mayorista').editable({
    type: 'text',
    url: '../assets/php/update_table/update_articulo.php',
    name: 'codigo_producto_mayorista'

  })
  $('.numero_de_serie').editable({
    type: 'text',
    url: '../assets/php/update_table/update_articulo.php',
    name: 'numero_de_serie'

  })
  $('.precio').editable({
    type: 'text',
    url: '../assets/php/update_table/update_articulo.php',
    name: 'precio'

  })
  
  $('.numero_de_factura').editable({
    type: 'text',
    url: '../assets/php/update_table/update_articulo.php',
    name: 'numero_de_factura'

  })
  $('.ubicacion').editable({
    type: 'text',
    url: '../assets/php/update_table/update_articulo.php',
    name: 'ubicacion'

  })
  $('.NIF_cliente_articulo').editable({
    type: 'text',
    url: '../assets/php/update_table/update_articulo.php',
    name: 'NIF_cliente_articulo'

  })

  
})