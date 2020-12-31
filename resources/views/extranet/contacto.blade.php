@extends('extranet.plantilla')

@section('title-page')
    {{ $info->empresa }} | Inicio
@stop


@section('contacto')
	<div class="site-section bg-light" id="contact-section" style="padding-top: 10em;">
      <div class="container">
        <div class="row mb-5">
          <div class="col-12 text-center">
            <h3 class="section-sub-title">Formulario de Contacto</h3>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-7 mb-3">

            

            <form role="form" id="frmRegistro" enctype="multipart/form-data">
              
              <h2 class="h4 text-black mb-5">Ingresa tus datos</h2> 

              <div class="row form-group">
                <input type="hidden" id="id" name="id" class="form-control rounded-0">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label class="text-black" for="fname">Nombres y Apellidos</label>
                  <input type="text" id="nombres" name="nombres" class="form-control rounded-0" required>
                </div>
                <div class="col-md-6">
                  <label class="text-black" for="lname">N&uacute;mero de contacto</label>
                  <input type="text" id="numero" name="numero" class="form-control rounded-0" required>
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="email">Email</label> 
                  <input type="email" id="correo" name="correo" class="form-control rounded-0" required>
                </div>
              </div>

              <div class="row form-group">
                
                <div class="col-md-12">
                  <label class="text-black" for="subject">Asunto</label> 
                  <input type="subject" id="asunto" name="asunto" class="form-control rounded-0" required>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <label class="text-black" for="message">Mensaje</label> 
                  <textarea name="mensaje" id="mensaje" cols="30" rows="7" class="form-control rounded-0" placeholder="Escribe tu mensaje..."></textarea>
                </div>
              </div>

              <div class="row form-group">
                <div class="col-md-12">
                  <input type="submit" value="Enviar Mensaje" class="btn btn-black rounded-0 py-3 px-4">
                </div>
              </div>

  
            </form>
          </div>
        
        </div>
        
      </div>
    </div>
@stop


@section('scripts-add')

    <script type="text/javascript">
      $(document).ready(function () {
          
      });


      $("#frmRegistro").submit(function(e) {
            var url = "{{ URL::to('intranet/configuracion/mensaje/Guardar') }}"; // the script where you handle the form input.  
            var formData = new FormData(this);
            $.ajax({
                    type: "POST",
                    url: url,
                    data: formData, // serializes the form's elements.
                    cache:false,
                  contentType: false,
                  processData: false,
                   success: function(data)
                   {
                        if(data.success==true){
                          bootbox.alert("Mensaje Enviado");   
                            $('#frmRegistro')[0].reset()
                        }
                        else{
                            bootbox.alert(data.message);   
                        }
                   },
                   error: function (e){
                      alert(e);
                   }
                 });

            e.preventDefault(); // avoid to execute the actual submit of the form.
        });

    </script>

@stop