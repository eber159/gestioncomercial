@extends('extranet.plantilla')

@section('title-page')
    Inicio
@stop

@section('content')
    <div class="contact">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="section_title_container text-center">
                        <div class="section_subtitle">the best deals</div>
                        <div class="section_title"><h1>Get in touch</h1></div>
                    </div>
                </div>
            </div>
            <div class="row contact_row">

                <!-- Contact - About -->
                <div class="col-lg-6 contact_col">
                    <div class="logo"><a href="#">my<span>home</span></a></div>
                    <div class="contact_text">
                        <p>Nulla aliquet bibendum sem, non placerat risus venenatis at. Prae sent vulputate bibendum dictum. Cras at vehicula urna. Suspendisse fringilla lobortis justo, ut tempor leo cursus in.</p>
                    </div>
                </div>

                <!-- Contact - Info -->
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

                <!-- Contact - Image -->
                <div class="col-lg-4 contact_col">
                    <div class="contact_image d-flex flex-column align-items-center justify-content-center">
                        <img src="images/contact_image.jpg" alt="">
                    </div>
                </div>

            </div>
            <div class="row contact_form_row">
                <div class="col">
                    <div class="contact_form_container">
                        <form action="#" class="contact_form text-center" id="contact_form">
                            <div class="row">
                                <div class="col-lg-4">
                                    <input type="text" class="contact_input" placeholder="Your name" required="required">
                                </div>
                                <div class="col-lg-4">
                                    <input type="email" class="contact_input" placeholder="Your e-mail" required="required">
                                </div>
                                <div class="col-lg-4">
                                    <input type="text" class="contact_input" placeholder="Subject" required="required">
                                </div>
                            </div>
                            <textarea class="contact_textarea contact_input" placeholder="Message" required="required"></textarea>
                            <button class="contact_button">send message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


@section('content')

@stop