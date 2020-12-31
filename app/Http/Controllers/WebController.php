<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;

use App\Detallepedido;
use App\Productoweb;
use App\Material;

use View;

use Session;

class WebController extends BaseController {

Public Function irPagina($url,$url2,$url3)
{
    $pagina = "";
    $pagina = $url;
    if($url2!==""){
        $pagina .= ".".$url2; 
    }
    if($url3!==""){
        $pagina .= ".".$url3; 
    }

    //acceso
    $opciones = Session::get("opcionesperfil");
    $info = DB::table('informaciongeneral')->where('id',1)->first();

    if(Session::get("idusuario")!=""){
        if($url3=="ordenventa"){
            $monedas = DB::table('categoria')->where('grupo', 'MONEDA')->where('activo', 1)->get();
            $tipospago = DB::table('categoria')->where('grupo', 'TIPO_PAGO')->where('activo', 1)->get();
            $tipoorden = DB::table('categoria')->where('grupo', 'TIPO_VENTA')->where('activo', 1)->get();
            $estadoorden = DB::table('categoria')->where('grupo', 'ESTADO_VENTA')->where('activo', 1)->get();
            $mediopago = DB::table('categoria')->where('grupo', 'MEDIO_PAGO_CAJA')->where('activo', 1)->get();
            $unidades = DB::table('unidadmedida')->where('activo', 1)->get();
            $productos = DB::table('material')->where('activo', 1)->get();
            $clientes = DB::table('empresa')->where('indcliente',1)->where('activo', 1)->get();
            return View::make($pagina, array('opciones' => $opciones,
                                             'monedas'=>$monedas,
                                             'tipospago'=>$tipospago,
                                             'tipoorden'=>$tipoorden,
                                             'estadoorden'=>$estadoorden,
                                             'mediopago'=>$mediopago,
                                             'productos'=>$productos,
                                             'unidades'=>$unidades,
                                             'clientes'=>$clientes
                                             ));
        }
        else if($url3=="ordenpedidovendedor" || $url3=="ordenpedido" || $url3=="ordenpedidoatender" || $url3=="ordenpedidousuario"){
            $clientes = DB::table('empresa')->where('indcliente',1)->where('activo', 1)->get();
            $tipospago = DB::table('categoria')->where('grupo', 'TIPO_PAGO')->where('activo', 1)->get();
            $productos = DB::table('material')->where('activo', 1)->get();
            return View::make($pagina, array('opciones' => $opciones,
                                             'clientes'=>$clientes,
                                             'tipospago'=>$tipospago,
                                             'productos'=>$productos,
                                             'info'=>$info
                                         ));
        }
        else if($url3=="ordencompra"){
            $monedas = DB::table('categoria')->where('grupo', 'MONEDA')->where('activo', 1)->get();
            $tipospago = DB::table('categoria')->where('grupo', 'TIPO_PAGO')->where('activo', 1)->get();
            $tipoorden = DB::table('categoria')->where('grupo', 'TIPO_COMPRA')->where('activo', 1)->get();
            $estadoorden = DB::table('categoria')->where('grupo', 'ESTADO_COMPRA')->where('activo', 1)->get();
            $unidades = DB::table('unidadmedida')->where('activo', 1)->get();
            //$productos = DB::table('material')->where('activo', 1)->get();
            $proveedores = DB::table('empresa')->where('indproveedor',1)->where('activo', 1)->get();
            return View::make($pagina, array('opciones' => $opciones,
                                             'monedas'=>$monedas,
                                             'tipospago'=>$tipospago,
                                             'tipoorden'=>$tipoorden,
                                             'estadoorden'=>$estadoorden,
                                             //'productos'=>$productos,
                                             'unidades'=>$unidades,
                                             'proveedores'=>$proveedores
                                             ));
        }
        else if($url3=="ordeningreso" || $url3=="ordensalida"){
            $unidades = DB::table('unidadmedida')->where('activo', 1)->get();
            return View::make($pagina, array('opciones' => $opciones,'unidades'=>$unidades));
        }
        else if($url3=="productoweb"){
            $productos = DB::table('material')->where('activo', 1)->get();
            return View::make($pagina, array('opciones' => $opciones
                                             ,'productos'=>$productos
                                             ));
        }
        else if($url3=="material"){
            $productos = DB::table('material')->where('indstock', 0)->orWhere('indstock', null)->where('activo', 1)->get();
            return View::make($pagina, array('opciones' => $opciones
                                             ,'productos'=>$productos
                                             ));
        }
        else{
            return View::make($pagina, array('opciones' => $opciones));
        }
    }else{
        return redirect('/login');
    }

}


Public Function irInicio()
{
    $agent = new Agent();
    $lineas = DB::table('linea')->where('activo', 1)->get();
    $info = DB::table('informaciongeneral')->where('id',1)->first();
    $publicaciones = DB::table('publicacion')->where('activo', 1)->orderBy('orden', 'asc')->get();
    $testimonios = DB::table('testimonio')->where('activo', 1)->get();
    $enlaces = DB::table('enlaces')->where('activo', 1)->where('idtipo', 1)->get();
    $botones = DB::table('enlaces')->where('activo', 1)->where('idtipo', 2)->get();
    $slider = DB::table('slider')->where('activo', 1)->get();
    $cantcarrito = self::CantItemsCarrito();

    return View::make("extranet.inicio", array('agent'=>$agent, 'lineas'=>$lineas,'info'=>$info,'publicaciones'=>$publicaciones, 'enlaces'=>$enlaces, 'botones'=>$botones, 'slider'=>$slider, 'cantcarrito'=>$cantcarrito, 'testimonios'=>$testimonios));
}

Public Function irNosotros()
{
    $agent = new Agent();
    $lineas = DB::table('linea')->where('activo', 1)->get();
    $info = DB::table('informaciongeneral')->where('id',1)->first();
    $nosotros = DB::table('nosotros')->where('activo', 1)->get();
    $cantcarrito = self::CantItemsCarrito();
    $botones = DB::table('enlaces')->where('activo', 1)->where('idtipo', 2)->get();

    return View::make("extranet.nosotros", array('agent'=>$agent, 'lineas'=>$lineas,'info'=>$info,'nosotros'=>$nosotros, 'cantcarrito'=>$cantcarrito, 'botones'=>$botones));
}

Public Function irTerminos()
{
    $agent = new Agent();
    $lineas = DB::table('linea')->where('activo', 1)->orderBy("orden","asc")->get();
    $info = DB::table('informaciongeneral')->where('id',1)->first();
    $cantcarrito = self::CantItemsCarrito();
    $botones = DB::table('enlaces')->where('activo', 1)->where('idtipo', 2)->get();

    return View::make("extranet.terminos", array('agent'=>$agent, 'lineas'=>$lineas,'info'=>$info, 'cantcarrito'=>$cantcarrito,'botones'=>$botones));
}

Public Function irContacto()
{
    $agent = new Agent();
    $lineas = DB::table('linea')->where('activo', 1)->orderBy("orden","asc")->get();
    $info = DB::table('informaciongeneral')->where('id',1)->first();
    $publicaciones = DB::table('publicacion')->where('activo', 1)->get();
    $cantcarrito = self::CantItemsCarrito();
    $botones = DB::table('enlaces')->where('activo', 1)->where('idtipo', 2)->get();

    return View::make("extranet.contacto", array('agent'=>$agent, 'lineas'=>$lineas,'info'=>$info,'publicaciones'=>$publicaciones, 'cantcarrito'=>$cantcarrito, 'botones'=>$botones));
}

Public Function irProductos($idlinea)
{
    $agent = new Agent();
    $lineas = DB::table('linea')->where('activo', 1)->orderBy("orden","asc")->get();
    /*
    if($idlinea!="0"){
        $productos = DB::table('productoweb')->where('activo', 1)->where('idlinea',$idlinea)->orderBy('nombre', 'asc')->get();
    }else{
        $productos = DB::table('productoweb')->where('activo', 1)->orderBy('nombre', 'asc')->get();
    }*/
    $productos = DB::table('productoweb')->where('activo', 1)->orderBy('nombre', 'asc')->get();
    $linea = DB::table('linea')->where("id",$idlinea)->first();
    $info = DB::table('informaciongeneral')->where('id',1)->first();
    $cantcarrito = self::CantItemsCarrito();
    $botones = DB::table('enlaces')->where('activo', 1)->where('idtipo', 2)->get();

    return View::make("extranet.productos", array('agent'=>$agent,'idlinea'=>$idlinea,'productos'=>$productos,'info'=>$info,'linea'=>$linea,'lineas'=>$lineas, 'cantcarrito'=>$cantcarrito, 'botones'=>$botones));
}


Public Function verProducto($idproducto)
{
    $agent = new Agent();
    $lineas = DB::table('linea')->where('activo', 1)->orderBy("orden","asc")->get();
    $producto = DB::table('productoweb')->where('activo', 1)->where('id',$idproducto)->first();
    $imagenes = DB::table('productowebrecurso')->where("activo",1)->where("idproductoweb",$idproducto)->where("tiporecurso",1)->get();
    $videos = DB::table('productowebrecurso')->where("activo",1)->where("idproductoweb",$idproducto)->where("tiporecurso",2)->get();
    $info = DB::table('informaciongeneral')->where('id',1)->first();
    $productoscomunes = DB::table('productoweb')->where('activo', 1)->orderBy('nombre', 'asc')->get();
    $botones = DB::table('enlaces')->where('activo', 1)->where('idtipo', 2)->get();
    $cantcarrito = self::CantItemsCarrito();

    return View::make("extranet.producto", array('agent'=>$agent, 'idlinea'=>$producto->idlinea,'producto'=>$producto,'info'=>$info,'imagenes'=>$imagenes,'videos'=>$videos,'lineas'=>$lineas, 'productoscomunes'=>$productoscomunes, 'cantcarrito'=>$cantcarrito, 'botones'=>$botones));
}

Public Function verPublicacion($idproducto)
{
    $agent = new Agent();
    $lineas = DB::table('linea')->where('activo', 1)->orderBy("orden","asc")->get();
    $publicacion = DB::table('publicacion')->where('activo', 1)->where('id',$idproducto)->first();
    $imagenes = DB::table('publicacionrecurso')->where("activo",1)->where("idpublicacion",$idproducto)->where("tiporecurso",1)->get();
    $videos = DB::table('publicacionrecurso')->where("activo",1)->where("idpublicacion",$idproducto)->where("tiporecurso",2)->get();
    $info = DB::table('informaciongeneral')->where('id',1)->first();
    $botones = DB::table('enlaces')->where('activo', 1)->where('idtipo', 2)->get();
    $publicaciones = DB::table('publicacion')->where('activo', 1)->orderBy('orden', 'asc')->get();
    $cantcarrito = self::CantItemsCarrito();

    return View::make("extranet.publicacion", array('agent'=>$agent, 'publicacion'=>$publicacion,'info'=>$info,'lineas'=>$lineas,'imagenes'=>$imagenes,'videos'=>$videos, 'cantcarrito'=>$cantcarrito, 'botones'=>$botones, 'publicaciones'=>$publicaciones));
}


Public Function irCarrito()
{
    $agent = new Agent();
    $lineas = DB::table('linea')->where('activo', 1)->orderBy("orden","asc")->get();
    $info = DB::table('informaciongeneral')->where('id',1)->first();
    $cantcarrito = self::CantItemsCarrito();
    $productoscarrito = self::ItemsCarrito();
    $botones = DB::table('enlaces')->where('activo', 1)->where('idtipo', 2)->get();
    
    return View::make("extranet.cart", array('agent'=>$agent,'info'=>$info,'lineas'=>$lineas, 'productoscarrito'=>$productoscarrito, 'cantcarrito'=>$cantcarrito, 'botones'=>$botones));
}

Public Function irPedidos()
{
    $agent = new Agent();
    $lineas = DB::table('linea')->where('activo', 1)->orderBy("orden","asc")->get();
    $info = DB::table('informaciongeneral')->where('id',1)->first();

    $filtro = "";
    $idempresa = 1;
    $idsede = 1;
    $filtro .= " AND tbl.activo = 1 AND tbl.idempresa = ".$idempresa." AND tbl.idsede = ".$idsede;
    $idusuario = "";
    $idusuario = Session::get('nombreusuario');
    $filtro .= " AND tbl.created_by = ".$idusuario;

    if(Input::get('fechaini')!=null && Input::get('fechaini')!=""){
        $fechaini = Input::get('fechaini');
        $fechafin = Input::get('fechafin');
        $filtro .= " AND tbl.fecha between '".$fechaini."' and '".$fechafin."' ";
    }
    $resultado = DB::select('call ordenpedido_listar(?,?)', array('tbl.id desc ',$filtro));

    $cantcarrito = self::CantItemsCarrito();
    
    return View::make("extranet.cart", array('agent'=>$agent,'info'=>$info,'lineas'=>$lineas,'cantcarrito'=>$cantcarrito,'pedidos'=>$resultado));
}


Public Function verRuta()
{
    
    $tamaniocadena = strlen(base_path());
    $position = $tamaniocadena - 7;
    $base = substr(base_path(),0,$position);
    echo $base.'<br/>';
    $destinationPath = $base.'/public_html/imagenes/productos/';
    echo $destinationPath;
}


Public Function OrdenPedidoExterno()
{

    //acceso
    //$opciones = Session::get("opcionesperfil");

    //if(Session::get("idusuario")!=""){
        $clientes = DB::table('empresa')->where('indcliente',1)->where('activo', 1)->get();
        $tipospago = DB::table('categoria')->where('grupo', 'TIPO_PAGO')->where('activo', 1)->get();
        $productos = DB::table('material')->where('activo', 1)->get();
        return View::make("intranet.comercial.pedidolibre", array('clientes'=>$clientes,
                                         'tipospago'=>$tipospago,
                                         'productos'=>$productos
                                     ));
    //}else{
    //    return redirect('/login');
    //}

}

