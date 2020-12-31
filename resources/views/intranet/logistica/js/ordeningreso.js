$(function () {

  // inicializar controles
  $('.select2').select2()
  $('#fechaorden').datepicker({
    format: 'yyyy-mm-dd'
  })

  CargarComboEstado()
  CargarComboMovimientoInventario()
  CargarComboPropietario()
  CargarComboAdministrador()
  CargarComboProducto()
  CargarComboAlmacen()
  InicializarTabla()
  InicializarTablaDetalles()
  Listar()

  // NUEVO
  $('#btnNuevo').on('click', function (event) {
    MostrarRegistro()
    $('#frmRegistro')[0].reset()
    $('#id').val('')
    $('#fechaorden').datepicker('setDate', new Date())
    $('#idestado').val(estadooiosgenerado).trigger('change')
    $('#idmovimientoinventario').val('').trigger('change')
    $('#idempresapropietario').val('').trigger('change')
    $('#idempresaadministra').val('').trigger('change')
    $('#tblDetalles').dataTable().fnClearTable()
    $('#pcantidad').val(0)
    $('#pcosto').val(0)
    $('#pidmaterial').val('').trigger('change')
    $('#pidalmacen').val('').trigger('change')
  })

  // GUARDAR
  $('#btnGuardar').on('click', function (event) {
    GuardarIngreso()
  })

  // LISTAR
  $('#btnListar').on('click', function (event) {
    Listar()
  })

  // Agregar Producto
  $('#btnAgregarProducto').click(function (e) {
    if (validarAgregarProducto()) {
      var oTable = $('#tblDetalles').dataTable()
      var Linea = oTable.fnGetData().length + 1
      var obj = {
        'Row': Linea,
        'Id': '',
        'IdMaterial': $('#pidmaterial').val(),
        'Material': $('#pidmaterial').select2('data')[0].text,
        'IdAlmacen': $('#pidalmacen').val(),
        'Almacen': $('#pidalmacen').select2('data')[0].text,
        "IdUM": $("#pidunidadmedida").val(),
        "UnidadMedida": $("#pidunidadmedida option:selected").text(),
        'Cantidad': "<input type='number' class='form-control2' value= '" + parseFloat($('#pcantidad').val()).toFixed(2) + "' id='txtCantidad" + Linea + "' name='txtCantidad" + Linea + "' style='text-align: right; width: 100px' >",
        'Costo': "<input type='number' class='form-control2' value= '" + parseFloat($('#pcosto').val()).toFixed(2) + "' id='txtCosto" + Linea + "' name='txtCosto" + Linea + "' style='text-align: right; width: 100px' >",
        'Acciones': "<center><div class='hidden-sm hidden-xs action-buttons'>" + "<a href='javascript:;' onclick='Quitar(0," + Linea + ")'>" + "<i class='ace-icon fa fa-times bigger-130'></i>" + '</a>&nbsp;' + '</div></center>',
        'Estado': 1
      }
      oTable.fnAddData(obj)
      $("input[type='number']").click(function () {
        $(this).select()
      })
      InicializarCantidades()
    }
  })

  $("input[type='number']").click(function () {
    $(this).select()
  })
// FIN ONREADY
})

// VALIDACIONES
function validarAgregarProducto () {
  var resultado = true
  var mensaje = ''
  var oTable2 = $('#tblDetalles').DataTable()
  oTable2.rows().eq(0).each(function (index) {
    var row = oTable2.row(index)
    var data = row.data()
    var fila = data['Row']

    var idprod = data['IdMaterial']

    if (data['Estado'] == 1) {
      if ($('#pidmaterial').val() == idprod) {
        mensaje += 'El producto ya existe en la lista <br>'
        resultado = false
      }
    }
  })

  if ($('#pidmaterial').val() == '') {
    mensaje += 'Seleccione un material <br>'
    resultado = false
  }

  console.log($('#pcantidad').val())
  if ($('#pcantidad').val() == '' || parseFloat($('#pcantidad').val()) <= 0) {
    mensaje += 'Ingrese una cantidad válida <br>'
    resultado = false
  }

  if (resultado == false) {
    bootbox.alert(mensaje)
  }
  return resultado
}

