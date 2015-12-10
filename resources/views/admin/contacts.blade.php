@extends('admin.master')

@section('page-title')
	Контакти
@endsection

@section('content')
	<div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Контакти</h1>
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

            <div class="col-lg-12">


	            @foreach($contacts as $contact)

	            	@if ($contact->id == 1)
	            		<form method="post" action="">
            			<input type="hidden" name="_token" value="{{ csrf_token() }}">
	            		<input type="hidden" name="contact_id" value="{{ $contact->id }}">

		            	<div class="form-group">
						    <label>{{ $contact->name }}</label>
						    <input type="text" name="text" id="work_time" class="form-control" value="{!! $contact->text !!}">
						</div>

						<button class="btn btn-primary" formaction="{{ url('/admin/contacts/update') }}/{{ $contact->id }}">Обнови</button>
						<hr>
						</form>
					@endif

					@if ($contact->id == 2)
						<form method="post" action="">
            			<input type="hidden" name="_token" value="{{ csrf_token() }}">
            			<input type="hidden" name="contact_id" value="{{ $contact->id }}">

		            	<div class="form-group">
						    <label>{{ $contact->name }}</label>
						    <input type="text" name="text" id="phone" class="form-control" value="{!! $contact->text !!}">
						</div>

						<button class="btn btn-primary" formaction="{{ url('/admin/contacts/update') }}/{{ $contact->id }}">Обнови</button>
						<hr>
						</form>
					@endif

					@if ($contact->id == 3)
						<form method="post" action="">
            			<input type="hidden" name="_token" value="{{ csrf_token() }}">
            			<input type="hidden" name="contact_id" value="{{ $contact->id }}">

		            	<div class="form-group">
						    <label>{{ $contact->name }}</label>
						    <input type="text" name="text" id="email" class="form-control" value="{!! $contact->text !!}">
						</div>

						<button class="btn btn-primary" formaction="{{ url('/admin/contacts/update') }}/{{ $contact->id }}">Обнови</button>
						<hr>
						</form>
					@endif

					@if ($contact->id == 4)
						<form method="post" action="">
            			<input type="hidden" name="_token" value="{{ csrf_token() }}">
            			<input type="hidden" name="contact_id" value="{{ $contact->id }}">

		            	<div class="form-group">
						    <label>{{ $contact->name }}</label>
						    <input type="text" name="text" id="address" class="form-control" value="{!! $contact->text !!}">
						</div>

						<button class="btn btn-primary" formaction="{{ url('/admin/contacts/update') }}/{{ $contact->id }}">Обнови</button>
						<hr>

						</form>
					@endif

	            @endforeach

			</form>
            
            </div>

        </div>
    </div>
@endsection