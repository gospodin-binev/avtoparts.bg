@extends('master')

@section('page-title')
	Търсене за {{ $query }}
@endsection

@section('content')
	<div class="container-fluid">
    	<div class="row">
    		<div class="col-md-12">

    			<div class="col-md-6">

    			<form method="get" action="">
    			<strong style="color: lime;">Филтрирай частите за:</strong><br>
    			<input name="search-query" type="hidden" value="{{ $query }}">
				   <label>Марка: <span style="color: red;">*</span></label>
    				<select class="form-control" name="brand_id" id="brand_id">
					  @foreach ($brands as $brand)
					  	<option value="{{ $brand->id }}">{{ $brand->name }}</option>
					  @endforeach
					</select>

					<label>Избери модел: <span style="color: red;">*</span></label>

                    <select class="form-control" name="model" id="model">
                    </select>
                    
				  <button formaction="{{ url('/search') }}" class="btn btn-warning">Филтрирай</button>
				  <a href="{{ url('/') }}" class="btn btn-info">Назад</a>
				</form>

    			</div>

    			<br><br><br><br><br><br><br><br>

    			<h2 class="categories-title">Търсене за "{{ $query }}"</h2>

    			<hr>

    			{!! str_replace('?page', '&page', $products->render()) !!}

				<div class="row">

					<?php foreach($products as $product) { ?>

					<?php $count; ?>

					<div class="col-md-2">
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

		            <?php if ($count % 6 == 0) { ?>
		              <div class="clearfix"></div>
		            <?php } ?>

					<?php } ?>

					<?php if ($count == 0) { ?>
						<div class="alert alert-danger" role="alert">Няма продукти в тази секция.</div>
					<?php } ?>
				</div>

				

    	</div>

    	</div>
    </div>
@endsection