// METODOS
function Quitar (iddetalle, linea) {
  bootbox.confirm('¿Seguro que deseas eliminar el registro?', function (result) {
    if (result) {
      if (iddetalle == 0) {
        var oTableDetalles = $('#tblDetalles').dataTable()
        oTableDetalles.fnDeleteRow(linea - 1)
        bootbox.alert('Detalle Eliminado')
      }else {
        var oTableDetalles = $('#tblDetalles').DataTable()
        var row = oTableDetalles.row(linea - 1)
        oTableDetalles.cell(row, 10).data(0).draw()
      }
    }
  })
}

function InicializarCantidades () {
  $('#pcantidad').val(0)
  $('#pcosto').val(0)
  $('#pidmaterial').val('').trigger('change')
  $('#pidalmacen').val('').trigger('change')
}

// CARGAR COMBOS

function CargarComboEstado() {
  var $combo = $("#idestado");
  $combo.empty();
  $.post('../configuracion/categoria/Listar',{"grupo":"ESTADO_ORDEN_INGRESO_SALIDA"},
          function (data) 
          {
            $.each(data.lista, function (index, item) {
            $combo.append("<option value='" + item.id + "'>"
            + item.nombre + "</option>");
                        });
          }, 'json');
}

function CargarComboMovimientoInventario() 
{
  var $combo = $("#idmovimientoinventario");
  $combo.empty();
  $.post('../configuracion/categoria/Listar',{"grupo":"MOVIMIENTO_INVENTARIO"},
          function (data) 
          {
            $.each(data.lista, function (index, item) {
            $combo.append("<option value='" + item.id + "'>"
            + item.nombre + "</option>");
                        });
          }, 'json');
}



function CargarComboPropietario() {
  var $combo = $('#idempresapropietario')
  $combo.empty()
  $.post('../configuracion/empresa/Listar',
    function (data) {
      $combo.append("<option value=''>Seleccione</option>")
      $.each(data.lista, function (index, item) {
        $combo.append("<option value='" + item.id + "'>"
          + item.nombre + '</option>')
      })
    }, 'json')
}

function CargarComboAdministrador() {
  var $combo = $('#idempresaadministra')
  $combo.empty()
  $.post('../configuracion/empresa/Listar',
    function (data) {
      $combo.append("<option value=''>Seleccione</option>")
      $.each(data.lista, function (index, item) {
        $combo.append("<option value='" + item.id + "'>"
          + item.nombre + '</option>')
      })
    }, 'json')
}

function CargarComboProducto() {
  var $combo = $('#pidmaterial')
  $combo.empty()
  $.post('../configuracion/material/Listar',
    function (data) {
      $combo.append("<option value=''>Seleccione</option>")
      $.each(data.lista, function (index, item) {
        $combo.append("<option value='" + item.id + "'>"
          + item.nombre + '</option>')
      })
    }, 'json')
}

function CargarComboAlmacen() {
  var $combo = $('#pidalmacen')
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

// GUARDAR
function GuardarIngreso() {
  // Obtener Objetos
  var detalles = []
  var c = 0
  // Detalles
  var oTable2 = $('#tblDetalles').DataTable()
  oTable2.rows().eq(0).each(function (index) {
    var row = oTable2.row(index)
    var data = row.data()
    var fila = data['Row']
    var obj = {
      'id': data['Id'],
      'idmaterial': data['IdMaterial'],
      'cantidad': $('#txtCantidad' + fila).val(),
      'idlote': lotedefecto ,
      'costoorigen' : $('#txtCosto' + fila).val(),
      'costo' : $('#txtCosto' + fila).val(),
      'idalmacen' : data['IdAlmacen'], 
      "idunidadmedida": data["IdUM"],
      'activo': data['Estado']
    }
    detalles[c] = obj
    c++
  })

  // Cabecera
  var obj = {
    'id': $('#id').val(),
    'idempresapropietario': $('#idempresapropietario').val(),
    'idempresaadministra': $('#idempresaadministra').val(),
    'fechaorden': $('#fechaorden').val(),
    'idtipo': tipoingreso, //categoria tipo orden ingreso
    'idestado': $('#idestado').val(),
    'idmovimientoinventario': $('#idmovimientoinventario').val(),
    'codigooperacion': '',
    'idmodulo': '',
    'glosa':  $('#glosa').val(),
    'detalles': detalles
  }

  var resp = ''
  $.ajax({
    type: 'POST',
    async: false,
    data: obj,
    url: '../logistica/ordeningresosalida/Guardar',
    dataType: 'json',
    beforeSend: function (data) {},
    success: function (data) {
      if (data !== null && typeof data === 'object') {
        if (data.success == true) {
          bootbox.alert(data.message)
          MostrarLista()
          Listar()
          $('#frmRegistro')[0].reset()
          resp = 'ok'
        }
      }else {
        alert('Ocurrio un error en el registro')
        resp = 'error'
      }
    }
  })
  return resp
}

// LISTAR

function Listar() {
  var url = 'ordeningresosalida/Listar'
  $.ajax({
    type: 'POST',
    async: false,
    data: { 'idtipo': tipoingreso },
    url: url,
    dataType: 'json',
    beforeSend: function (data) {},
    success: function (data) {
      var oTable = $('#tblDatos').dataTable()
      oTable.fnClearTable()
      if (data !== null && typeof data === 'object') {
        $.each(data.lista, function (key, val) {
          var obj = {
            'Id': val['id'],
            'Codigo': val['codigo'] ,
            'Fecha': val['fechaorden'],
            'Propietario': val['nombreempresapropietario'],
            'Administra': val['nombreempresaadministra'],
            'Estado': val['nombreestado'],
            'Movimiento': val['nombremovimientoinventario'],
            'Glosa': val['glosa'],
            'Acciones': "<center><div class='hidden-sm hidden-xs action-buttons'>"
              + '<a href=\'javascript:;\' onclick=\'EditarIngreso("ordeningresosalida/Leer","False",' + val['id'] + ")' class='blue'>"
              + "<i class='ace-icon fa fa-pencil bigger-130'></i>"
              + '</a>&nbsp;'
              + '<a href=\'javascript:;\' onclick=\'EditarIngreso("ordeningresosalida/Leer","True",' + val['id'] + ")' class='blue'>"
              + "<i class='ace-icon fa fa-send bigger-130'></i>"
              + '</a>&nbsp;'
              + '<a href=\'javascript:;\' onclick=\'Eliminar("ordeningresosalida/Eliminar",' + val['id'] + ")' class='red'>"
              + "<i class='ace-icon fa fa-times bigger-130'></i>"
              + '</a>'
            + '</div></center>'}
          oTable.fnAddData(obj)
        })
      }
    }
  })
// =================== ********* ====================
}

function EditarIngreso (url,ejecutar,id) {
  $('#frmRegistro')[0].reset()
  var info = ''
  $.ajax({
    type: 'POST',
    async: false,
    data: {'id': id},
    url: url,
    dataType: 'json',
    beforeSend: function (data) {},
    success: function (data) {
      var oTableDetalles = $('#tblDetalles').dataTable()
      oTableDetalles.fnClearTable()
      if (data !== null && typeof data === 'object') {
        $.each(data.obj, function (key, val) {
          $('#id').val(val['id'])
          $('#codigo').val(val['codigo'])
          $('#idempresapropietario').val(val['idempresapropietario']).trigger('change')
          $('#idempresaadministra').val(val['idempresaadministra']).trigger('change')
          $('#idmovimientoinventario').val(val['idmovimientoinventario']).trigger('change')
          $('#fechaorden').datepicker('setDate', val['fechaorden'])
          $('#idestado').val(val['idestado']).trigger('change')
          if (ejecutar == "True")
          {
            console.log(ejecutar);
            $('#idestado').val(estadooiosterminado).trigger('change')
          }
          $('#glosa').val(val['glosa'])
          var Linea = 1
          $.each(data.detalles, function (key, val2) {
            var oTableDetalles = $('#tblDetalles').dataTable()
            var objdet =
            {
              'Row': Linea,
              'Id': val2['id'],
              'IdMaterial': val2['idmaterial'],
              'Material': val2['nombrematerial'],
              'IdAlmacen': val2['idalmacen'],
              'Almacen': val2['nombrealmacen'],
              "IdUM": val2["idunidadmedida"],
              "UnidadMedida": val2["unidadmedida"],
              'Cantidad': "<input type='number' class='form-control2' value= '" + parseFloat(val2['cantidad']).toFixed(2) + "' id='txtCantidad" + Linea + "' name='txtCantidad" + Linea + "' style='text-align: right; width: 100px' >",
              'Costo': "<input type='number' class='form-control2' value= '" + parseFloat(val2['costo']).toFixed(2) + "' id='txtCosto" + Linea + "' name='txtCosto" + Linea + "' style='text-align: right; width: 100px' >",
              'Acciones': "<center><div class='hidden-sm hidden-xs action-buttons'>"
                + "<a href='javascript:;' onclick='Quitar(" + val2['id'] + ',' + Linea + ")'>"
                + "<i class='ace-icon fa fa-times bigger-130'></i>"
                + '</a>&nbsp;'
                + '</div></center>',
              'Estado': 1
            }
            oTableDetalles.fnAddData(objdet)
            Linea++
          })
          MostrarRegistro()
        })
      }
    },
    complete: function () {

    }
  })
// =================== ********* ====================
}

function InicializarTabla () {
  // var Table = $('#tblRecursos').dataTable().fnDestroy()
  var Table = $('#tblDatos').dataTable({
    'info': false,
    'order': false,
    'search': false,
    'aoColumns': [{
      'bVisible': false, 'mDataProp': 'Id'
    }, {
      'bVisible': true, 'sWidth': '5%', 'mDataProp': 'Codigo'
    }, {
      'sWidth': '13%', 'mDataProp': 'Fecha'
    }, {
      'sWidth': '30%', 'mDataProp': 'Propietario'
    }, {
      'sWidth': '3%', 'mDataProp': 'Administra'
    }, {
      'sWidth': '10%', 'mDataProp': 'Estado'
    }, {
      'sWidth': '10%', 'mDataProp': 'Movimiento'
    }, {
      'sWidth': '10%', 'mDataProp': 'Glosa'
    }, {
      'sWidth': '10%', 'mDataProp': 'Acciones'
    }]
  })
}

function InicializarTablaDetalles () {
  var Table = $('#tblDetalles').dataTable({
    'info': false,
    'bFilter': false,
    'bPaginate': false,
    'bSort': false,
    'aoColumns': [{
      'bVisible': true, 'mDataProp': 'Row'
    }, {
      'bVisible': false, 'mDataProp': 'Id'
    }, {
      'bVisible': false, 'mDataProp': 'IdMaterial'
    }, {
      'sWidth': '40%', 'mDataProp': 'Material'
    }, {
      'bVisible': false, 'mDataProp': 'IdAlmacen'
    }, {
      'sWidth': '40%', 'mDataProp': 'Almacen'
    },{
      "bVisible": false, "sWidth": "10%", "mDataProp": "IdUM"
    },{
      "sWidth": "10%", "mDataProp": "UnidadMedida"
    }, {
      'sWidth': '10%', 'mDataProp': 'Cantidad'
    }, {
      'sWidth': '10%', 'mDataProp': 'Costo'
    }, {
      'sWidth': '10%', 'mDataProp': 'Acciones'
    }, {
      'bVisible': false, 'sWidth': '10%', 'mDataProp': 'Estado'
    }]
  })
}
