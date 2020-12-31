@extends('extranet.plantilla')

@section('title-page')
    {{ $info->empresa }} | Carrito de Compras
@stop


@section('carrito')
  
  <style type="text/css">



.subs_btn {
    background: #333333;
    text-transform: uppercase;
    color: #fff;
    font-family: "Poppins", sans-serif;
    font-weight: 600;
    font-size: 14px;
    letter-spacing: .70px;
    border-radius: 0px;
    border: 1px solid #333333;
    padding: 0px 35px;
    line-height: 48px;
    -webkit-transition: all 400ms linear 0s;
    -o-transition: all 400ms linear 0s;
    transition: all 400ms linear 0s;
    outline: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    cursor: pointer;
}

  .cart_product_list {
  padding-right: 30px;
}

.cart_product_list .table {
  margin-bottom: 0px;
}

.cart_product_list .table thead tr th {
  border-top: 0px;
  text-transform: uppercase;
  font-size: 14px;
  color: #000;
  font-family: "Poppins", sans-serif;
  font-weight: 600;
  border-bottom: 1px solid #e9ecf2;
  text-align: center;
}

.cart_product_list .table thead tr th:nth-child(2) {
  text-align: left;
}

.cart_product_list .table tbody {
  border-bottom: 1px solid #e9ecf2;
}

.cart_product_list .table tbody tr {
  vertical-align: middle;
  -ms-flex-item-align: center;
  align-self: center;
  text-align: center;
}

.cart_product_list .table tbody tr th {
  vertical-align: middle;
  -ms-flex-item-align: center;
  align-self: center;
}

.cart_product_list .table tbody tr td {
  vertical-align: middle;
  -ms-flex-item-align: center;
  align-self: center;
  padding: 28px 10px;
}

.cart_product_list .table tbody tr td .media .d-flex {
  padding-right: 30px;
}

.cart_product_list .table tbody tr td .media .media-body {
  vertical-align: middle;
  -ms-flex-item-align: center;
  align-self: center;
  text-align: left;
}

.cart_product_list .table tbody tr td .media .media-body h4 {
  font-size: 14px;
  color: #000;
  font-family: "Poppins", sans-serif;
}

.cart_product_list .table tbody tr td p {
  font-size: 16px;
  color: #000;
  font-family: "Poppins", sans-serif;
  font-weight: normal;
}

.cart_product_list .table tbody tr td input {
  border: 1px solid #e9ecf2;
  width: 70px;
  text-align: center;
  height: 47px;
  outline: none;
  -webkit-box-shadow: none;
  box-shadow: none;
  font-size: 16px;
  color: #000;
  font-family: "Poppins", sans-serif;
}

.cart_product_list .table tbody tr td input.placeholder {
  font-size: 16px;
  color: #000;
  font-family: "Poppins", sans-serif;
}

.cart_product_list .table tbody tr td input:-moz-placeholder {
  font-size: 16px;
  color: #000;
  font-family: "Poppins", sans-serif;
}

.cart_product_list .table tbody tr td input::-moz-placeholder {
  font-size: 16px;
  color: #000;
  font-family: "Poppins", sans-serif;
}

.cart_product_list .table tbody tr td input::-webkit-input-placeholder {
  font-size: 16px;
  color: #000;
  font-family: "Poppins", sans-serif;
}

.calculate_shoping_area {
  margin-top: 50px;
  padding-right: 30px;
}

.calculate_shoping_area .cart_single_title {
  display: block;
}

.calculate_shoping_area .cart_single_title span {
  float: right;
}

.calculate_shoping_area .cart_single_title span i {
  font-size: 30px;
  color: #000;
}

.calculate_shoping_area .calculate_shop_inner {
  border: 1px solid #e9ecf2;
  padding: 60px;
}

.calculate_shoping_area .calculate_shop_inner .calculate_shoping_form .form-group {
  margin-bottom: 20px;
}

