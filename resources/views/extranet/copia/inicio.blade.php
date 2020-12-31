@extends('extranet.plantilla')

@section('title-page')
    Inicio
@stop

@section('slider')
    <div class="home">
        <div class="home_slider_container">
             <div class="owl-carousel owl-theme home_slider">
                <div class="slide">
                    <div class="background_image" style="background-image:url({{ asset('img/slide/slide1.jpg') }})"></div>
                    <div class="home_container">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="home_content">
                                        <div class="home_title"><h1>VRD PER&Uacute;</h1></div>
                                        <span style="color: white">  
                                            Dealer internacional de Diamantes certificados GIA.
                                        </span><br>
                                        <div class="home_price_tag"><a href="registro" style="color: white">Reg&iacute;strate</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--
                <div class="slide">
                    <div class="background_image" style="background-image:url({{ asset('adminstyleextranet/images/index.jpg') }})"></div>
                    <div class="home_container">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="home_content">
                                        <div class="home_title"><h1>1243 Main Avenue Left Town</h1></div>
                                        <div class="home_price_tag">$ 482 900</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slide">
                    <div class="background_image" style="background-image:url({{ asset('adminstyleextranet/images/index.jpg') }})"></div>
                    <div class="home_container">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="home_content">
                                        <div class="home_title"><h1>1243 Main Avenue Left Town</h1></div>
                                        <div class="home_price_tag">$ 482 900</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                -->
             </div>
             <div class="home_slider_nav"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
             
        </div>
    </div>
@stop


@section('content')

@stop