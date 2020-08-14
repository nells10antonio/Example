@extends('layouts.frontLayout.front_design')
@section('content')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Revisión del Pedido</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="shopper-informations">
				<div class="row">				
				</div>
				<div class="row">
        				<div class="col-sm-4 col-sm-offset-1">
        					<div class="login-form">
        						<h2>Datos de Factura</h2>
        						<div class="form-group">
        							{{ $userDetails->name }}
        						</div>
        						<div class="form-group">
        							{{ $userDetails->address }}
        						</div>
        						<div class="form-group"> 
        							{{ $userDetails->city }}
        						</div>
        						<div class="form-group">
        							{{ $userDetails->state }}
        						</div>
        						<div class="form-group">
        							{{$userDetails->country}}
        							
        						</div>
        						<div class="form-group">
        							{{ $userDetails->pincode }}
        						</div>
        						<div class="form-group">
        							{{ $userDetails->mobile }}
        						</div>
        					</div>
        				</div>
        				<div class="col-sm-1">
        					<h2></h2>
        				</div>
        				<div class="col-sm-4">
        					<div class="signup-form">
        						<h2>Datos de Envio</h2>
        						<div class="form-group">
        							{{ $shippingDetails->name }}
        						</div>
        						<div class="form-group">
        							{{ $shippingDetails->address }}
        						</div>
        						<div class="form-group"> 
        							{{ $shippingDetails->city }}
        						</div>
        						<div class="form-group">
        							{{ $shippingDetails->state }}
        						</div>
        						<div class="form-group">
        							{{ $shippingDetails->country}}</option>
        							</select>
        						</div>
        						<div class="form-group">
        							{{ $shippingDetails->pincode }}
        						</div>
        						<div class="form-group">
        							{{ $shippingDetails->mobile }}
        						</div>
        					</div>
        		</div>
        	</div>

			</div>
			<div class="review-payment">
				<h2>Revisión y pago</h2>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Producto</td>
							<td class="description"></td>
							<td class="price">Precio</td>
							<td class="quantity">Cantidad</td>
							<td class="total">Total</td>
						</tr>
					</thead>
					<tbody>
						<?php $total_amount = 0; ?>
						@foreach($userCart as $cart)
						<tr>
							<td class="cart_product">
								<a href=""><img style="width: 150px" src="{{ asset('images/backend_images/products/small/'.$cart->image) }}" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{ $cart->product_name }}</a></h4>
								<p>{{ $cart->product_code }} | {{ $cart->size }} </p>
							</td>
							<td class="cart_price">
								<p>Bs {{ $cart->price }}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									{{ $cart->quantity }}
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">Bs {{ $cart->price*$cart->quantity }}</p>
							</td>
						</tr>
						@endforeach
						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td>$59</td>
									</tr>
									<tr>
										<td>Exo Tax</td>
										<td>$2</td>
									</tr>
									<tr class="shipping-cost">
										<td>Shipping Cost</td>
										<td>Free</td>										
									</tr>
									<tr>
										<td>Total</td>
										<td><span>$61</span></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="payment-options">
					<span>
						<label><input type="checkbox"> Direct Bank Transfer</label>
					</span>
					<span>
						<label><input type="checkbox"> Check Payment</label>
					</span>
					<span>
						<label><input type="checkbox"> Paypal</label>
					</span>
				</div>
		</div>
</section> <!--/#cart_items-->

@endsection