.calculate_shoping_area .calculate_shop_inner .calculate_shoping_form .form-group .bootstrap-select {
  width: 100% !important;
  border: 1px solid #cccccc;
  height: 56px;
}

.calculate_shoping_area .calculate_shop_inner .calculate_shoping_form .form-group .bootstrap-select .dropdown-toggle {
  padding: 0px 22px;
  line-height: 56px;
  background: transparent;
  outline: none !important;
  -webkit-box-shadow: none !important;
  box-shadow: none !important;
}

.calculate_shoping_area .calculate_shop_inner .calculate_shoping_form .form-group .bootstrap-select .dropdown-toggle span {
  font-size: 14px;
  font-family: "Poppins", sans-serif;
  color: #666666;
}

.calculate_shoping_area .calculate_shop_inner .calculate_shoping_form .form-group .bootstrap-select .dropdown-toggle:after {
  border-top-color: #666666;
  margin: 0px;
  position: relative;
  right: 6px;
}

.calculate_shoping_area .calculate_shop_inner .calculate_shoping_form .form-group .bootstrap-select .dropdown-menu {
  margin: 0px;
  border-radius: 0px;
}

.calculate_shoping_area .calculate_shop_inner .calculate_shoping_form .form-group .bootstrap-select .dropdown-menu .dropdown-menu.inner {
  display: block;
}

.calculate_shoping_area .calculate_shop_inner .calculate_shoping_form .form-group .bootstrap-select .dropdown-menu .dropdown-menu.inner li a {
  padding: 0px 22px;
  display: block;
  line-height: 35px;
  font-size: 14px;
  font-family: "Poppins", sans-serif;
  color: #666666;
  -webkit-transition: all 400ms linear 0s;
  -o-transition: all 400ms linear 0s;
  transition: all 400ms linear 0s;
}

.calculate_shoping_area .calculate_shop_inner .calculate_shoping_form .form-group .bootstrap-select .dropdown-menu .dropdown-menu.inner li:hover a {
  color: #000;
}

.calculate_shoping_area .calculate_shop_inner .calculate_shoping_form .form-group input {
  height: 56px;
  border: 1px solid #cccccc;
  border-radius: 0px;
  -webkit-box-shadow: none;
  box-shadow: none;
  outline: none;
  padding: 0px 22px;
}

.calculate_shoping_area .calculate_shop_inner .calculate_shoping_form .form-group input.placeholder {
  font-size: 14px;
  font-family: "Poppins", sans-serif;
  color: #666666;
}

.calculate_shoping_area .calculate_shop_inner .calculate_shoping_form .form-group input:-moz-placeholder {
  font-size: 14px;
  font-family: "Poppins", sans-serif;
  color: #666666;
}

.calculate_shoping_area .calculate_shop_inner .calculate_shoping_form .form-group input::-moz-placeholder {
  font-size: 14px;
  font-family: "Poppins", sans-serif;
  color: #666666;
}

.calculate_shoping_area .calculate_shop_inner .calculate_shoping_form .form-group input::-webkit-input-placeholder {
  font-size: 14px;
  font-family: "Poppins", sans-serif;
  color: #666666;
}

.calculate_shoping_area .calculate_shop_inner .calculate_shoping_form .form-group .submit_btn {
  border: 1px solid #cccccc;
  display: block;
  width: 100%;
  border-radius: 0px;
  height: 54px;
  outline: none !important;
  -webkit-box-shadow: none !important;
  box-shadow: none !important;
  text-transform: uppercase;
  font-size: 14px;
  font-family: "Poppins", sans-serif;
  color: #000;
  -webkit-transition: all 400ms linear 0s;
  -o-transition: all 400ms linear 0s;
  transition: all 400ms linear 0s;
  cursor: pointer;
}

.calculate_shoping_area .calculate_shop_inner .calculate_shoping_form .form-group .submit_btn:hover {
  background: #000;
  border-color: #000;
  color: #fff;
}

