@extends('admin.master')

@section('page-title')
	Редактиране на продукт
@endsection

@section('content')
	<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Редактиране на продукт</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
        	@if(Session::has('admin-success'))
	            <div class="alert alert-success">{{Session::get('admin-success')}}</div>
	        @endif

	        @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        	</div>
        	
        	<div class="row">
        		<div class="col-md-7">
        			<form method="post" action="{{ url('/admin/list-products/update') }}/{{$products->id}}">
        				<input type="hidden" name="_token" value="{{ csrf_token() }}">
        				<input type="hidden" name="product_id" value="{{ $products->id }}">

        				<label>Категория: <span style="color: red;">*</span></label>
        				<select class="form-control" name="category_id" id="category_id">
						  @foreach ($productCategories as $productCategory)
						  	<option @if ($products->category == $productCategory->id) selected @endif value="{{ $productCategory->id }}">{{ $productCategory->name }}</option>
						  @endforeach
						</select>

                        <br>

                        <label>Избери подкатегория: <span style="color: red;">*</span></label>

						<br>
                        
                        <select class="form-control" name="subcategory_id" id="subcategory_id">
                            <option value="{{ $products->sub_category }}">@foreach ($subProductCategories as $subProductCategory) @if($subProductCategory->id == $products->sub_category) {{ $subProductCategory->name }} @endif @endforeach</option>
                        </select>

    					<br>

        				<label>Име: <span style="color: red;">*</span></label>
        				<div class="form-group">
                            <input type="text" name="name" id="name" class="form-control" value="{{ $products->name }}">
                        </div>

						<br>

						<label>Марка: <span style="color: red;">*</span></label>
        				<select class="form-control" name="brand_id" id="brand_id">
						  @foreach ($brands as $brand)
						  	<option @if ($products->brand == $brand->id) selected @endif value="{{ $brand->id }}">{{ $brand->name }}</option>
						  @endforeach
						</select>

						<br>

						<label>Избери модел: <span style="color: red;">*</span></label>
                            
                        <br>

                        <select class="form-control" name="model_id" id="model_id">
                            <option selected value="{{ $products->model }}">@foreach ($models as $model) @if($model->id == $products->model) {{ $model->name }} @endif @endforeach</option>
                        </select>

						<br>

        				<label>Тегло: <span style="color: red;">*</span></label>
        				<div class="form-group">
                            <input type="text" name="weight" id="weight" class="form-control" value="{{ $products->weight }}">
                        </div>

                        <br>

                        <label>Климатик: <span style="color: red;">*</span></label>
        				<div class="form-group">
                            <input type="text" name="klimatik" id="klimatik" class="form-control" value="{{ $products->klimatik }}">
                        </div>

                        <br>

                        <label>Брой врати: <span style="color: red;">*</span></label>
        				<div class="form-group">
                            <input type="text" name="count_doors" id="count_doors" class="form-control" value="{{ $products->count_doors }}">
                        </div>

                        <br>

                        <label>Двигател: <span style="color: red;">*</span></label>
        				<div class="form-group">
                            <input type="text" name="engine" id="engine" class="form-control" value="{{ $products->engine }}">
                        </div>

                        <br>

                        <label>Кубатура: <span style="color: red;">*</span></label>
        				<div class="form-group">
                            <input type="text" name="kubatura" id="kubatura" class="form-control" value="{{ $products->kubatura }}">
                        </div>

                        <br>

                        <label>Скоростна кутия: <span style="color: red;">*</span></label>
        				<div class="form-group">
                            <input type="text" name="transmission" id="transmission" class="form-control" value="{{ $products->transmission }}">
                        </div>

                        <br>

                        <label>Тип автомобил: <span style="color: red;">*</span></label>
        				<div class="form-group">
                            <input type="text" name="car_type" id="car_type" class="form-control" value="{{ $products->car_type }}">
                        </div>

                        <br>

                        <label>Състояние: <span style="color: red;">*</span></label>
        				<div class="form-group">
                            <input type="text" name="status" id="status" class="form-control" value="{{ $products->status }}">
                        </div>

                        <br>

                        <label>Позиция: <span style="color: red;">*</span></label>
        				<div class="form-group">
                            <input type="text" name="position" id="position" class="form-control" value="{{ $products->position }}">
                        </div>

                        <br>

                        <label>Вт. №: <span style="color: red;">*</span></label>
        				<div class="form-group">
                            <input type="text" name="vt_number" id="vt_number" class="form-control" value="{{ $products->vt_number }}">
                        </div>

                        <br>

                        <label>Цена на продукта: <span style="color: red;">*</span></label>
        				<div class="form-group">
                            <input type="text" name="price" id="price" class="form-control" value="{{ $products->price }}">
                        </div>

                        <label>Да се покаже текста "за брой" срещу цената: <span style="color: red;">*</span></label>
                        <select class="form-control" name="count_price" id="count_price">
                            <option @if ($products->price_count == 'yes') selected @endif value="yes">Да</option>
                            <option @if ($products->price_count == 'no') selected @endif value="no">Не</option>
                        </select>

                        <br>

                        <button class="btn btn-info btn-lg">Обнови</button>
                        
                        <br><br><br>
        			</form>
        		</div>
                <div class="col-md-5">
                    <form method="post" action="{{ url('/admin/list-products/edit') }}/{{$products->id}}/delete">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="product_id" value="{{ $products->id }}">
                        <h2>Изтриване на продукта</h2>
                        <hr>
                        <button class="btn btn-danger">Изтриване!</button>
                    </form>
                </div>
        	</div>

        	<div class="row">
        		<div class="col-md-7">

        			<h2>Качване на снимки</h2>
        			<hr>

        			<form action="{{ url('/admin/list-products/upload') }}/{{$products->id}}" method="post" enctype="multipart/form-data">
			            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="product_id" value="{{ $products->id }}">
			            <div>
			                <input type="file" name="file" id="file">
			            </div>
                        <br>
                        <select class="form-control" name="image_type">
                          <option selected>Стандартна снимка</option>
                          <option>Заглавна снимка</option>
                        </select>
			            <br>
			            <div>
			                <button class="btn btn-warning btn-lg" type="submit">Качи!</button>
			            </div>
			        </form>

        			<br>

        		</div>
        	</div>
            <div class="row">
                <div class="col-md-10">
                    
                    <h2>Управление на снимки</h2>
                    <hr>

                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>
                                    Снимка
                                </th>
                                <th>
                                    Изтриване
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($images as $image)
                            <form method="post" action="{{ url('/admin/list-products/delete') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="image_id" value="{{ $image->id }}">
                            <tr>
                                <td>
                                    <img class="img-responsive" src="{{ $image->src }}">
                                </td>
                                <td>
                                    <button class="btn btn-danger fa-lg"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                            </form>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
@endsection