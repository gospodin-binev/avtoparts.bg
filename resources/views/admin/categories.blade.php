@extends('admin.master')

@section('page-title')
	Управление на категории
@endsection

@section('content')
	<div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Категории</h1>
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
        	<div class="col-md-8">
        		<table class="table table-bordered table-hover">
        			<thead>
        				<tr>
        					<th>id</th>
        					<th>Име</th>
        					<th>Позиция</th>
        				</tr>
        			</thead>
        			<tbody>
        				<tr>
	        				<form method="post" action="{{ url('/admin/categories/add') }}">
	        					<input type="hidden" name="_token" value="{{ csrf_token() }}">
	        					<td></td>
	        					<td>
	        						<div class="form-group">
                                        <input type="text" name="name" id="name" class="form-control">
                                    </div>
                                </td>
	        					<td>
	        						<div class="form-group">
                                        <input type="text" name="position" id="position" class="form-control">
                                    </div>
	        					</td>
	        					<td><button class="btn btn-success">Създай</button></td>
        					</form>
        				</tr>
        				@foreach($categories as $category)
    					<tr>
    						<form method="post" action="">
    						<input type="hidden" name="_token" value="{{ csrf_token() }}">
    						<input type="hidden" name="category-id" value="{{ $category->id }}">
	    						<td>
	    							{{ $category->id }}
	    						</td>
	    						<td>
	    							<div class="form-group">
                                        <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}">
                                    </div>
	    						</td>

	    						<td>
	    							<div class="form-group">
                                        <input type="text" name="position" id="position" class="form-control" value="{{ $category->position }}">
                                    </div>
	    						</td>
	    						<td>
	    							<button formaction="{{ url('/admin/categories/update') }}/{{$category->id}}" class="btn btn-info">Обнови</button>
	    						</td>
	    						<td>
	    							<button formaction="{{ url('/admin/categories/delete') }}/{{$category->id}}" class="btn btn-danger">Изтрий</button>
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