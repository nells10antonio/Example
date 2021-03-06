@extends('layouts.frontLayout.front_design')
@section('content')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{ asset('./') }}">Home</a></li>
				  <li class="active">Carrito de Compras</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				@if(Session::has('flash_message_success'))
            		<div class="alert alert-success alert-block">
                		<button type="button" class="close" data-dismiss="alert">×</button> 
                		<strong>{!! session('flash_message_success') !!}</strong>
            		</div>
        		@endif
				@if(Session::has('flash_message_error'))
            		<div class="alert alert-danger alert-block">
                		<button type="button" class="close" data-dismiss="alert">×</button> 
                		<strong>{!! session('flash_message_error') !!}</strong>
            		</div>
        		@endif 
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
								<a href=""><img style="width:150px" src="{{ asset('images/backend_images/products/small/'.$cart->image) }}" alt=""></a>
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
									<a class="cart_quantity_up" href="{{ url('/cart/update-quantity/'.$cart->id.'/1') }}"> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="{{ $cart->quantity }}" autocomplete="off" size="2">
									@if($cart->quantity>1)
									<a class="cart_quantity_down" href="{{ url('/cart/update-quantity/'.$cart->id.'/-1') }}"> - </a>
									@endif
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">Bs {{ $cart->price*$cart->quantity }}</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{ url('/cart/delete-product/'.$cart->id) }}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						<?php $total_amount = $total_amount + ($cart->price*$cart->quantity); ?>
						@endforeach

					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Total <span>Bs <?php echo $total_amount; ?> </span></li>
						</ul>
							<a class="btn btn-default update" href="">Update</a>
							<a class="btn btn-default check_out" href="{{ url('/checkout') }}">Revisar</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

@endsection