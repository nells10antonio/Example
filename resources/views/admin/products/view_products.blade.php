@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Productos</a> <a href="#" class="current">Mostrar Productos</a> </div>
    <h1>Productos</h1>
    @if(Session::has('flash_message_error'))
            <div class="alert alert-error alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{!! session('flash_message_error') !!}</strong>
            </div>
        @endif 

        @if(Session::has('flash_message_success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{!! session('flash_message_success') !!}</strong>
            </div>
        @endif 
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Mostrar Productos</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>id Producto</th>
                  <th>id Categoría</th>
                  <th>Nombre de Categoría</th>
                  <th>Nombre de Producto</th>
                  <th>Codigo Producto</th>
                  <th>Color Producto</th>
                  <th>Precio</th>
                  <th>Imagen</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($products as $product)
                <tr class="gradeX">
                  <td>{{ $product->id }}</td>
                  <td>{{ $product->category_id }}</td>
                  <td>{{ $product->category_name }}</td>
                  <td>{{ $product->product_name }}</td>
                  <td>{{ $product->product_code }}</td>
                  <td>{{ $product->product_color }}</td>
                  <td>{{ $product->price }}</td>
                  <td>
                    @if(!empty($product->image))
                      <img src="{{ asset('/images/backend_images/products/small/'.$product->image) }}" style="width: 60px;">
                    @endif
                  </td>
                  <td class="center">
                    <a href="#myModal{{ $product->id }}" data-toggle="modal" class="btn btn-success btn-mini">Ver</a>
                    <a href="{{ url('/admin/edit-product/'.$product->id) }}" class="btn btn-primary btn-mini">Editar</a> <a href="{{ url('/admin/add-attributes/'.$product->id) }}" class="btn btn-primary btn-mini">Agregar</a> 
                    <a rel="{{ $product->id }}" rel1="delete-product" <?php /* href="{{ url('/admin/delete-product/'.$product->id) }}"  */?> href="javascript:" class="btn btn-danger btn-mini deleteRecord">Eliminar</a></td>
                </tr>
     
            <div id="myModal{{ $product->id }}" class="modal hide">
              <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">×</button>
                <h3>{{ $product->product_name }} Detalle Completo</h3>
              </div>
              <div class="modal-body">
                <p>id Producto: {{ $product->id }}</p>
                <p>id Categoría: {{ $product->category_id }}</p>
                <p>Codigo Producto: {{ $product->product_code }}</p>
                <p>Color Producto: {{ $product->product_color }}</p>
                <p>Precio: {{ $product->price }}</p>
                <p>Descripción: {{ $product->description }}</p>
              </div>
            </div>

                @endforeach

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection