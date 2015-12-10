@extends('master')

@section('page-title')
	{{ $product->name }}
@endsection

@section('content')
	<div class="container">
	    <div class="row">
	    	<div class="col-md-4">

	    	@foreach ($productImages as $productImage)
	    		<a href="#" class="thumbnail" data-toggle="modal" data-target="#productImage{{$productImage->id}}">
			      <img src="{{$productImage->src}}">
			    </a>

			    <!-- Modal -->
				<div class="modal fade bs-example-modal-lg" id="productImage{{$productImage->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog modal-lg" role="document">
				    <div class="modal-content">
				    <div class="modal-header">
			        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        	</div>
				      <div class="modal-body">
				        <img class="img-responsive" src="{{$productImage->src}}">
				      </div>
				    </div>
				  </div>
				</div>
	    	@endforeach

	    	</div>
	    	<div class="col-md-6">
	    		<h3 class="product-title">{{ $product->name }}</h3>
	    		<p class="product-id">
	    		ID № {{ $product->id }}
	    		<form method="post" action="{{ url('order/cart/add') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <input type="hidden" name="name" value="{{ $product->name }}">
                    <input type="hidden" name="price" value="{{ $product->price }}"> 	 
	    			<button class="btn btn-danger pull-right"><i class="fa fa-shopping-cart fa-lg"></i> В количката</button>
	    		</form>
	    		<strong class="product-price pull-right">{{ $product->price }} лв. {{ $price_text }}</strong>
	    		</p>
	    		
	    		<br>

	    		<table class="table table-bordered table-hover">
	    			<tbody>
	    				<tr>
	    					<td><strong>Марка</strong></td>
	    					<td>@foreach ($brands as $brand) @if ($brand->id == $product->brand) {{ $brand->name }} @endif @endforeach</td>
	    				</tr>
	    				<tr>
	    					<td><strong>Модел</strong></td>
	    					<td>@foreach ($models as $model) @if ($model->id == $product->model) {{ $model->name }} @endif @endforeach</td>
	    				</tr>
	    				<tr>
	    					<td><strong>Тегло</strong></td>
	    					<td>{{ $product->weight }}</td>
	    				</tr>
	    				<tr>
	    					<td><strong>Климатик</strong></td>
	    					<td>{{ $product->klimatik }}</td>
	    				</tr>
	    				<tr>
	    					<td><strong>Брой врати</strong></td>
	    					<td>{{ $product->count_doors }}</td>
	    				</tr>
	    				<tr>
	    					<td><strong>Двигател</strong></td>
	    					<td>{{ $product->engine }}</td>
	    				</tr>
	    				<tr>
	    					<td><strong>Кубатура</strong></td>
	    					<td>{{ $product->kubatura }}</td>
	    				</tr>
	    				<tr>
	    					<td><strong>Скоростна кутия</strong></td>
	    					<td>{{ $product->transmission }}</td>
	    				</tr>
	    				<tr>
	    					<td><strong>Тип автомобил</strong></td>
	    					<td>{{ $product->car_type }}</td>
	    				</tr>
	    				<tr>
	    					<td><strong>Състояние</strong></td>
	    					<td>{{ $product->status }}</td>
	    				</tr>
	    				<tr>
	    					<td><strong>Позиция</strong></td>
	    					<td>{{ $product->position }}</td>
	    				</tr>
	    				<tr>
	    					<td><strong>Вт. №</strong></td>
	    					<td>{{ $product->vt_number }}</td>
	    				</tr>
	    			</tbody>
	    		</table>
	    	</div>
	    	<div class="col-md-2">
	    		<h3 class="text-center similar-products">Подобни: </h3>

	    		@foreach ($randProducts as $randProduct)
	    			<div class="thumbnail">
		              <a href="{{ url('/products') }}/{{ $randProduct->id }}"><img src="@foreach ($randImages as $randImage) @if (($randImage->in_product == $randProduct->id) && ($randImage->image_type == 'Заглавна снимка')) {{ $randImage->src }} @endif @endforeach" alt="..."></a>
		              <div class="caption">
		                <h4><a href="{{ url('/products') }}/{{ $randProduct->id }}">{{ $randProduct->name }}</a></h4><h4><strong>{{ $randProduct->price }} лв.</strong></h4>
		                <form method="post" action="{{ url('order/cart/add') }}">
		                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
		                    
		                    <input type="hidden" name="id" value="{{ $randProduct->id }}">
		                    <input type="hidden" name="name" value="{{ $randProduct->name }}">
		                    <input type="hidden" name="price" value="{{ $randProduct->price }}">
		                	<button class="btn btn-danger" role="button"><i class="fa fa-shopping-cart fa-lg"></i> В количката</button>
		              	</form>
		              </div>
		            </div>
	    		@endforeach

	    	</div>
	    </div>
    </div>
@endsection