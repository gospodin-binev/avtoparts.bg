@extends('admin.master')

@section('page-title')
	Управление на подкатегории
@endsection

@section('content')
	<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Подкатегории</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
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
            	<form method="get" action="{{ url('/admin/sub-categories') }}">
	            	<label>Избери категория</label>
	            	<select class="form-control" name="category-id">
					  @foreach ($categories as $category)
					  	<option value="{{ $category->id }}">{{ $category->name }}</option>
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
        					<th>В категория</th>
        					<th>Позиция</th>
        				</tr>
        			</thead>
        			<tbody>
        				<tr>
	        				<form method="post" action="{{ url('/admin/sub-categories/add') }}">
	        					<input type="hidden" name="_token" value="{{ csrf_token() }}">
	        					<td></td>
	        					<td>
	        						<div class="form-group">
                                        <input type="text" name="name" id="name" class="form-control">
                                    </div>
                                </td>
                                <td>
	        						<select class="form-control" name="category-id">
	        						  @foreach ($categories as $category)
									  	<option value="{{ $category->id }}">{{ $category->name }}</option>
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
        				@foreach ($sub_categories as $sub_category)
    					<tr>
    						<form method="post" action="">
    							<input type="hidden" name="_token" value="{{ csrf_token() }}">
    							<input type="hidden" name="subcategory_id" value="{{ $sub_category->id }}">
	    						<td>
	    							{{ $sub_category->id }}
	    						</td>
	    						<td>
	    							<div class="form-group">
                                        <input type="text" name="name" id="name" class="form-control" value="{{ $sub_category->name }}">
                                    </div>
	    						</td>
	    						<td>
	    							<select class="form-control" name="category-id">
	        						  @foreach ($categories as $category)
									  	<option value="{{ $category->id }}" @if ($category->id == $sub_category->in_category) selected @endif >{{ $category->name }}</option>
									  @endforeach
									</select>
	    						</td>
	    						<td>
	    							<div class="form-group">
                                        <input type="text" name="position" id="position" class="form-control" value="{{ $sub_category->position }}">
                                    </div>
	    						</td>
	    						<td>
	    							<button formaction="{{ url('/admin/sub-categories/update') }}/{{$sub_category->id}}" class="btn btn-info">Обнови</button>
	    						</td>
	    						<td>
	    							<button formaction="{{ url('/admin/sub-categories/delete') }}/{{$sub_category->id}}" class="btn btn-danger">Изтрий</button>
	    						</td>
    						</form>
    					</tr>
    					@endforeach
        			</tbody>
        		</table>
        	</div>
        </div>
    </div>
@endsection