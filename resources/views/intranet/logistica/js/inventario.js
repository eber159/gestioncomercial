$(function () {

  // inicializar controles
  $('.select2').select2()

  CargarComboAlmacen()
  InicializarTabla()
  //InicializarTablaDetalles()

  // LISTAR
  $('#btnListar').on('click', function (event) {
    Listar()
  })

  $("input[type='number']").click(function () {
    $(this).select()
  })
// FIN ONREADY
})

//CARGAR COMBOS
function CargarComboAlmacen() {
  var $combo = $('#idalmacen')
  $combo.empty()
  $.post('../logistica/almacen/Listar',
    function (data) {
      $combo.append("<option value=''>Seleccione</option>")
      $.each(data.lista, function (index, item) {
        $combo.append("<option value='" + item.id + "'>"
          + item.nombre + '</option>')
      })
    }, 'json')
}

//LISTAR

function Listar() 
{
  var url = 'inventario/Listar'
  $.ajax({
    type: 'POST',
    async: false,
    data: { 'idalmacen': $('#idalmacen').val() },
    url: url,
    dataType: 'json',
    beforeSend: function (data) {},
    success: function (data) {
      var oTable = $('#tblDatos').dataTable()
      oTable.fnClearTable()
      if (data !== null && typeof data === 'object') {
        $.each(data.lista, function (key, val) {
          var obj = {
            'IdMaterial': val['idmaterial'],
            'CodMaterial': val['codmaterial'] ,
            'Material': val['nombrematerial'],
            'IdAlmacen': val['idalmacen'],
            'Almacen': val['nombrealmacen'],
            'Stock': val['stock'],
            'Costo': val['costo'],
            'Acciones': "<center><div class='hidden-sm hidden-xs action-buttons'>"
              + '<a href=\'javascript:;\' onclick=\'ListarKardex("registroinventario/Listar",' + val['idmaterial'] + ',' + val['idalmacen'] + ")' class='blue'>"
              + "<i class='ace-icon fa fa-pencil bigger-130'></i>"
              + '</a>'
            + '</div></center>'}
          oTable.fnAddData(obj)
        })
      }
    }
  })
}

function InicializarTabla () 
{
  // var Table = $('#tblRecursos').dataTable().fnDestroy()
  var Table = $('#tblDatos').dataTable({
    'info': false,
    'order': false,
    'search': false,
    'aoColumns': [{
      'bVisible': false, 'mDataProp': 'IdMaterial'
    }, {
      'bVisible': true, 'sWidth': '5%', 'mDataProp': 'CodMaterial'
    }, {
      'sWidth': '13%', 'mDataProp': 'Material'
    }, {
      'bVisible': false,'sWidth': '30%', 'mDataProp': 'IdAlmacen'
    }, {
      'sWidth': '3%', 'mDataProp': 'Almacen'
    }, {
      'sWidth': '10%', 'mDataProp': 'Stock'
    }, {
      'sWidth': '10%', 'mDataProp': 'Costo'
    }, {
      'sWidth': '10%', 'mDataProp': 'Acciones'
    }]
  })
}
