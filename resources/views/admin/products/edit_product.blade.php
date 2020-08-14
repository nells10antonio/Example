@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Productos</a> <a href="#" class="current">Editar Producto</a> </div>
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
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Editar Producto</h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('/admin/edit-product/'.$productDetails->id) }}" name="edit_product" id="edit_product" novalidate="novalidate"> {{ csrf_field() }} 
              <div class="control-group">
                <label class="control-label">Categoría</label>
                <div class="controls">
                  <select name="category_id" id="category_id" style="width: 220px;">
                    <?php echo $categories_dropdown; ?>
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Nombre de Producto</label>
                <div class="controls">
                  <input type="text" name="product_name" id="product_name" value="{{ $productDetails->product_name}}">
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Codigo de Producto</label>
                <div class="controls">
                  <input type="text" name="product_code" id="product_code" value="{{ $productDetails->product_code}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Color de Producto</label>
                <div class="controls">
                  <input type="text" name="product_color" id="product_color" value="{{ $productDetails->product_color}}">
                </div>
              </div>
          <div class="control-group">
                <label class="control-label">Descripción</label>
                <div class="controls">
                  <textarea name="description" id="description">{{ $productDetails->description}}</textarea> 
                </div>
              </div> 

              <div class="control-group">
                <label class="control-label">Material</label>
                <div class="controls">
                  <textarea name="care" id="care">{{ $productDetails->care}}</textarea> 
                </div>
              </div> 

              <div class="control-group">
                <label class="control-label">Precio</label>
                <div class="controls">
                  <input type="text" name="price" id="price" value="{{ $productDetails->price}}">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Imagen</label>
                <div class="controls">
                  <input type="file" name="image" id="image">
                  <input type="hidden" name="current image" value="{{ $productDetails->image }}">
                  @if(!empty($productDetails->image))
                  <img style="width: 50px" src="{{ asset ('/images/backend_images/products/small/'.$productDetails->image)}}" > | <a href="{{ url('/admin/delete-product-image/'.$productDetails->id) }}">Eliminar</a>
                  @endif
                </div>
              </div> 
              <div class="control-group">
                <label class="control-label">Habilitar</label>
                <div class="controls">
                  <input type="checkbox" name="status" id="status" @if($productDetails->status=="1") checked @endif value="1">
                </div>
              </div>             
              <div class="form-actions">
                <input type="submit" value="Editar Producto " class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection