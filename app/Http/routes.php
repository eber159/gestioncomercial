<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//EXTRANET

Route::get('login', function () {
    return View::make('intranet.seguridad.login');
});

Route::get('registro', function () {
    return View::make('extranet.registro');
});

Route::get('verproducto/{id}', 'MaterialController@verProducto');

Route::get('/', 'WebController@irInicio');
Route::get('inicio', 'WebController@irInicio');
Route::get('nosotros', 'WebController@irNosotros');
Route::get('contacto', 'WebController@irContacto');
Route::get('terminos', 'WebController@irTerminos');
Route::get('carrito', 'WebController@irCarrito');
Route::get('productos/{id}', 'WebController@irProductos');
Route::get('verproducto/{id}', 'WebController@verProducto');
Route::get('verpublicacion/{id}', 'WebController@verPublicacion');
Route::get('verificar_ruta', 'WebController@verRuta');
Route::get('registrarpedido', 'WebController@OrdenPedidoExterno');
Route::post('agregarproductocarro', 'WebController@AgregarProducto');
Route::post('quitarproductocarro', 'WebController@QuitarProductoCarro');
Route::post('actualizarcantidadcarro', 'WebController@ActualizarProductoCarro');

//INTRANET

Route::get('{ruta}/{ruta2}/{ruta3}', 'WebController@irPagina');

// Intranet
Route::get('intranet', function () {
    $opciones = Session::get("opcionesperfil");
    if(Session::get("idusuario")!=""){
        return View::make('intranet.inicio', array('opciones' => $opciones));
    }else{
        return view('intranet.seguridad.login');
    }
});


Route::post('logear', 'UsuarioController@Logear');
Route::post('acceder', 'UsuarioController@Acceder');
Route::post('accedercliente', 'UsuarioController@AccederCliente');
Route::post('logout', 'UsuarioController@Logout');
Route::post('refrescaropciones', 'UsuarioController@RefrescarOpciones');

//Tipo de cambio
Route::post('/intranet/configuracion/tipocambio/Listar', 'TipocambioController@Listar');
Route::post('/intranet/configuracion/tipocambio/Guardar', 'TipocambioController@Guardar');
Route::post('/intranet/configuracion/tipocambio/Leer', 'TipocambioController@Leer');
Route::post('/intranet/configuracion/tipocambio/Eliminar', 'TipocambioController@Eliminar');

//Familias
Route::post('/intranet/configuracion/familia/Listar', 'FamiliaController@Listar');
Route::post('/intranet/configuracion/familia/Guardar', 'FamiliaController@Guardar');
Route::post('/intranet/configuracion/familia/Leer', 'FamiliaController@Leer');
Route::post('/intranet/configuracion/familia/Eliminar', 'FamiliaController@Eliminar');

Route::post('/intranet/seguridad/usuario/Listar', 'UsuarioController@Listar');
Route::post('/intranet/seguridad/usuario/Guardar', 'UsuarioController@Guardar');
Route::post('/intranet/seguridad/usuario/Leer', 'UsuarioController@Leer');
Route::post('/intranet/seguridad/usuario/Eliminar', 'UsuarioController@Eliminar');
Route::post('/intranet/seguridad/usuario/RegistroWeb', 'UsuarioController@RegistroWeb');
Route::post('/intranet/seguridad/usuario/CambiarEstado', 'UsuarioController@CambiarEstado');
Route::post('/intranet/seguridad/usuario/enviarclave', 'UsuarioController@EnviarCorreoPassword');

Route::post('/intranet/seguridad/perfil/Listar', 'PerfilController@Listar');
Route::post('/intranet/seguridad/perfil/Guardar', 'PerfilController@Guardar');
Route::post('/intranet/seguridad/perfil/Leer', 'PerfilController@Leer');
Route::post('/intranet/seguridad/perfil/Eliminar', 'PerfilController@Eliminar');

Route::post('/intranet/configuracion/empresa/Listar', 'EmpresaController@Listar');
Route::post('/intranet/configuracion/empresa/Guardar', 'EmpresaController@Guardar');
Route::post('/intranet/configuracion/empresa/Leer', 'EmpresaController@Leer');
Route::post('/intranet/configuracion/empresa/Eliminar', 'EmpresaController@Eliminar');
Route::post('/intranet/configuracion/empresa/GuardadoRapido', 'EmpresaController@GuardadoRapido');

Route::post('/intranet/configuracion/categoria/Listar', 'CategoriaController@Listar');
Route::post('/intranet/configuracion/categoria/ListarGrupos', 'CategoriaController@ListarGrupos');
Route::post('/intranet/configuracion/categoria/Guardar', 'CategoriaController@Guardar');
Route::post('/intranet/configuracion/categoria/Leer', 'CategoriaController@Leer');
Route::post('/intranet/configuracion/categoria/Eliminar', 'CategoriaController@Eliminar');

Route::post('/intranet/configuracion/material/Listar', 'MaterialController@Listar');
Route::post('/intranet/configuracion/material/ListarFiltros', 'MaterialController@ListarFiltros');
Route::post('/intranet/configuracion/material/Guardar', 'MaterialController@Guardar');
Route::post('/intranet/configuracion/material/Leer', 'MaterialController@Leer');
Route::post('/intranet/configuracion/material/Eliminar', 'MaterialController@Eliminar');

Route::post('/intranet/configuracion/item/Listar', 'ItemController@Listar');
Route::post('/intranet/configuracion/item/ListarFiltros', 'ItemController@ListarFiltros');
Route::post('/intranet/configuracion/item/Guardar', 'ItemController@Guardar');
Route::post('/intranet/configuracion/item/Leer', 'ItemController@Leer');
Route::post('/intranet/configuracion/item/Eliminar', 'ItemController@Eliminar');

Route::post('/intranet/seguridad/objeto/Listar', 'ObjetoController@Listar');
Route::post('/intranet/seguridad/objeto/Guardar', 'ObjetoController@Guardar');
Route::post('/intranet/seguridad/objeto/Leer', 'ObjetoController@Leer');
Route::post('/intranet/seguridad/objeto/Eliminar', 'ObjetoController@Eliminar');

Route::post('/intranet/seguridad/perfilusuario/Listar', 'PerfilusuarioController@Listar');
Route::post('/intranet/seguridad/perfilusuario/Guardar', 'PerfilusuarioController@Guardar');
Route::post('/intranet/seguridad/perfilusuario/Leer', 'PerfilusuarioController@Leer');
Route::post('/intranet/seguridad/perfilusuario/Eliminar', 'PerfilusuarioController@Eliminar');


Route::post('/intranet/seguridad/perfilobjeto/Listar', 'PerfilobjetoController@Listar');
Route::post('/intranet/seguridad/perfilobjeto/Guardar', 'PerfilobjetoController@Guardar');
Route::post('/intranet/seguridad/perfilobjeto/Leer', 'PerfilobjetoController@Leer');
Route::post('/intranet/seguridad/perfilobjeto/Eliminar', 'PerfilobjetoController@Eliminar');

Route::post('/intranet/configuracion/sede/Listar', 'SedeController@Listar');
Route::post('/intranet/configuracion/sede/Guardar', 'SedeController@Guardar');
Route::post('/intranet/configuracion/sede/Leer', 'SedeController@Leer');
Route::post('/intranet/configuracion/sede/Eliminar', 'SedeController@Eliminar');

Route::post('/intranet/configuracion/trabajador/Listar', 'TrabajadorController@Listar');
Route::post('/intranet/configuracion/trabajador/Guardar', 'TrabajadorController@Guardar');
Route::post('/intranet/configuracion/trabajador/Leer', 'TrabajadorController@Leer');
Route::post('/intranet/configuracion/trabajador/Eliminar', 'TrabajadorController@Eliminar');

