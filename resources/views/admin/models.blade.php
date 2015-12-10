@extends('admin.master')

@section('page-title')
	Модели
@endsection

@section('content')
<div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Модели</h1>
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

        <div class="col-md-5">
        	<form method="get" action="{{ url('/admin/models') }}">
            	<label>Избери марка</label>
            	<select class="form-control" name="brand-id">
				  @foreach ($brands as $brand)
				  	<option value="{{ $brand->id }}">{{ $brand->name }}</option>
				  @endforeach
				</select>

				<br>
				<button class="btn btn-warning">Филтрирай</button>
				<br><br>
        	</form>
        </div>

		<br><br><br><br>

		<div class="col-md-12">
    		<table class="table table-bordered table-hover">
    			<thead>
    				<tr>
    					<th>id</th>
    					<th>Име</th>
    					<th>В марка</th>
    					<th>Позиция</th>
    				</tr>
    			</thead>
    			<tbody>
    				<tr>
    					<form method="post" action="{{ url('/admin/models/add') }}">
        					<input type="hidden" name="_token" value="{{ csrf_token() }}">
        					<td></td>
        					<td>
        						<div class="form-group">
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>
                            </td>
                            <td>
        						<select class="form-control" name="brand-id">
        						  @foreach ($brands as $brand)
								  	<option value="{{ $brand->id }}">{{ $brand->name }}</option>
								  @endforeach
								</select>
                            </td>
        					<td>
        						<div class="form-group">
                                    <input type="text" name="position" id="position" class="form-control">
                                </div>
        					</td>
        					<td><button class="btn btn-success">Създай</button></td>
						</form>
    				</tr>
    				@foreach ($models as $model)
					<tr>
						<form method="post" action="">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="model_id" value="{{ $model->id }}">
    						<td>
    							{{ $model->id }}
    						</td>
    						<td>
    							<div class="form-group">
                                    <input type="text" name="name" id="name" class="form-control" value="{{ $model->name }}">
                                </div>
    						</td>
    						<td>
    							<select class="form-control" name="brand-id">
        						  @foreach ($brands as $brand)
								  	<option value="{{ $brand->id }}" @if ($brand->id == $model->in_brand) selected @endif >{{ $brand->name }}</option>
								  @endforeach
								</select>
    						</td>
    						<td>
    							<div class="form-group">
                                    <input type="text" name="position" id="position" class="form-control" value="{{ $model->position }}">
                                </div>
    						</td>
    						<td>
    							<button formaction="{{ url('/admin/models/update') }}/{{$model->id}}" class="btn btn-info">Обнови</button>
    						</td>
    						<td>
    							<button formaction="{{ url('/admin/models/delete') }}/{{$model->id}}" class="btn btn-danger">Изтрий</button>
    						</td>
						</form>
					</tr>
					@endforeach
    			</tbody>
    		</table>
    	</div>
@endsection