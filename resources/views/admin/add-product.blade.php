@extends('admin.master')

@section('page-title')
	Добавяне на продукт
@endsection

@section('content')
	<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Добавяне на продукт</h1>
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
        			<form method="post" action="{{ url('/admin/add-products/add') }}">
        				<input type="hidden" name="_token" value="{{ csrf_token() }}">

        				<label>Категория: <span style="color: red;">*</span></label>
        				<select class="form-control" name="category_id" id="category_id">
						  @foreach ($productCategories as $productCategory)
                            <option value="{{ $productCategory->id }}">{{ $productCategory->name }}</option>
                          @endforeach
						</select>

						<br>

						<label>Избери подкатегория: <span style="color: red;">*</span></label>

						<select class="form-control" name="subcategory_id" id="subcategory_id">
                            
                        </select>

    					<br>

        				<label>Име: <span style="color: red;">*</span></label>
        				<div class="form-group">
                            <input type="text" name="name" id="name" class="form-control">
                        </div>

						<br>

						<label>Марка: <span style="color: red;">*</span></label>
        				<select class="form-control" name="brand_id" id="brand_id">
						  @foreach ($brands as $brand)
						  	<option value="{{ $brand->id }}">{{ $brand->name }}</option>
						  @endforeach
						</select>

						<br>

						<label>Избери модел: <span style="color: red;">*</span></label>

						<select class="form-control" name="model_id" id="model_id">
                            
                        </select>

						<br>

        				<label>Тегло: <span style="color: red;">*</span></label>
        				<div class="form-group">
                            <input type="text" name="weight" id="weight" class="form-control">
                        </div>

                        <br>

                        <label>Климатик: <span style="color: red;">*</span></label>
        				<div class="form-group">
                            <input type="text" name="klimatik" id="klimatik" class="form-control">
                        </div>

                        <br>

                        <label>Брой врати: <span style="color: red;">*</span></label>
        				<div class="form-group">
                            <input type="text" name="count_doors" id="count_doors" class="form-control">
                        </div>

                        <br>

                        <label>Двигател: <span style="color: red;">*</span></label>
        				<div class="form-group">
                            <input type="text" name="engine" id="engine" class="form-control">
                        </div>

                        <br>

                        <label>Кубатура: <span style="color: red;">*</span></label>
        				<div class="form-group">
                            <input type="text" name="kubatura" id="kubatura" class="form-control">
                        </div>

                        <br>

                        <label>Скоростна кутия: <span style="color: red;">*</span></label>
        				<div class="form-group">
                            <input type="text" name="transmission" id="transmission" class="form-control">
                        </div>

                        <br>

                        <label>Тип автомобил: <span style="color: red;">*</span></label>
        				<div class="form-group">
                            <input type="text" name="car_type" id="car_type" class="form-control">
                        </div>

                        <br>

                        <label>Състояние: <span style="color: red;">*</span></label>
        				<div class="form-group">
                            <input type="text" name="status" id="status" class="form-control">
                        </div>

                        <br>

                        <label>Позиция: <span style="color: red;">*</span></label>
        				<div class="form-group">
                            <input type="text" name="position" id="position" class="form-control">
                        </div>

                        <br>

                        <label>Вт. №: <span style="color: red;">*</span></label>
        				<div class="form-group">
                            <input type="text" name="vt_number" id="vt_number" class="form-control">
                        </div>

                        <br>

                        <label>Цена на продукта: <span style="color: red;">*</span></label>
        				<div class="form-group">
                            <input type="text" name="price" id="price" class="form-control">
                        </div>

                        <label>Да се покаже текста "за брой" срещу цената: <span style="color: red;">*</span></label>
                        <select class="form-control" name="price_count" id="price_count">
                            <option value="yes">Да</option>
                            <option selected value="no">Не</option>
                        </select>

                        <br>

                        <button class="btn btn-success btn-lg">Създай</button>
                        <br><br><br>
        			</form>
        		</div>
        	</div>
@endsection