Route::post('/intranet/comercial/ordenpedido/Listar', 'OrdenpedidoController@Listar');
Route::post('/intranet/comercial/ordenpedido/ListarCodigo', 'OrdenpedidoController@ListarCodigo');
Route::post('/intranet/comercial/ordenpedido/Listar2', 'OrdenpedidoController@Listar2');
Route::post('/intranet/comercial/ordenpedido/Guardar', 'OrdenpedidoController@Guardar');
Route::post('/intranet/comercial/ordenpedido/Leer', 'OrdenpedidoController@Leer');
Route::post('/intranet/comercial/ordenpedido/Eliminar', 'OrdenpedidoController@Eliminar');
Route::post('/intranet/comercial/ordenpedido/CambiarEstado', 'OrdenpedidoController@CambiarEstado');
Route::post('/intranet/comercial/ordenpedido/AtenderPedido', 'OrdenpedidoController@AtenderPedido');
Route::post('/intranet/comercial/ordenpedido/RechazarPedido', 'OrdenpedidoController@RechazarPedido');
Route::post('/intranet/comercial/ordenpedido/GuardarExterno', 'OrdenpedidoController@GuardarExterno');
Route::post('/intranet/comercial/ordenpedido/GuardarPedidoWeb', 'OrdenpedidoController@GuardarPedidoWeb');
Route::post('/intranet/comercial/ordenpedido/AgregarPedidoWeb', 'OrdenpedidoController@AgregarPedidoWeb');
Route::post('/intranet/comercial/ordenpedido/AgregarFormaPago', 'OrdenpedidoController@AgregarFormaPago');
Route::post('agregarproductocarrovendedor', 'OrdenpedidoController@AgregarPedidoWebVendedor');

Route::post('/intranet/configuracion/unidadmedida/Listar', 'UnidadmedidaController@Listar');
Route::post('/intranet/configuracion/unidadmedida/ListarFiltros', 'UnidadmedidaController@ListarFiltros');
Route::post('/intranet/configuracion/unidadmedida/Guardar', 'UnidadmedidaController@Guardar');
Route::post('/intranet/configuracion/unidadmedida/Leer', 'UnidadmedidaController@Leer');
Route::post('/intranet/configuracion/unidadmedida/Eliminar', 'UnidadmedidaController@Eliminar');

Route::post('/intranet/configuracion/familia/Listar', 'FamiliaController@Listar');
Route::post('/intranet/configuracion/familia/ListarFiltros', 'FamiliaController@ListarFiltros');
Route::post('/intranet/configuracion/familia/Guardar', 'FamiliaController@Guardar');
Route::post('/intranet/configuracion/familia/Leer', 'FamiliaController@Leer');
Route::post('/intranet/configuracion/familia/Eliminar', 'FamiliaController@Eliminar');

Route::post('/intranet/configuracion/subfamilia/Listar', 'SubfamiliaController@Listar');
Route::post('/intranet/configuracion/subfamilia/ListarFiltros', 'SubfamiliaController@ListarFiltros');
Route::post('/intranet/configuracion/subfamilia/Guardar', 'SubfamiliaController@Guardar');
Route::post('/intranet/configuracion/subfamilia/Leer', 'SubfamiliaController@Leer');
Route::post('/intranet/configuracion/subfamilia/Eliminar', 'SubfamiliaController@Eliminar');

Route::post('/intranet/configuracion/serie/Listar', 'SerieController@Listar');
Route::post('/intranet/configuracion/serie/Guardar', 'SerieController@Guardar');
Route::post('/intranet/configuracion/serie/Leer', 'SerieController@Leer');
Route::post('/intranet/configuracion/serie/Eliminar', 'SerieController@Eliminar');
Route::post('/intranet/configuracion/serie/ListarCorrelativo', 'SerieController@ListarCorrelativo');

Route::post('/intranet/logistica/almacen/Listar', 'AlmacenController@Listar');
Route::post('/intranet/logistica/almacen/Guardar', 'AlmacenController@Guardar');
Route::post('/intranet/logistica/almacen/Leer', 'AlmacenController@Leer');
Route::post('/intranet/logistica/almacen/Eliminar', 'AlmacenController@Eliminar');

Route::post('/intranet/logistica/clasealmacen/Listar', 'ClasealmacenController@Listar');
Route::post('/intranet/logistica/clasealmacen/Guardar', 'ClasealmacenController@Guardar');
Route::post('/intranet/logistica/clasealmacen/Leer', 'ClasealmacenController@Leer');
Route::post('/intranet/logistica/clasealmacen/Eliminar', 'ClasealmacenController@Eliminar');

