<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Input;
use App\Documento;
use App\Detallecuenta;
use App\Detallecuentapago;
use App\Detalledocumento;
use App\Movimientocaja;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

use \DCarbone\XMLWriterPlus;
use File;
use Config;
use Session;

class DocumentoController extends BaseController 
{

    Public Function Listar()
    {
        $idtipodocumento = Input::get('idtipodocumento');
        $idtipodocumento = " AND tbl.idtipodocumento = ".$idtipodocumento;
        $idtipocompraventa = Input::get('idtipocompraventa');
        $filtro = " AND tbl.activo = 1".$idtipodocumento." AND tbl.idtipocompraventa = ".$idtipocompraventa;
        $resultado = DB::select('call documento_listar(?,?)', array(' tbl.id desc ',$filtro));
        return Response::json(array('lista'=>$resultado));
    }

    Public Function GenerarXML()
    {
        $cadCac = "urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2";
        $cadCbc = "urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2";
        $cadCcts = "urn:un:unece:uncefact:documentation:2";
        $cadDs = "http://www.w3.org/2000/09/xmldsig#";
        $cadExt = "urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2";
        $cadQdt = "urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2";
        $cadUdt = "urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2";
        $cadXsi = "http://www.w3.org/2001/XMLSchema-instance";
        $cadSac = "urn:sunat:names:specification:ubl:peru:schema:xsd:SunatAggregateComponents-1";
        $cadP = "urn:sunat:names:specification:ubl:peru:schema:xsd:SunatAggregateComponents-1";

        $prefixSac = substr($cadSac,0, 3);
        $prefixCac = substr($cadCac,0, 3);
        $prefixExt = substr($cadExt,0, 3);
        $prefixCbc = substr($cadCbc,0, 3);
        $prefixDs = substr($cadDs,0, 3);

        // Initialize writer instance
        $writer = new XMLWriterPlus();

        // Start in-memory xml document
        $writer->openMemory();
        $writer->startDocument("1.0","ISO-8859-1");
        $writer->startElement("Invoice");

        $writer->writeAttribute("xmlns:cac", $cadCac);$writer->setIndent(1);
        $writer->writeAttribute("xmlns:cbc", $cadCbc);$writer->setIndent(1);
        $writer->writeAttribute("xmlns:ccts", $cadCcts);$writer->setIndent(1);
        $writer->writeAttribute("xmlns:ds", $cadDs);$writer->setIndent(1);
        $writer->writeAttribute("xmlns:ext", $cadExt);$writer->setIndent(1);
        $writer->writeAttribute("xmlns:qdt", $cadQdt);$writer->setIndent(1);
        $writer->writeAttribute("xmlns:udt", $cadUdt);$writer->setIndent(1);
        $writer->writeAttribute("xmlns:xsi", $cadXsi);$writer->setIndent(1);
        $writer->writeAttribute("xmlns", "urn:oasis:names:specification:ubl:schema:xsd:Invoice-2");$writer->setIndent(1);


        $writer->startElement($prefixExt.":UBLExtensions");$writer->setIndent(1);
        $writer->startElement($prefixExt.":UBLExtension");$writer->setIndent(1);
        //<ext:ExtensionContent>
        $writer->startElement($prefixExt."ExtensionContent");$writer->setIndent(1);
        $writer->startElement($prefixSac."AdditionalInformation");$writer->setIndent(1);
        $writer->writeAttribute("xmlns", $cadSac);$writer->setIndent(1);

        //operaciones gravadas
        $writer->startElement($prefixSac."AdditionalMonetaryTotal");$writer->setIndent(1);
        $writer->writeElement("ID", $cadCbc, "1001");$writer->setIndent(1);
        $writer->startElement($prefixCbc."PayableAmount");$writer->setIndent(1);
        $writer->writeAttribute("currencyID", "PEN");$writer->setIndent(1);
        //$writer->WriteString(Documento.SubTotal.ToString("F2"))
        //$writer->WriteString("");
        $writer->endElement();$writer->setIndent(1); //PayableAmount
        $writer->endElement();$writer->setIndent(1); //AdditionalMonetaryTotal

        $writer->endElement();$writer->setIndent(1); //ExtensionContent
        $writer->endElement();$writer->setIndent(1); //UBLExtension

        /*
        //operaciones inafectas
        $writer->WriteStartElement(prefixSac, "AdditionalMonetaryTotal", cadSac);
        $writer->WriteElementString("ID", cadCbc, "1002");
        $writer->WriteStartElement(prefixCbc, "PayableAmount", cadCbc);
        $writer->WriteAttributeString("currencyID", Documento.Moneda);
        $writer->WriteString(Documento.TotalInafecto.ToString("F2"));
        $writer->WriteEndElement(); //PayableAmount
        $writer->WriteEndElement(); //AdditionalMonetaryTotal
        //operaciones exoneradas
        $writer->WriteStartElement(prefixSac, "AdditionalMonetaryTotal", cadSac);
        $writer->WriteElementString("ID", cadCbc, "1003");
        $writer->WriteStartElement(prefixCbc, "PayableAmount", cadCbc);
        $writer->WriteAttributeString("currencyID", Documento.Moneda);
        $writer->WriteString(Documento.TotalExo.ToString("F2"));
        $writer->WriteEndElement(); //PayableAmount
        $writer->WriteEndElement(); //AdditionalMonetaryTotal
        //operaciones gratuitas
        $writer->WriteStartElement(prefixSac, "AdditionalMonetaryTotal", cadSac);
        $writer->WriteElementString("ID", cadCbc, "1004");
        $writer->WriteStartElement(prefixCbc, "PayableAmount", cadCbc);
        $writer->WriteAttributeString("currencyID", Documento.Moneda);
        $writer->WriteString(Documento.TotalGratis.ToString("F2"));
        $writer->WriteEndElement(); //PayableAmount
        $writer->WriteEndElement(); //AdditionalMonetaryTotal
        //descuentos
        $writer->WriteStartElement(prefixSac, "AdditionalMonetaryTotal", cadSac);
        $writer->WriteElementString("ID", cadCbc, "2005");
        $writer->WriteStartElement(prefixCbc, "PayableAmount", cadCbc);
        $writer->WriteAttributeString("currencyID", Documento.Moneda);
        $writer->WriteString(Documento.DctoGlobal.ToString("F2"));
        $writer->WriteEndElement(); //PayableAmount
        $writer->WriteEndElement(); //AdditionalMonetaryTotal

        $writer->WriteEndElement(); //AdditionalInformation AdditionalMonetaryTotal

        $writer->WriteEndElement(); //ExtensionContent
        $writer->WriteEndElement(); //UBLExtension


        $writer->WriteStartElement(prefixExt, "UBLExtension", cadExt);
        $writer->WriteStartElement(prefixExt, "ExtensionContent", cadExt);

        $writer->WriteEndElement(); //ExtensionContent
        $writer->WriteEndElement(); //UBLExtension


        $writer->WriteEndElement(); //UBLExtensions
        
        // Write out a comment prior to any elements
        //$writer->writeComment('This is a comment and it contains superfluous information');

        // Write root element (can be called anything you wish)
        //$writer->startElement('Root');

        // Write a node value to the root element
        //$writer->text('Root element node value');

        // Append a child element to the root element with it's own value
        // This method opens, writes value, and closes an element all in one go
        //$writer->writeElement('Child', 'Root element child element');

        // Insert a CDATA element
        //$writer->writeCDataElement('MyCData', '<div>This div won\'t confuse XML Parsers! <br></div>');

        */ 
        // Close root element
        $writer->endElement();$writer->setIndent(1);

        // Make document immutable
        $writer->endDocument();

        // See our XML!
        File::put(storage_path().'/ejemplo.xml', ($writer->outputMemory()));
        echo htmlspecialchars($writer->outputMemory());
    }

    public function Guardar()
    {
        DB::beginTransaction();
        $mensaje='';
        $id = Input::get('id');
        $idempresa = Session::get('idempresa');
        $idsede = Session::get('idsede');
        if($id === '')
        {
            $obj_documento = new Documento;
            $idempresa = $idempresa;
            $idsede = $idsede;
            $idtipodocumento = Input::get('idtipodocumento');
            $idclienteproveedor = Input::get('idclienteproveedor');
            $idperiodo = Input::get('idperiodo');
            $idestado = Input::get('idestado');
            $cuentacontable = Input::get('cuentacontable');
            $idmoneda = Input::get('idmoneda');
            $tipocambio = Input::get('tipocambio');
            $idtipocompraventa = Input::get('idtipocompraventa');
            $idmaterialservicio = Input::get('idmaterialservicio');
            $serie = Input::get('serie');
            $numero = Input::get('numero');
            $fechaemision = Input::get('fechaemision');
            $fechavencimiento = Input::get('fechavencimiento');
            $tasaimpuesto = Input::get('tasaimpuesto');
            $nogravadas = Input::get('nogravadas');
            $subtotal = Input::get('subtotal');
            $impuesto = Input::get('impuesto');
            $total = Input::get('total');
            $saldo = Input::get('saldo');
            $operador = Input::get('operador');
            $indextorno = Input::get('indextorno');
            // $idmotivotraslado = Input::get('idmotivotraslado');
            // $idempresaemisor = Input::get('idempresaemisor');
            // $idempresatransporte = Input::get('idempresatransporte');
            // $idempresachofer = Input::get('idempresachofer');
            // $iddireccionorigen = Input::get('iddireccionorigen');
            // $iddirecciondestino = Input::get('iddirecciondestino');
            // $idvehiculotracto = Input::get('idvehiculotracto');
            // $idvehiculocarreta = Input::get('idvehiculocarreta');
            // $idmotivoemision = Input::get('idmotivoemision');
            $idmotivotraslado = "";
            $idempresaemisor = "";
            $idempresatransporte = "";
            $idempresachofer = "";
            $iddireccionorigen = "";
            $iddirecciondestino = "";
            $idvehiculotracto = "";
            $idvehiculocarreta = "";
            $idmotivoemision = "";
            $glosa = Input::get('glosa');
            $activo = 1;
            $usuario = 'Admin';
            $resultado = DB::select('call documento_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', array($id,$idempresa,$idsede,$idtipodocumento,$idclienteproveedor,$idperiodo,$idestado,$cuentacontable,$idmoneda,$tipocambio,$idtipocompraventa,$idmaterialservicio,$serie,$numero,$fechaemision,$fechavencimiento,$tasaimpuesto,$nogravadas,$subtotal,$impuesto,$total,$saldo,$operador,$indextorno,$idmotivotraslado,$idempresaemisor,$idempresatransporte,$idempresachofer,$iddireccionorigen,$iddirecciondestino,$idvehiculotracto,$idvehiculocarreta,$idmotivoemision,$glosa,$activo,$usuario,'INS'));
            foreach(Input::get('detalles') as $obj=>$val)
            {
                $iddetalle = $val["id"];
                if($iddetalle=="")
                {
                    if($val["activo"]==1)
                    {
                        $idempresa = 1;
                        $idsede = 1;
                        $iddocumento = $resultado[0]->rpta;
                        $idtipomaterialservicio = $val['idtipomaterialservicio'];
                        $idmaterialservicio = $val['idmaterialservicio'];
                        $cantidad = $val['cantidad'];
                        $preciounit = $val['preciounit'];
                        $preciounitigv = $val['preciounitigv'];
                        $indigv = $val['indigv'];
                        $activo = 1;
                        $usuario = 'Admin';
                        $resultado2 = DB::select('call detalledocumento_iud(?,?,?,?,?,?,?,?,?,?,?,?,?)', array($id,$idempresa,$idsede,$iddocumento,$idtipomaterialservicio,$idmaterialservicio,$cantidad,$preciounit,$preciounitigv,$indigv,$activo,$usuario,'INS'));
                    }
                }
                $mensaje = 'Registro exitoso';
            }
            //Si es nota de credito o nota de debito guardar documento asociado
            if($idtipodocumento == config('constants.tipodocumento.notacredito') || $idtipodocumento == config('constants.tipodocumento.notaventa') )
            {
                $iddocumento = Input::get('documentoasoc')['iddocumento'];
                $iddocumentoasoc = $resultado[0]->rpta;
                $resultado3 = DB::select('call documentodocumento_iud(?,?,?,?,?,?)',array($id,$iddocumento,$iddocumentoasoc,$usuario,$activo,'INS'));
            }
        }
        else
        {
            //EDITAR
            $Documento = Documento::find($id);
            $idtipodocumento = Input::get('idtipodocumento');
            $idclienteproveedor = Input::get('idclienteproveedor');
            $idperiodo = Input::get('idperiodo');
            $idestado = Input::get('idestado');
            $cuentacontable = Input::get('cuentacontable');
            $idmoneda = Input::get('idmoneda');
            $tipocambio = Input::get('tipocambio');
            $idtipocompraventa = Input::get('idtipocompraventa');
            $idmaterialservicio = Input::get('idmaterialservicio');
            $serie = Input::get('serie');
            $numero = Input::get('numero');
            $fechaemision = Input::get('fechaemision');
            $fechavencimiento = Input::get('fechavencimiento');
            $tasaimpuesto = Input::get('tasaimpuesto');
            $nogravadas = Input::get('nogravadas');
            $subtotal = Input::get('subtotal');
            $impuesto = Input::get('impuesto');
            $total = Input::get('total');
            $saldo = Input::get('saldo');
            $operador = Input::get('operador');
            $indextorno = Input::get('indextorno');
            // $idmotivotraslado = Input::get('idmotivotraslado');
            // $idempresaemisor = Input::get('idempresaemisor');
            // $idempresatransporte = Input::get('idempresatransporte');
            // $idempresachofer = Input::get('idempresachofer');
            // $iddireccionorigen = Input::get('iddireccionorigen');
            // $iddirecciondestino = Input::get('iddirecciondestino');
            // $idvehiculotracto = Input::get('idvehiculotracto');
            // $idvehiculocarreta = Input::get('idvehiculocarreta');
            // $idmotivoemision = Input::get('idmotivoemision');
            $idmotivotraslado = "";
            $idempresaemisor = "";
            $idempresatransporte = "";
            $idempresachofer = "";
            $iddireccionorigen = "";
            $iddirecciondestino = "";
            $idvehiculotracto = "";
            $idvehiculocarreta = "";
            $idmotivoemision = "";
            $glosa = Input::get('glosa');
            $activo = 1;
            $usuario = 'Admin';
            $resultado = DB::select('call documento_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', array($id,$idempresa,$idsede,$idtipodocumento,$idclienteproveedor,$idperiodo,$idestado,$cuentacontable,$idmoneda,$tipocambio,$idtipocompraventa,$idmaterialservicio,$serie,$numero,$fechaemision,$fechavencimiento,$tasaimpuesto,$nogravadas,$subtotal,$impuesto,$total,$saldo,$operador,$indextorno,$idmotivotraslado,$idempresaemisor,$idempresatransporte,$idempresachofer,$iddireccionorigen,$iddirecciondestino,$idvehiculotracto,$idvehiculocarreta,$idmotivoemision,$glosa,$activo,$usuario,'UPD'));

            foreach(Input::get('detalles') as $obj=>$val)
            {
                $iddetalle = $val["id"];
                $idempresa = "";
                $idsede = "";
                $iddocumento = $resultado[0]->rpta;
                $idtipomaterialservicio = $val['idtipomaterialservicio'];
                $idmaterialservicio = $val['idmaterialservicio'];
                $cantidad = $val['cantidad'];
                $preciounit = $val['preciounit'];
                $preciounitigv = $val['preciounitigv'];
                $indigv = $val['indigv'];
                $activo = $val['activo'];
                $usuario = 'Admin';

                if($iddetalle=="")
                {
                    if($val["activo"]==1)
                    {
                        $activo = 1;
                        $usuario = 'Admin';
                        $resultado2 = DB::select('call detalledocumento_iud(?,?,?,?,?,?,?,?,?,?,?,?,?)', array($iddetalle,$idempresa,$idsede,$iddocumento,$idtipomaterialservicio,$idmaterialservicio,$cantidad,$preciounit,$preciounitigv,$indigv,$activo,$usuario,'INS'));
                    }  
                }
                else
                {
                    if($val["activo"]==1)
                    {
                        $usuario = 'Admin';
                        $resultado2 = DB::select('call detalledocumento_iud(?,?,?,?,?,?,?,?,?,?,?,?,?)', array($iddetalle,$idempresa,$idsede,$iddocumento,$idtipomaterialservicio,$idmaterialservicio,$cantidad,$preciounit,$preciounitigv,$indigv,$activo,$usuario,'UPD'));; 
                     }else
                     {
                        $resultado2 = DB::select('call detalledocumento_iud(?,?,?,?,?,?,?,?,?,?,?,?,?)', array($iddetalle,$idempresa,$idsede,$iddocumento,$idtipomaterialservicio,$idmaterialservicio,$cantidad,$preciounit,$preciounitigv,$indigv,$activo,$usuario,'DEL'));
                     }
                }
            }

            $mensaje = 'Registro Actualizado';
        }

        if($resultado > 0)
        {
            DB::commit();
            return Response::json(array(
                'success' 		=> 	true,
                'message' 		=> 	$mensaje
            ));
        }else
        {
            DB::rollBack();
        }
    }

    Public Function Leer()
    {
        $id = Input::get('id');
        $resultado = DB::select('call documento_listar(?,?)', array('',' AND tbl.activo = 1 AND tbl.id='.$id));
        $filtro = "";
        $filtrotabla = " AND tbl.iddocumento = '".$id."'";
        $filtro .= $filtrotabla." AND tbl.activo = 1 ";
        $detalles = DB::select('call detalledocumento_listar(?,?)', array('tbl.id',$filtro));
        return Response::json(array('obj' =>$resultado,'detalles'=>$detalles));
    }

    public function Eliminar()
    {
        DB::beginTransaction();
        try {
            $id = Input::get('id');
            $usuario = 'Admin';

            //Eliminar Movimiento en la cuenta (si tiene saldo)
            $Detallecuenta = Detallecuenta::where('referencia', '=', $id)->where('activo', '=', 1)->firstOrFail();
            //Eliminar los pagos y las operaciones de caja respectivos
            $pagos = Detallecuentapago::where('iddetallecuenta_asoc',"=", $Detallecuenta->id)->get();
            if(count($pagos)>0){
                foreach ($pagos as $key => $value) {
                    //Eliminar el pago y la oc
                    $Detallecuenta = Detallecuenta::find($value["iddetallecuenta"]);
                    DB::table('detallecuenta')->where('id', '=', $Detallecuenta->referencia)->update(['activo' => 0]);
                    DB::table('movimientocaja')->where('id', '=', $Detallecuenta->referencia)->update(['activo' => 0]);
                }
                DB::table('detallecuentapago')->where('iddetallecuenta', '=', $Detallecuenta->id)->update(['activo' => 0]);
            }
            DB::table('detallecuenta')->where('referencia', '=', $id)->update(['activo' => 0]);
            DB::table('documento')->where([['id','=',$id]])->update(['activo' => 0]);
            DB::table('detalledocumento')->where('iddocumento',"=",$id)->update(['activo' => 0]);
            DB::table('ordenventadocumento')->where('iddocumento',"=",$id)->update(['activo' => 0]);
            /*
            $resultado = DB::select('call documento_iud(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', array($id,'','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',$usuario,'DEL'));
            */
            DB::commit();
            return Response::json(array(
                'success'       =>  true,
                'message'       =>  'Registro Eliminado'
            ));

        } catch (Exception $e) {
            DB::rollback();
            return Response::json(array(
                'success'       =>  false,
                'message'       =>  $e->getMessage(),
            ));
        }
        
    }

}


