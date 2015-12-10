@extends('master')

@section('page-title')
	Начало
@endsection

@section('content')
	<!-- Call to Action Well -->
    <div class="container-fluid">
	    <div class="row">
	        <div class="col-md-12">
		        <div class="well text-right" id="additional-info">
		        	<a class="pull-left additional-info-links" href="#" title="Научи повече!"><i class="fa fa-wrench fa-lg"></i> Работни места</a>
		             Телефон за консултация и поръчка<strong> <i class="fa fa-phone fa-lg"></i> 0887470842</strong>
		            <!-- Tryabva da dobavim istinski nomer tuk -->
		        </div>
	        </div>
	        <!-- /.col-lg-12 -->
	    </div>
      @if(Session::has('acc-info'))
        <div class="alert alert-success">{{ Session::get('acc-info') }}</div>
      @endif
      @if(Session::has('acc-error'))
          <div class="alert alert-danger">{{ Session::get('acc-error') }}</div>
      @endif
	</div>
    <!-- /.row -->

    <div class="container-fluid">
    	<div class="row">
    		<div class="col-md-3">
    			<div class="panel panel-primary">
    				<div class="panel-heading">
    					<h3 class="panel-title">Авточасти</h3>
    				</div>
    				<div class="panel-body">
    					<div class="list-group" id="general-categories">
                @foreach ($productCategories as $productCategory)
    						  <a href="{{ url('/category') }}/{{ $productCategory->id }}" class="list-group-item list-group-item-info general-categories" data-toggle="tooltip" data-placement="bottom" title="@foreach ($productSubCategories as $productSubCategory) @if ($productCategory->id == $productSubCategory->in_category) {{ $productSubCategory->name }}, @endif @endforeach">{{ $productCategory->name }}</a>
    					  @endforeach
              </div>
    				</div>
    			</div>
    		</div>
    		<div class="col-md-9">
	    		<div class="well">
	    			<img class="img-responsive hvr-bounce-in" src="images/search-banner1.jpg" alt="Търси авточасти по марка и модел - AVTOPARTS.BG">

	    			<br>
	    			<br>

		    		<form method="get" action="{{ url('/') }}">
                <label>Марка</label>
                <select name="brand-id" id="brand-id" class="form-control">
                @foreach ($brands as $brand)
                  <option @if ($selectedBrand == $brand->id) selected @endif value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
              </select>
              <br>

              <button class="btn btn-info">1. Покажи модели</button>
            </form>

            <br>

              <?php foreach($models as $model) { ?>
              <a style="margin-top: 2px;" href="{{ url('/avtochasti') }}/{{ $model->id }}" class="btn btn-primary btn-sm">{{ $model->name }}</a>
              <?php } ?>   

				</div>
    		</div>
    		<div class="col-md-9">
    			<div class="well">
    			<a href="#"><img class="img-responsive hvr-bounce-in" src="images/jobs-banner1.jpg" alt="Работни места в AVTOPARTS - AVTOPARTS.BG" title="Научи повече!"></a>
    			</div>
    		</div>
    		<div class="col-md-9">
    			<div class="well">
    				<h3>Новини:</h3>
            @foreach ($blog_posts as $blog_post)
              <a class="news-links" href="{{ url('/blog/view') }}/{{ $blog_post->id }}">{{ $blog_post->post_title }}</a><hr>
            @endforeach
    			</div>
    		</div>
    	</div>
    	<div class="row">
    		<div class="col-md-12">
    			<h3 id="latest-added-products" class="text-center">Последно добавени продукти</h3>
    			<hr>
    		</div>
    	</div>

        <div class="row">
          <?php foreach($products as $product) { ?>

          <?php $count; ?>

            <div class="col-md-3">
              <div id="latest-products-image" class="thumbnail">
                <a href="{{ url('/products') }}/{{ $product->id }}"><img src="@foreach ($productImages as $productImage) @if (($productImage->in_product == $product->id) && ($productImage->image_type == 'Заглавна снимка')) {{ $productImage->src }} @endif @endforeach" alt="..."></a>
                <div class="caption">
                  <h4><a href="{{ url('/products') }}/{{ $product->id }}"><?php echo $product->name; ?></a></h4><h4><strong><?php echo $product->price ?> лв.</strong></h4><h4 class="pull-right">Вт. № {{ $product->vt_number }}</h4>
                  
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
        </div>
        
    	<div class="row">
    		<div class="col-md-12">
    			<div class="well text-center" id="new-parts">
    				Всеки ден се снабдяваме с нови части <i class="fa fa-smile-o fa-lg"></i>
    			</div>
    		</div>
    	</div>
    </div>
@endsection