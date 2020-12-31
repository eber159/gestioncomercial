@extends('extranet.plantillabusqueda')

@section('title-page')
    Inicio
@stop

@section('slider')

@stop



@section('content')
    

    
<style type="text/css">
    .contact_row {
        margin-top: 5px;
    }

    .label-busq {
        width: 150px;
    }


    .select {
        background-color: #283895;
        color: #fff!important;
    }

    .btn {
        display: inline-block;
        font-weight: 600;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border: 1px solid transparent;
        padding: .375rem .75rem;
        font-size: 24px;
        line-height: 1.5;
        border-radius: .25rem;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }

</style>

    <div class="contact">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section_title_container text-center">
                        <div class="section_subtitle"></div>
                    </div>
                </div>
            </div>
            <div class="row contact_row" style="text-align: center">
                <div style="text-align: center;">
                    <a href="{{ URL::to('busquedajoyas') }}" class="btn btn-xs btn-primary" style="background-color: #040c50"><i class="fa fa-map-marker"></i> STOCK LOCAL </a>
                </div> &nbsp;
                <div style="text-align: center;">
                    <a href="#" class="btn btn-xs btn-primary" style="background-color: #040c50"><i class="fa fa-globe"></i> STOCK PARA PEDIDO </a>
                </div>
                <!--
                <div class="col-lg-4 contact_col">
                    <div class="contact_info">
                        <ul>
                            <li class="d-flex flex-row align-items-center justify-content-start">
                                <div class="d-flex flex-column align-items-center justify-content-center">
                                    <div><img src="images/placeholder_2.svg" alt=""></div>
                                </div>
                                <span>Main Str, no 23, New York</span>
                            </li>
                            <li class="d-flex flex-row align-items-center justify-content-start">
                                <div class="d-flex flex-column align-items-center justify-content-center">
                                    <div><img src="images/phone-call-2.svg" alt=""></div>
                                </div>
                                <span>+546 990221 123</span>
                            </li>
                            <li class="d-flex flex-row align-items-center justify-content-start">
                                <div class="d-flex flex-column align-items-center justify-content-center">
                                    <div><img src="images/envelope-2.svg" alt=""></div>
                                </div>
                                <span>hosting@contact.com</span>
                            </li>
                        </ul>
                    </div>
                </div>
                -->

                <!-- Contact - Image -->
                <div class="col-lg-4 contact_col">
                    <div class="contact_image d-flex flex-column align-items-center justify-content-center">
                        <img src="images/contact_image.jpg" alt="">
                    </div>
                </div>

            </div>

        </div>

    </div>
@stop

@section('stripts_especific')

<script>

    var datajson = [];
    var seleccionados = [];

    $(function () {

        var data2 = {
            "page": "1",
            "records": "3",
            "rows": datajson
        }

    });

    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;

        return [year, month, day].join('-');
    }

    function enviarPedido(){
        bootbox.confirm("¿Seguro que deseas Enviar los Items Seleccionados?", function (result) {
            var rowKey = jQuery("#jqGrid").jqGrid('getGridParam','selarrrow');
            var seleccionados = [];
            var c=0;
            $.each(rowKey, function (key, val) {
                var rowData = $("#jqGrid").jqGrid("getRowData", val);
                seleccionados.push(rowData);
                c++;
            });


            var detalles = [];
            var c = 0;
            var total = 0;
            $.each(rowKey, function (key, val) {
                var rowData = $("#jqGrid").jqGrid("getRowData", val);
                var obj = {
                    "id": ""
                    ,"idproducto": rowData.Certificado
                    ,"nombreproducto": rowData.Certificado
                    ,"cantidad": 1
                    ,"idunidadmedida": 1
                    ,"unidadmedida": "UNIDAD"
                    ,"precio": (rowData.Precio*rowData.Carats)
                    ,"valor_vta": (rowData.Precio*rowData.Carats)
                    ,"activo": 1
                }
                total = total + (rowData.Precio*rowData.Carats);
                detalles[c] = obj;
                c++;
                console.log(rowData);
            });

            //Cabecera
            var fecha = new Date();
            var obj = {
                "id": ""
                ,"codigo": ""
                ,"idcliente": "{{ Session::get('idtrabajador') }}"
                ,"fecha": formatDate(fecha)
                ,"idestado": "{{config('constants.estadopedido.aprobado')}}"
                ,"total": total
                ,"idvendedor": ''
                ,"glosa": "PEDIDO REALIZADO DESDE LA WEB"
                ,"idtipopago": "{{config('constants.tipopago.contado')}}"
                ,"detalles": detalles
            };


            if(c>0){
                var resp = "";
                $.ajax({
                    type: "POST",
                    async: false,
                    data: obj,
                    url: "intranet/comercial/ordenpedido/Guardar",
                    dataType: "json",
                    beforeSend: function (data) {
                        
                    },
                    success: function (data) {
                        if(data.success == true){
                            //$('#frmRegistro')[0].reset();
                            //$("#idcliente").val('').trigger("change");
                            //var oTableDetalles = $("#tblDetalles").dataTable();
                            //oTableDetalles.fnClearTable();
                            bootbox.alert("Pedido enviado satisfactoriamente");
                            resp = "ok";
                        }else{
                            bootbox.alert(data.message);
                            console.log(data.message);
                        }
                        if(data.success == "session"){
                            bootbox.alert(data.message);
                        }

                        $("#divCargaRegistro").hide();
                    },
                    error: function (data) {
                        bootbox.alert(data.message);
                        onsole.log(data.message);
                    }
                });
                return resp;
            }else{
                bootbox.alert("Seleccione al menos un Item");
            }
        });
    }

    function Listar() {
        var url = "intranet/configuracion/item/Listar";
        var info = "";
        $.ajax({
            type: "POST",
            async: false,
            data: {},
            url: url,
            dataType: "json",
            beforeSend: function (data) {
                $("#divCargando").show();
            },
            success: function (data) {
                //var oTable = $("#tblDatos").dataTable();
                //oTable.fnClearTable();
                datajson = [];
                if (data !== null && typeof data === 'object') {

                    $.each(data.lista, function (key, val) {
                        var obj = {"Certificado": val["certificado"]
                                ,"Precio": val["precio"]
                                ,"Forma": val["forma"]
                                ,"Carats": val["carats"]
                                ,"Claridad": val["claridad"]
                                ,"Color": val["color"]
                                ,"Corte": val["corte"]
                                ,"Pulido": val["pulido"]
                                ,"Simetria": val["simetria"]
                                ,"Fluorescent": val["fluorescent"]
                                ,"Lab": val["lab"]
                            };
                        //oTable.fnAddData(obj);
                        datajson.push(obj);

                    });

                    jQuery("#jqGrid").jqGrid('setGridParam',
                        { 
                            datatype: 'local',
                            data:datajson
                        })
                    .trigger("reloadGrid");
                }
                $("#divCargando").hide();
            },
            finally: function (){
                $("#divCargando").hide();
            }
        });
        //=================== ********* ===================
        
        $("#export").on("click", function(){
            $("#jqGrid").jqGrid("exportToExcel",{
                includeLabels : true,
                includeGroupHeader : true,
                includeFooter: true,
                fileName : "jqGridExport.xlsx",
                maxlength : 40 // maxlength for visible string data 
            })
        })


    }



</script>

@stop
