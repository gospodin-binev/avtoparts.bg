@extends('master')

@section('page-title')
	{{ $subcategories->name }}
@endsection

@section('content')
	<div class="container-fluid">
    	<div class="row">
    		<div class="col-md-3">
	    		<div class="panel panel-primary">
	    			<div class="panel-heading">
	    				<h3 class="panel-title">Търси части по марка и модел</h3>
	    			</div>
	    			<div class="panel-body">
	    				
	    				<form method="get" action="">
			    			<input name="search-query" type="hidden" value="">
							   <label>Марка: <span style="color: red;">*</span></label>
			    				<select class="form-control" name="brand_id" id="brand_id">
								  @foreach ($brands as $brand)
								  	<option @if ($selectedBrand == $brand->id) selected @endif value="{{ $brand->id }}">{{ $brand->name }}</option>
								  @endforeach
								</select>

								<label>Избери модел: <span style="color: red;">*</span></label>

			                    <select class="form-control" name="model" id="model">
			                    </select>
			                  <br> 
							  <button formaction="{{ url('/subcategory') }}/{{ $subcategories->id }}" class="btn btn-warning">Търси</button>
						</form>
	    				
	    			</div>
	    		</div>

	    		<div class="panel panel-primary">
	    			<div class="panel-heading">
	    				<h3 class="panel-title">{{ $subcategories->name }}</h3>
	    			</div>
	    			<div class="panel-body">
	    				<div class="list-group">
	    					<a class="btn btn-warning" href="{{ url('/') }}">Назад</a>
	    				</div>
	    			</div>
	    		</div>
    		</div>
    		<div class="col-md-9">
    			<h2 class="categories-title">{{ $subcategories->name }}</h2>

    			<hr>

    			@if ($subPaginate == 'on')
    				{!! str_replace('?page', '&page', $products->render()) !!}
    			@else
    				{!! $products->render() !!}
    			@endif

				<div class="row">

					<?php foreach($products as $product) { ?>

					<?php $count; ?>

					<div class="col-md-3">
						<div id="latest-products-image" class="thumbnail">
			              <a href="{{ url('/products') }}/{{ $product->id }}"><img src="@foreach ($productImages as $productImage) @if (($productImage->in_product == $product->id) && ($productImage->image_type == 'Заглавна снимка')) {{ $productImage->src }} @endif @endforeach" alt="..."></a>
			              <div class="caption">
			                <h4><a href="{{ url('/products') }}/{{ $product->id }}">{{ $product->name }}</a></h4><h4><strong>{{ $product->price }} лв.</strong></h4><h4>Вт. № {{ $product->vt_number }}</h4>
			                <form method="post" action="{{ url('order/cart/add') }}">
			                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
			                    
			                    <input type="hidden" name="id" value="{{ $product->id }}">
			                    <input type="hidden" name="name" value="{{ $product->name }}">
			                    <input type="hidden" name="price" value="{{ $product->price }}">
			                	<p><button class="btn btn-danger" role="button"><i class="fa fa-shopping-cart fa-lg"></i> В количката</button></p>
			              	</form>
			              </div>
			            </div>
					</div>

					<?php $count += 1 ?>

		            <?php if ($count % 4 == 0) { ?>
		              <div class="clearfix"></div>
		            <?php } ?>

					<?php } ?>

					<?php if ($count == 0) { ?>
						<div class="alert alert-danger" role="alert">Няма продукти в тази секция.</div>
					<?php } ?>
				</div>

				@if ($subPaginate == 'on')
    				{!! str_replace('?page', '&page', $products->render()) !!}
    			@else
    				{!! $products->render() !!}
    			@endif

    	</div>

	</div>
	</div>
@endsection