.cupon_box {
  margin-bottom: 55px;
}

.cupon_box .cupon_box_inner {
  background: #eeeeee;
  padding: 60px 62px 50px 62px;
}

.cupon_box .cupon_box_inner input {
  width: 100%;
  display: block;
  height: 58px;
  border: 1px solid #babdc2;
  text-align: center;
  font-size: 14px;
  font-family: "Poppins", sans-serif;
  color: #666666;
  outline: none;
  -webkit-box-shadow: none;
  box-shadow: none;
}

.cupon_box .cupon_box_inner input.placeholder {
  font-size: 14px;
  font-family: "Poppins", sans-serif;
  color: #666666;
}

.cupon_box .cupon_box_inner input:-moz-placeholder {
  font-size: 14px;
  font-family: "Poppins", sans-serif;
  color: #666666;
}

.cupon_box .cupon_box_inner input::-moz-placeholder {
  font-size: 14px;
  font-family: "Poppins", sans-serif;
  color: #666666;
}

.cupon_box .cupon_box_inner input::-webkit-input-placeholder {
  font-size: 14px;
  font-family: "Poppins", sans-serif;
  color: #666666;
}

.cupon_box .cupon_box_inner .subs_btn {
  width: 100%;
  display: block;
  line-height: 55px;
  margin-top: 25px;
}

.cart_totals .cart_total_inner {
  background: #333333;
  padding: 56px 60px 65px 60px;
  margin-bottom: 20px;
}

.cart_totals .cart_total_inner ul li a {
  border-bottom: 1px dashed #4c4c4c;
  display: block;
  padding: 6px 5px;
  line-height: 24px;
  font-size: 14px;
  font-family: "Poppins", sans-serif;
  color: #fff;
  font-weight: normal;
}

.cart_totals .cart_total_inner ul li a span {
  max-width: 172px;
  display: inline-block;
  width: 100%;
}

.cart_totals .checkout_btn {
  margin-left: 25px;
}

.cart_totals_area {
  background: #f3f3f3;
  padding: 35px 30px;
}

.cart_totals_area h4 {
  font-size: 24px;
  color: #000;
  font-family: "Poppins", sans-serif;
  font-weight: 600;
  padding-bottom: 30px;
}

.cart_totals_area .cart_t_list .media {
  margin-bottom: 30px;
}

.cart_totals_area .cart_t_list .media .d-flex {
  max-width: 112px;
  width: 100%;
  display: inline-block;
}

.cart_totals_area .cart_t_list .media .d-flex h5 {
  font-size: 16px;
  font-family: "Poppins", sans-serif;
  font-weight: 600;
}

.cart_totals_area .cart_t_list .media .media-body h6 {
  font-size: 16px;
  color: #666666;
  font-family: "Poppins", sans-serif;
  font-weight: normal;
}

.cart_totals_area .cart_t_list .media .media-body p {
  font-size: 13px;
  line-height: 24px;
  font-family: "Poppins", sans-serif;
  font-weight: normal;
  color: #999999;
}

.cart_totals_area .cart_t_list .media .media-body .bootstrap-select {
  width: 100% !important;
}

.cart_totals_area .cart_t_list .media .media-body .bootstrap-select .dropdown-toggle {
  background: transparent;
  padding: 0px;
  outline: none !important;
  -webkit-box-shadow: none !important;
  box-shadow: none !important;
}

.cart_totals_area .cart_t_list .media .media-body .bootstrap-select .dropdown-toggle span {
  font-size: 16px;
  font-family: "Poppins", sans-serif;
  font-weight: 600;
  color: #000;
}

.cart_totals_area .cart_t_list .media .media-body .bootstrap-select .dropdown-toggle:after {
  content: "\f107";
  font: normal normal normal 14px/1 FontAwesome;
  border: none;
  margin: 0px;
  vertical-align: 0;
  position: relative;
  right: 30px;
}

.cart_totals_area .cart_t_list .media .media-body .bootstrap-select .dropdown-menu {
  margin: 0px;
  border-radius: 0px;
}

.cart_totals_area .cart_t_list .media .media-body .bootstrap-select .dropdown-menu .dropdown-menu.inner {
  display: block;
}

.cart_totals_area .cart_t_list .media .media-body .bootstrap-select .dropdown-menu .dropdown-menu.inner li a {
  display: block;
  padding: 0px 15px;
  line-height: 32px;
  color: #666666;
  font-family: "Poppins", sans-serif;
  font-size: 14px;
  -webkit-transition: all 400ms linear 0s;
  -o-transition: all 400ms linear 0s;
  transition: all 400ms linear 0s;
}

.cart_totals_area .cart_t_list .media .media-body .bootstrap-select .dropdown-menu .dropdown-menu.inner li:hover a {
  color: #000;
}

.cart_totals_area .total_amount {
  border-top: 1px solid #cccccc;
  padding-top: 10px;
}

.cart_totals_area .total_amount .float-left {
  font-size: 16px;
  font-family: "Poppins", sans-serif;
  font-weight: 600;
  color: #000;
}

.cart_totals_area .total_amount .float-right {
  font-size: 16px;
  font-family: "Poppins", sans-serif;
  font-weight: 600;
  color: #000;
}

    .cart_items h3 {
  font-size: 24px;
  color: #000;
  font-family: "Poppins", sans-serif;
  font-weight: 600;
  padding-bottom: 47px;
}

.cart_items .table {
  margin-bottom: 0px;
}

.cart_items .table tbody tr th {
  vertical-align: middle;
  -ms-flex-item-align: center;
  align-self: center;
  border: none;
}

.cart_items .table tbody tr td {
  vertical-align: middle;
  -ms-flex-item-align: center;
  align-self: center;
  text-align: center;
  border: none;
}

.cart_items .table tbody tr td .media {
  text-align: left;
}

.cart_items .table tbody tr td .media .d-flex {
  padding-right: 35px;
}

.cart_items .table tbody tr td .media .media-body {
  vertical-align: middle;
  -ms-flex-item-align: center;
  align-self: center;
}

.cart_items .table tbody tr td .media .media-body h4 {
  font-size: 14px;
  font-family: "Poppins", sans-serif;
  color: #666666;
  font-weight: 600;
}

.cart_items .table tbody tr td .red {
  color: #d91522;
  font-weight: 600;
  font-family: "Poppins", sans-serif;
  font-size: 14px;
  text-align: left;
}

.cart_items .table tbody tr td p {
  font-weight: 600;
  font-family: "Poppins", sans-serif;
  font-size: 14px;
  color: #000;
}

.cart_items .table tbody tr td .quantity {
  border: 1px solid #cccccc;
  margin: 0px;
}

.cart_items .table tbody tr td .quantity h6 {
  display: inline-block;
  font-size: 14px;
  font-family: "Poppins", sans-serif;
  font-weight: normal;
  color: #666666;
}

.cart_items .table tbody tr td .quantity button {
  top: 53%;
}

.cart_items .table tbody tr td .quantity input {
  border: none;
  width: 65px;
  font-size: 14px;
  font-family: "Poppins", sans-serif;
  color: #000;
  outline: none;
  -webkit-box-shadow: none;
  box-shadow: none;
}

.cart_items .table tbody tr td .quantity input.placeholder {
  font-size: 14px;
  font-family: "Poppins", sans-serif;
  color: #000;
}

.cart_items .table tbody tr td .quantity input:-moz-placeholder {
  font-size: 14px;
  font-family: "Poppins", sans-serif;
  color: #000;
}

.cart_items .table tbody tr td .quantity input::-moz-placeholder {
  font-size: 14px;
  font-family: "Poppins", sans-serif;
  color: #000;
}

