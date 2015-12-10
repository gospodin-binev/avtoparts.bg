@extends('admin.master')

@section('page-title')
	Таблица с продукти
@endsection

@section('content')
	<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Таблица с продукти</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <form method="get" action="{{ url('/admin/list-products') }}" class="form-inline">
                        <div class="form-group">
                            <label for="search">Търсене: </label>
                            <input type="text" class="form-control" name="search" id="search">
                        </div>

                        <button class="btn btn-primary"><i class="fa fa-search"></i> Go!</button>
                    </form>
                </div>
            </div>
            <br>
            @if (count($products) < 1)
                <span style="color: red; font-size: 18px;">Няма намерени продукти.</span>
            @endif
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
        		<div class="col-lg-12">
        			<table class="table table-bordered table-hovered">
        				<thead>
        					<tr>
        						<th>id</th>
        						<th>Име</th>
        						<th>Вт. №</th>
        					</tr>
        				</thead>
        				<tbody>
        					@foreach ($products as $product)
        					<tr>
        						<td>{{ $product->id }}</td>
        						<td>{{ $product->name }}</td>
        						<td>{{ $product->vt_number }}</td>
        						
                                <td><a class="btn btn-info" href="{{ url('/admin/list-products/edit') }}/{{$product->id}}">Редактирай</button></td>
        					</tr>
        					@endforeach
        				</tbody>
                        
        			</table>
                    @if ($query == '')
                        {!! $products->render() !!}
                    @else
                        {!! str_replace('?page', '&page', $products->render()) !!}
                    @endif
        		</div>
        	</div>
    </div>
@endsection