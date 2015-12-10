@extends('admin.master')

@section('page-title')
	Блог
@endsection

@section('content')
	<div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Blog</h1>
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
    		<div class="col-md-12">
    			<form method="post" action="{{ url('admin/blog/create') }}" enctype="multipart/form-data">
    				<input type="hidden" name="_token" value="{{ csrf_token() }}">

    				<label>Заглавие: <span style="color: red;">*</span></label>
    				<div class="form-group">
                        <input type="text" name="post_title" id="post_title" class="form-control">
                    </div>

                    <label>Описание: <span style="color: red;">*</span></label>
    				<div class="form-group">
                        <input type="text" name="post_description" id="post_description" class="form-control">
                    </div>

                    <br>

                    <label>Качи картинка: <span style="color: red;">*</span></label>
                    <div class="form-group">
		                <input type="file" name="file" id="file">
		            </div>

		            <br>

		            <label>Съдържание: <span style="color: red;">*</span></label>
		            <textarea class="form-control" name="post_content" id="post_content" rows="20"></textarea>

		            <br>
		            <button class="btn btn-success btn-lg">Създай</button>
		            <br><br><br>

    			</form>
    		</div>
    	</div>
    	<div class="row">
    	<div class="col-md-12">
    		<h3>Изтриване на публикация</h3>
    		<table class="table table-bordered">
    		<thead>
				<th>ID</th>
				<th>Заглавие</th>
			</thead>
    		
    			<tbody>
    				
    					@foreach($blog_posts as $blog_post)
    					<tr>
    						<td>{{ $blog_post->id }}</td>
    						<td>{{ $blog_post->post_title }}</td>
    						<td>
    							<form method="post" action="{{ url('/admin/blog-post/delete') }}/{{ $blog_post->id }}">
    							<input type="hidden" name="_token" value="{{ csrf_token() }}">
    							<input type="hidden" name="news_id" value="{{ $blog_post->id }}">
    								<button class="btn btn-danger">Изтриване</button>
    							</form>
    						</td>
    					</tr>
    					@endforeach
    				
    			</tbody>
    		
    		</table>
    	</div>
    </div>
    </div>
@endsection