.cart_items .table tbody tr td .quantity input::-webkit-input-placeholder {
  font-size: 14px;
  font-family: "Poppins", sans-serif;
  color: #000;
}

.cart_items .table tbody .last {
  background: #f3f3f3;
  vertical-align: middle;
  -ms-flex-item-align: center;
  align-self: center;
  border-top: 1px solid #cccccc;
  border-bottom: 1px solid #cccccc;
  vertical-align: middle;
  align-self: center;
}

.cart_items .table tbody .last th {
  vertical-align: middle;
  -ms-flex-item-align: center;
  align-self: center;
}

.cart_items .table tbody .last td {
  padding: 0px 10px;
  vertical-align: middle;
  -ms-flex-item-align: center;
  align-self: center;
}

.cart_items .table tbody .last td .media .d-flex {
  vertical-align: middle;
  -ms-flex-item-align: center;
  align-self: center;
}

.cart_items .table tbody .last td .media .d-flex h5 {
  font-size: 14px;
  color: #999999;
  font-family: "Poppins", sans-serif;
  font-weight: normal;
}

.cart_items .table tbody .last td .media .media-body {
  vertical-align: middle;
  -ms-flex-item-align: center;
  align-self: center;
}

.cart_items .table tbody .last td .media .media-body input {
  width: 118px;
  height: 30px;
  padding: 0px 10px;
  border: 1px solid #e5e5e5;
  outline: none;
  -webkit-box-shadow: none;
  box-shadow: none;
  font-size: 12px;
  font-family: "Poppins", sans-serif;
  color: #666666;
}

.cart_items .table tbody .last td .media .media-body input.placeholder {
  font-size: 12px;
  font-family: "Poppins", sans-serif;
  color: #666666;
}

.cart_items .table tbody .last td .media .media-body input:-moz-placeholder {
  font-size: 12px;
  font-family: "Poppins", sans-serif;
  color: #666666;
}

.cart_items .table tbody .last td .media .media-body input::-moz-placeholder {
  font-size: 12px;
  font-family: "Poppins", sans-serif;
  color: #666666;
}

.cart_items .table tbody .last td .media .media-body input::-webkit-input-placeholder {
  font-size: 12px;
  font-family: "Poppins", sans-serif;
  color: #666666;
}

.cart_items .table tbody .last td h3 {
  font-size: 14px;
  font-family: "Poppins", sans-serif;
  font-weight: 600;
  color: #000;
  text-transform: uppercase;
  vertical-align: middle;
  -ms-flex-item-align: center;
  align-self: center;
  padding-bottom: 0px;
  text-align: right;
}


.add_btn {
  font-size: 16px;
  font-family: "Poppins", sans-serif;
  color: #000;
  font-weight: 600;
  vertical-align: middle;
  -webkit-transition: all 400ms linear 0s;
  -o-transition: all 400ms linear 0s;
  transition: all 400ms linear 0s;
}

.add_btn i {
  padding-left: 2px;
  position: relative;
  top: 3px;
  -webkit-transition: all 400ms linear 0s;
  -o-transition: all 400ms linear 0s;
  transition: all 400ms linear 0s;
  left: 0px;
}

.add_btn:hover {
  color: #d91522;
}

.add_btn:hover i {
  left: 5px;
}

.add_cart_btn {
  background: #262121;
  color: #fff;
  line-height: 38px;
  border: 1px solid #262121;
  display: inline-block;
  font-size: 14px;
  text-transform: uppercase;
  font-weight: 600;
  letter-spacing: .70px;
  padding: 0px 15px;
  -webkit-transition: all 400ms linear 0s;
  -o-transition: all 400ms linear 0s;
  transition: all 400ms linear 0s;
  font-family: "Poppins", sans-serif;
}

.add_cart_btn:hover {
  color: #fff;
  background: transparent;
  color: #262121;
}

.discover_btn {
  display: inline-block;
  text-align: center;
  border: 1px solid rgba(255, 255, 255, 0.2);
  padding: 0px 20px;
  text-transform: uppercase;
  color: #fff;
  font-size: 14px;
  line-height: 38px;
  font-family: "Poppins", sans-serif;
  font-weight: normal;
  -webkit-transition: all 400ms linear 0s;
  -o-transition: all 400ms linear 0s;
  transition: all 400ms linear 0s;
}

.discover_btn:hover {
  color: #d91522;
  border-color: #d91522;
}

.shop_now_btn {
  background: #d91522;
  display: inline-block;
  color: #fff;
  padding: 0px 16px;
  font-size: 14px;
  font-family: "Poppins", sans-serif;
  font-weight: 600;
  text-transform: uppercase;
  line-height: 36px;
  border: 1px solid #d91522;
  -webkit-transition: all 400ms linear 0s;
  -o-transition: all 400ms linear 0s;
  transition: all 400ms linear 0s;
}

.shop_now_btn:hover {
  background: transparent;
  color: #d91522;
}

.subs_btn {
  background: #333333;
  text-transform: uppercase;
  color: #fff;
  font-family: "Poppins", sans-serif;
  font-weight: 600;
  font-size: 14px;
  letter-spacing: .70px;
  border-radius: 0px;
  border: 1px solid #333333;
  padding: 0px 35px;
  line-height: 48px;
  -webkit-transition: all 400ms linear 0s;
  -o-transition: all 400ms linear 0s;
  transition: all 400ms linear 0s;
  outline: none !important;
  -webkit-box-shadow: none !important;
  box-shadow: none !important;
  cursor: pointer;
}

.subs_btn:hover {
  background: transparent;
  color: #333333;
}

.update_btn {
  background: transparent;
  border: 1px solid #cccccc;
  border-radius: 0px;
  color: #000;
  font-family: "Poppins", sans-serif;
  font-weight: 600;
  text-transform: uppercase;
  padding: 0px 20px;
  line-height: 54px;
  outline: none !important;
  -webkit-box-shadow: none !important;
  box-shadow: none !important;
  -webkit-transition: all 400ms linear 0s;
  -o-transition: all 400ms linear 0s;
  transition: all 400ms linear 0s;
  cursor: pointer;
  font-size: 14px;
  display: inline-block;
}

.update_btn:hover {
  background: #333333;
  border-color: #333333;
  color: #fff;
}

.checkout_btn {
  background: #d42421;
  border: 1px solid #d42421;
  border-radius: 0px;
  color: #fff;
  font-family: "Poppins", sans-serif;
  font-weight: 600;
  text-transform: uppercase;
  padding: 0px 19px;
  line-height: 54px;
  outline: none !important;
  -webkit-box-shadow: none !important;
  box-shadow: none !important;
  -webkit-transition: all 400ms linear 0s;
  -o-transition: all 400ms linear 0s;
  transition: all 400ms linear 0s;
  font-size: 14px;
  cursor: pointer;
  display: inline-block;
}

.checkout_btn:hover {
  background: #333333;
  border-color: #333333;
  color: #fff;
}
  </style>

  <!--================Shopping Cart Area =================-->
  <section class="shopping_cart_area p_100" style="padding: 9em 0 0.5em">
      <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <div class="cart_items">
                      <h3>Mis Pedidos Generados</h3>
                      <div class="table-responsive-md">
                          <table class="table">
                              <thead>
                                <tr>
                                  <th>Número de Pedido</th>
                                </tr>
                              </thead>
                              <tbody>
                                  @foreach ($pedidos as $p)

                                    <tr>
                                        <th scope="row">
                                            <img src="img/icon/close-icon.png" alt="Eliminar Producto" onclick="QuitarCarro({{ $p->idproducto }})" >
                                        </th>
                                        <td>
                                            <div class="media">
                                                <div class="d-flex">
                                                    <img src="img/product/cart-product/cart-3.jpg" alt="">
                                                </div>
                                                <div class="media-body">
                                                    <h4>{{ $p->nombreproducto }}</h4>
                                                </div>
                                            </div>
                                        </td>
                                        <td><p class="red">{{ number_format($p->precio,2) }}</p></td>
                                        <td>
                                            <div class="quantity">
                                                <h6>Cantidad</h6>
                                                <div class="custom">
                                                    
                                                    <input type="number" style="text-align: center" name="qty" id="sst" maxlength="12" value="{{ $p->cantidad }}" title="Cantidad:" class="input-text qty">
                                                </div>
                                            </div>
                                        </td>
                                        <td><p> {{ number_format($p->valor_vta,2) }} </p></td>
                                    </tr>
                                  @endforeach

                                  
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
@stop


