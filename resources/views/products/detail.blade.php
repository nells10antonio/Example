@extends('layouts.frontLayout.front_design')
@section('content')

<section>
		<div class="container">
			<div class="row">
				@if(Session::has('flash_message_error'))
            		<div class="alert alert-error alert-block" style="background-color: #f2dfd0">
                		<button type="button" class="close" data-dismiss="alert">×</button> 
                		<strong>{!! session('flash_message_error') !!}</strong>
            		</div>
        		@endif 
				<div class="col-sm-3">
					@include('layouts.frontLayout.front_sidebar')
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="{{ asset('images/backend_images/products/medium/'.$productDetails->image)}}" alt="" />
								<!--<h3>ZOOM</h3>-->
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
										<div class="item active">
										  <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
										</div>
										<div class="item">
										  <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
										</div>
										<div class="item">
										  <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
										</div>
										
									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>

						</div>
						<div class="col-sm-7">
							<form name="addtocartForm" id="addtocartForm" action="{{ url('add-cart') }}" method="post">{{ csrf_field() }}
								<input type="hidden" name="product_id" value="{{ $productDetails->id }}">
								<input type="hidden" name="product_name" value="{{ $productDetails->product_name }}">
								<input type="hidden" name="product_code" value="{{ $productDetails->product_code }}">
								<input type="hidden" name="product_color" value="{{ $productDetails->product_color }}">
								<input type="hidden" name="price" id="price" value="{{ $productDetails->price }}">
								<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2>{{ $productDetails->product_name }}</h2>
								<p>Código: {{ $productDetails->product_code }}</p>
								<p>
									<select id="selSize" name="size" style="width:160px">
										<option value="">Seleccionar tamaño</option>
										@foreach($productDetails->attributes as $sizes)
										<option value="{{ $productDetails->id }}-{{ $sizes->size }}">{{ $sizes->size }}</option>
										@endforeach	
									</select>
								</p>
								<img src="images/product-details/rating.png" alt="" />
								<span>
									<span id="getPrice">Bs {{ $productDetails->price }}</span>
									<label>Cantidad:</label>
									<input type="text" name="quantity" value="1" />
									@if($total_stock>0)
										<button type="submit" class="btn btn-fefault cart" id="cartButton">
											<i class="fa fa-shopping-cart"></i>
											Añadir
										</button>
									@endif
								</span>
								<p><b>Disponiblidad:</b> <span id="Availability">@if($total_stock>0) En Stock @else Sin Stock @endif</p></span>
								<p><b>Condición:</b> New</p>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
								</div><!--/product-information-->
							</form>
						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#description" data-toggle="tab">Descripción</a></li>
								<li><a href="#care" data-toggle="tab">Material</a></li>
								<li><a href="#delivery" data-toggle="tab">opciones de entrega</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane active in" id="description" >
								<div class="col-sm-12">
								<p>{{ $productDetails->description }}</p>
								</div>	
							</div>
							
							<div class="tab-pane fade" id="care" >
								<div class="col-sm-12">
								<p>{{ $productDetails->care }}</p>
								</div>
							</div>
							
							<div class="tab-pane fade" id="delivery" >
								<div class="col-sm-12">
								<p>Productos 100% Originales <br>
									Contra Reembolso
								</p>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
					
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Productos Relacionados</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<?php $count=1; ?>
								@foreach($relatedProducts->chunk(3) as $chunk)
									<div <?php if($count==1) { ?> class="item active" <?php } else{ ?> class="item" <?php } ?>>
										@foreach($chunk as $item)	
										<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img style="width:230px" src="{{ asset('images/backend_images/products/small/'.$item->image) }}" alt="" />
													<h2>Bs {{ $item->price }}</h2>
													<p>{{ $item->product_name }}</p>
													<a href="{{ url('product/'.$item->id) }}">
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Añadir al carrito</button></a>
												</div>
											</div>
										</div>
										</div>
										@endforeach
									</div>
									<?php $count++; ?>
								@endforeach
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
					
				</div>
			</div>
		</div>
	</section>

@endsection