    Public Function AgregarProducto()
    {
        
        $detalles = array();
        $idproducto = Input::get("idproducto");
        $cantidad = Input::get("cantidad");
        $talla = Input::get("talla");
        $detallepedido = new Detallepedido();

        //Obtener los datos del producto para agregarlo
        $producto = Productoweb::find($idproducto);

        $material = new Material();

        if($talla=="" || $talla==null){
            //busca el producto asociado para sacar el código y colocarlo en el carrito (así luego ya no buscarlo)
            $productosistema = DB::table('material')->where('activo', 1)->where('id',$producto->idproductoasociado)->first();
            $material = $productosistema;
        }else{
            $productosistema = DB::table('material')->where('activo', 1)->where('id',$producto->idproductoasociado)->first();
            if($productosistema){
                //encontrar el producto adecuado combinado con la talla
                $productosistema2 = DB::table('material')->where('activo', 1)->where('idproductoasociado',$productosistema->id)->where('tamanio',$talla)->first();
                $material = $productosistema2;
            }
        }

        if($producto){
            //Agregar los datos al detalle pedido
            $detallepedido = new detallepedido();
            $detallepedido->idproducto = $material->id;
            $detallepedido->nombreproducto = $material->nombre;
            $detallepedido->cantidad = $cantidad;
            $detallepedido->pendiente = $cantidad;
            $detallepedido->precio = $producto->precio;
            $detallepedido->valor_vta = $producto->precio * $cantidad;
            $detallepedido->idunidadmedida = 1;
            $detallepedido->unidadmedida = "UNIDAD";
        }

        //Si la sesión ya existe
        if(Session::get('carrito')){
            //Buscar si el producto ya está en la lista para agregar la cantidad
            $productoscarrito = Session::get('carrito');

            $existe = false;
            foreach ($productoscarrito as $key => $value) {
                if($existe==false){
                    if($value["idproducto"]==$idproducto){
                        $nuevacantidad = (int) ($value["cantidad"]) + (int) ($cantidad);
                        $value["cantidad"] = $nuevacantidad;
                        $value["prendiente"] = $nuevacantidad;
                        $value["valor_vta"] = $nuevacantidad * $producto->precio;
                        $existe = true;
                    }
                }
            }
            if($existe==false){
                array_push($productoscarrito, $detallepedido);
            }
            Session::put('carrito', $productoscarrito);
        }else{
            array_push($detalles, $detallepedido);
            Session::put('carrito', $detalles);
        }

        $detalles = Session::get('carrito');
        return $detalles;
        

    }


    Public Function QuitarProductoCarro()
    {
        
        $detalles = array();
        $idproducto = Input::get("idproducto");

        //Si la sesión ya existe
        if(Session::get('carrito')){
            //Buscar si el producto ya está en la lista para eliminar
            $productoscarrito = Session::get('carrito');

            $c = 0;
            $indice = 0;
            foreach ($productoscarrito as $key => $value) {
                if($value["idproducto"]==$idproducto){
                    $indice = $c;
                }
                $c++;
            }
            unset($productoscarrito[$indice]);
            Session::put('carrito', $productoscarrito);
        }

        $detalles = Session::get('carrito');
        return $detalles;
        

    }


    Public Function ActualizarProductoCarro()
    {
        
        $detalles = array();
        $idproducto = Input::get("idproducto");
        $cantidad = Input::get("cantidad");
        $precio = Input::get("precio");
        $importe = Input::get("importe");

        $detallepedido = new Detallepedido();

        //Obtener los datos del producto para agregarlo
        $producto = Productoweb::find($idproducto);
        if($producto){
            //Agregar los datos al detalle pedido
            $detallepedido = new detallepedido();
            $detallepedido->idproducto = Input::get("idproducto");
            $detallepedido->nombreproducto = $producto->nombre;
            $detallepedido->cantidad = $cantidad;
            $detallepedido->pendiente = $cantidad;
            $detallepedido->precio = $precio;
            $detallepedido->valor_vta = $importe;
            $detallepedido->idunidadmedida = 1;
            $detallepedido->unidadmedida = "UNIDAD";
        }

        //Si la sesión ya existe
        if(Session::get('carrito')){
            //Buscar si el producto ya está en la lista para agregar la cantidad
            $productoscarrito = Session::get('carrito');

            foreach ($productoscarrito as $key => $value) {
                
                if($value["idproducto"]==$idproducto){
                    $nuevacantidad = $cantidad;
                    $value["cantidad"] = $nuevacantidad;
                    $value["prendiente"] = $nuevacantidad;
                    $value["valor_vta"] = $nuevacantidad * $precio;
                }
                
            }
            Session::put('carrito', $productoscarrito);
        }else{
            array_push($detalles, $detallepedido);
            Session::put('carrito', $detalles);
        }

        $detalles = Session::get('carrito');
        return $detalles;
        

    }


    //Cantidad de objetos en el carrito de compras
    private function CantItemsCarrito(){
        $productoscarrito = array();
        if(Session::get('carrito')){
            $productoscarrito = Session::get('carrito');    
        }else{
            $productoscarrito = array();    
        }
        return count($productoscarrito);
    }

    //Objetos del carrito de compras
    private function ItemsCarrito(){
        $productoscarrito = array();
        if(Session::get('carrito')){
            $productoscarrito = Session::get('carrito');    
        }else{
            $productoscarrito = array();    
        }
        return $productoscarrito;
    }

}