Route::post('/intranet/logistica/tipoalmacen/Listar', 'TipoalmacenController@Listar');
Route::post('/intranet/logistica/tipoalmacen/Guardar', 'TipoalmacenController@Guardar');
Route::post('/intranet/logistica/tipoalmacen/Leer', 'TipoalmacenController@Leer');
Route::post('/intranet/logistica/tipoalmacen/Eliminar', 'TipoalmacenController@Eliminar');

Route::post('/intranet/logistica/ordeningresosalida/Listar', 'OrdeningresosalidaController@Listar');
Route::post('/intranet/logistica/ordeningresosalida/Guardar', 'OrdeningresosalidaController@Guardar');
Route::post('/intranet/logistica/ordeningresosalida/Leer', 'OrdeningresosalidaController@Leer');
Route::post('/intranet/logistica/ordeningresosalida/Eliminar', 'OrdeningresosalidaController@Eliminar');

Route::post('/intranet/logistica/inventario/Listar', 'InventarioalmacenController@Listar');
Route::post('/intranet/logistica/inventario/Kardex', 'InventarioalmacenController@Kardex');

Route::post('/intranet/comercial/ordenventa/Listar', 'OrdenventaController@Listar');
Route::post('/intranet/comercial/ordenventa/Guardar', 'OrdenventaController@Guardar');
Route::post('/intranet/comercial/ordenventa/Leer', 'OrdenventaController@Leer');
Route::post('/intranet/comercial/ordenventa/Eliminar', 'OrdenventaController@Eliminar');
Route::post('/intranet/comercial/ordenventa/Anular', 'OrdenventaController@Anular');
Route::post('/intranet/comercial/ordenventa/GenerarDocumento', 'OrdenventaController@GenerarDocumento');
Route::post('/intranet/comercial/ordenventa/GenerarOrdenSalida', 'OrdenventaController@GenerarOrdenSalida');

Route::post('/intranet/logistica/lote/Listar', 'LoteController@Listar');


// Reportes

Route::get('/intranet/comercial/impresionpedido/{usuario}/{idpedido}/{tiporeporte}/{tamanio}', 'ReportesController@ImpresionPedidos');
Route::post('/intranet/reportes/cuentasporcobrar', 'ReportesController@CuentasPorCobrar');
Route::post('/intranet/reportes/cuentasporcobrarexp', 'ReportesController@CuentasPorCobrar_Exportar');
Route::post('/intranet/reportes/movimientoscaja', 'ReportesController@MovimientosCaja');
Route::post('/intranet/reportes/pedidos', 'ReportesController@Pedidos');
Route::post('/intranet/reportes/detallepedido', 'ReportesController@DetallePedidos');
Route::post('/intranet/reportes/ventas', 'ReportesController@Ventas');
Route::post('/intranet/reportes/compras', 'ReportesController@Compras');
Route::post('/intranet/reportes/ventascantidad', 'ReportesController@VentasCantidad');
Route::post('/intranet/reportes/clientes', 'ReportesController@Clientes');
Route::post('/intranet/reportes/proveedores', 'ReportesController@Proveedores');
Route::post('/intranet/reportes/productos', 'ReportesController@Productos');
Route::post('/intranet/reportes/alertaventas', 'ReportesController@AlertaVentas');



// =========================================== WEB =====================================================//

Route::post('/intranet/configuracion/informaciongeneral/Listar', 'InformaciongeneralController@Listar');
Route::post('/intranet/configuracion/informaciongeneral/Guardar', 'InformaciongeneralController@Guardar');
Route::post('/intranet/configuracion/informaciongeneral/Leer', 'InformaciongeneralController@Leer');
Route::post('/intranet/configuracion/informaciongeneral/Eliminar', 'InformaciongeneralController@Eliminar');

Route::post('/intranet/configuracion/servicio/Listar', 'ServicioController@Listar');
Route::post('/intranet/configuracion/servicio/Guardar', 'ServicioController@Guardar');
Route::post('/intranet/configuracion/servicio/Leer', 'ServicioController@Leer');
Route::post('/intranet/configuracion/servicio/Eliminar', 'ServicioController@Eliminar');

Route::post('/intranet/configuracion/linea/Listar', 'LineaController@Listar');
Route::post('/intranet/configuracion/linea/Guardar', 'LineaController@Guardar');
Route::post('/intranet/configuracion/linea/Leer', 'LineaController@Leer');
Route::post('/intranet/configuracion/linea/Eliminar', 'LineaController@Eliminar');

