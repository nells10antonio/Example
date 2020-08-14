@extends('layouts.frontLayout.front_design')
@section('content')

<section id="form" style="margin-top: 20px"><!--form-->
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
					<li><a href="#">Home</a></li>
					<li class="active">Verificar</li>
				</ol>
			</div>
				@if(Session::has('flash_message_error'))
            		<div class="alert alert-danger alert-block">
                		<button type="button" class="close" data-dismiss="alert">×</button> 
                		<strong>{!! session('flash_message_error') !!}</strong>
            		</div>
        		@endif 
        		<form action="{{ url('/checkout') }}" method="post">{{ csrf_field() }}
        			<div class="row">
        				<div class="col-sm-4 col-sm-offset-1">
        					<div class="login-form"><!--login form-->
        						<h2>Cobrar A: (Datos de Factura)</h2>
        						<div class="form-group">
        							<input name="billing_name" id="billing_name" @if(!empty($userDetails->name)) value="{{ $userDetails->name }}" @endif type="text" placeholder="Nombre" class="form-control" />
        						</div>
        						<div class="form-group">
        							<input name="billing_address" id="billing_address" @if(!empty($userDetails->address)) value="{{ $userDetails->address }}" @endif type="text" placeholder="Dirección" class="form-control" />
        						</div>
        						<div class="form-group"> 
        							<input name="billing_city" id="billing_city" @if(!empty($userDetails->city)) value="{{ $userDetails->city }}" @endif type="text" placeholder="Ciudad" class="form-control" />
        						</div>
        						<div class="form-group">
        							<input name="billing_state" id="billing_state" @if(!empty($userDetails->state)) value="{{ $userDetails->state }}" @endif type="text" placeholder="Departamento/state" class="form-control" />
        						</div>
        						<div class="form-group">
        							<select id="billing_country" name="billing_country" class="form-control">
        								<option value="">Seleccionar País</option>
        								@foreach($countries as $country)
        								<option value="{{ $country->country_name }}" @if(!empty($userDetails->country) && $country->country_name == $userDetails->country) selected @endif>{{ $country->country_name }}</option>
        								@endforeach
        							</select>
        						</div>
        						<div class="form-group">
        							<input name="billing_pincode" id="billing_pincode" @if(!empty($userDetails->pincode)) value="{{ $userDetails->pincode }}" @endif type="text" placeholder="Codigo Pin" class="form-control" />
        						</div>
        						<div class="form-group">
        							<input name="billing_mobile" id="billing_mobile" @if(!empty($userDetails->mobile)) value="{{ $userDetails->mobile }}" @endif type="text" placeholder="Celular" class="form-control" />
        						</div>
        						<div class="form-check">
        							<input type="checkbox" class="form-check-input" id="copyAddress">
        							<label class="form-check-label" for="copyAddress">Igualar datos de Factura con Datos de Envio</label>
        						</div>
        					</div>
        				</div>
        				<div class="col-sm-1">
        					<h2></h2>
        				</div>
        				<div class="col-sm-4">
        					<div class="signup-form">
        						<h2>Enviar A: (Datos de Envio)</h2>
        						<div class="form-group">
        							<input name="shipping_name" id="shipping_name" @if(!empty($shippingDetails->name)) value="{{ $shippingDetails->name }}" @endif type="text" placeholder="Nombre" class="form-control" />
        						</div>
        						<div class="form-group">
        							<input name="shipping_address" id="shipping_address" @if(!empty($shippingDetails->address)) value="{{ $shippingDetails->address }}" @endif type="text" placeholder="Dirección" class="form-control" />
        						</div>
        						<div class="form-group"> 
        							<input name="shipping_city" id="shipping_city" @if(!empty($shippingDetails->city)) value="{{ $shippingDetails->city }}" @endif type="text" placeholder="Ciudad" class="form-control" />
        						</div>
        						<div class="form-group">
        							<input name="shipping_state" id="shipping_state" @if(!empty($shippingDetails->state)) value="{{ $shippingDetails->state }}" @endif type="text" placeholder="Departamento/state" class="form-control" />
        						</div>
        						<div class="form-group">
        							<select id="shipping_country" name="shipping_country" class="form-control">
        								<option value="">Seleccionar País</option>
        								@foreach($countries as $country)
        								<option value="{{ $country->country_name }}" @if(!empty($shippingDetails->country) && $country->country_name == $shippingDetails->country) selected @endif>{{ $country->country_name }}</option>
        								@endforeach
        							</select>
        						</div>
        						<div class="form-group">
        							<input name="shipping_pincode" id="shipping_pincode" @if(!empty($shippingDetails->pincode)) value="{{ $shippingDetails->pincode }}" @endif type="text" placeholder="Codigo Pin" class="form-control" />
        						</div>
        						<div class="form-group">
        							<input name="shipping_mobile" id="shipping_mobile" @if(!empty($shippingDetails->mobile)) value="{{ $shippingDetails->mobile }}" @endif type="text" placeholder="Celular" class="form-control" />
        						</div>
        						<button type="submit" class="btn btn-success">Revisar Pedido</button>
        					</div><!--/sign up form-->
        				</div>
        			</div>
        		</form>
		</div>
</section><!--/form-->

@endsection