@section('scripts-add')

    <script type="text/javascript">

      $(function () {



        
      });

      function Acceder(idusuario,idperfil,idempresa,idsede,idtrabajador,id) {
          var info = "";
          var url = "";
          url = "accedercliente";
          $.ajax({
            type: "POST",
            async: false,
            data: {"idusuario":idusuario, "idperfil":idperfil, "idempresa":idempresa, "idsede":idsede, "idtrabajador":idtrabajador},
            url: url,
            dataType: "json",
            beforeSend: function (data) {
              
            },
            success: function (data) {
              //var oTableDetalles = $("#tblDetalles").dataTable();
              //oTableDetalles.fnClearTable();
              if (data !== null && typeof data === 'object') {
                if(id==2){
                  window.location = "{{URL::to('/')}}";
                }else{
                  window.location = "{{URL::to('carrito')}}";
                }
              }
            },
            complete: function(){
              
            } 
        });
      }


      function EnviarPedido(){
        if("{{ Session::get('idusuario') }}"==""){
            $("#modal-login").modal("show");
        }else{
          bootbox.confirm("Seguro que desea enviar el Pedido?", function (result) {
              if (result) {
                  var info = "";
                  $.ajax({
                      type: "POST",
                      async: false,
                      data: {"idusuario":"{{ Session::get('idusuario') }}"},
                      url: "{{URL::to('intranet/comercial/ordenpedido/GuardarPedidoWeb')}}",
                      dataType: "json",
                      beforeSend: function (data) {

                      },
                      success: function (data) {
                          //var oTableDetalles = $("#tblDetalles").dataTable();
                          //oTableDetalles.fnClearTable();
                          if (data !== null && typeof data === 'object') {

                              if(data.success == true){
                                bootbox.alert("Pedido Enviado Satistactoriamente, código: "+data.resultadocodigo);
                                window.location = "{{URL::to('carrito')}}";
                              }else{
                                bootbox.alert("Ocurrió un error al enviar el pedido");
                                console.log(data);
                              }

                          }
                      },
                      complete: function () {

                      },
                      error: function() {
                        bootbox.alert("Ocurrió un error al enviar el pedido");
                        console.log(data);
                      }
                  });
              }
          });
        }

      }

      function QuitarCarro(idproducto){

        bootbox.confirm("Seguro que desea quitar el producto del carro de compras?", function (result) {
              if (result) {
                  var info = "";
                  $.ajax({
                      type: "POST",
                      async: false,
                      data: {"idproducto":idproducto},
                      url: "{{URL::to('quitarproductocarro')}}",
                      dataType: "json",
                      beforeSend: function (data) {

                      },
                      success: function (data) {
                          //var oTableDetalles = $("#tblDetalles").dataTable();
                          //oTableDetalles.fnClearTable();
                          if (data !== null && typeof data === 'object') {
                              bootbox.alert("Producto Eliminado");
                              window.location = "{{URL::to('carrito')}}";
                          }
                      },
                      complete: function () {

                      }
                  });
              }
          });
      }

    </script>

@stop