Route::post('/intranet/configuracion/productoweb/Listar', 'ProductowebController@Listar');
Route::post('/intranet/configuracion/productoweb/Guardar', 'ProductowebController@Guardar');
Route::post('/intranet/configuracion/productoweb/Leer', 'ProductowebController@Leer');
Route::post('/intranet/configuracion/productoweb/Eliminar', 'ProductowebController@Eliminar');
Route::post('/intranet/configuracion/productoweb/LeerTalla', 'ProductowebController@LeerTalla');

Route::post('/intranet/configuracion/productowebrecurso/Listar', 'ProductowebrecursoController@Listar');
Route::post('/intranet/configuracion/productowebrecurso/GuardarImagen', 'ProductowebrecursoController@GuardarImagen');
Route::post('/intranet/configuracion/productowebrecurso/GuardarVideo', 'ProductowebrecursoController@GuardarVideo');
Route::post('/intranet/configuracion/productowebrecurso/Leer', 'ProductowebrecursoController@Leer');
Route::post('/intranet/configuracion/productowebrecurso/Eliminar', 'ProductowebrecursoController@Eliminar');

Route::post('/intranet/configuracion/testimonio/Listar', 'TestimonioController@Listar');
Route::post('/intranet/configuracion/testimonio/Guardar', 'TestimonioController@Guardar');
Route::post('/intranet/configuracion/testimonio/Leer', 'TestimonioController@Leer');
Route::post('/intranet/configuracion/testimonio/Eliminar', 'TestimonioController@Eliminar');

Route::post('/intranet/configuracion/nosotros/Listar', 'NosotrosController@Listar');
Route::post('/intranet/configuracion/nosotros/Guardar', 'NosotrosController@Guardar');
Route::post('/intranet/configuracion/nosotros/Leer', 'NosotrosController@Leer');
Route::post('/intranet/configuracion/nosotros/Eliminar', 'NosotrosController@Eliminar');

Route::post('/intranet/configuracion/slider/Listar', 'SliderController@Listar');
Route::post('/intranet/configuracion/slider/Guardar', 'SliderController@Guardar');
Route::post('/intranet/configuracion/slider/Leer', 'SliderController@Leer');
Route::post('/intranet/configuracion/slider/Eliminar', 'SliderController@Eliminar');

Route::post('/intranet/configuracion/enlaces/Listar', 'EnlacesController@Listar');
Route::post('/intranet/configuracion/enlaces/Guardar', 'EnlacesController@Guardar');
Route::post('/intranet/configuracion/enlaces/Leer', 'EnlacesController@Leer');
Route::post('/intranet/configuracion/enlaces/Eliminar', 'EnlacesController@Eliminar');

Route::post('/intranet/configuracion/mensaje/Listar', 'MensajeController@Listar');
Route::post('/intranet/configuracion/mensaje/Guardar', 'MensajeController@Guardar');
Route::post('/intranet/configuracion/mensaje/Leer', 'MensajeController@Leer');
Route::post('/intranet/configuracion/mensaje/Eliminar', 'MensajeController@Eliminar');

Route::post('/intranet/configuracion/publicacion/Listar', 'PublicacionController@Listar');
Route::post('/intranet/configuracion/publicacion/Guardar', 'PublicacionController@Guardar');
Route::post('/intranet/configuracion/publicacion/Leer', 'PublicacionController@Leer');
Route::post('/intranet/configuracion/publicacion/Eliminar', 'PublicacionController@Eliminar');

Route::post('/intranet/configuracion/publicacionrecurso/Listar', 'PublicacionrecursoController@Listar');
Route::post('/intranet/configuracion/publicacionrecurso/GuardarImagen', 'PublicacionrecursoController@GuardarImagen');
Route::post('/intranet/configuracion/publicacionrecurso/GuardarVideo', 'PublicacionrecursoController@GuardarVideo');
Route::post('/intranet/configuracion/publicacionrecurso/Leer', 'PublicacionrecursoController@Leer');
Route::post('/intranet/configuracion/publicacionrecurso/Eliminar', 'PublicacionrecursoController@Eliminar');