@extends('master')

@section('page-title')
	За контакти
@endsection

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>За контакти</h1>
				<hr>
			</div>
			<div class="col-md-6">
				<img class="img-responsive" src="/images/contacts.jpg">
			</div>
			<div class="col-md-6">
				@foreach ($contacts as $contact)
					@if ($contact->id == 1)
					<h4>Работно време: </h4>
					<p>{!! $contact->text !!}</p>
					@endif
				@endforeach
				<hr>
				@foreach ($contacts as $contact)
					@if ($contact->id == 2)
					<h4>Телефон за консултации и поръчки:</h4>{{ $contact->text }}
					@endif
				@endforeach
				<hr>
				@foreach ($contacts as $contact)
					@if ($contact->id == 3)
						<h4>Email: </h4>
						<p>{{ $contact->text }}</p>
					@endif
				@endforeach	
				<hr>
				@foreach ($contacts as $contact)
					@if ($contact->id == 4)
						<h4>Адрес: </h4>
						<p>{{ $contact->text }}</p>
					@endif
				@endforeach	
			</div>
		</div>
	</div>
@endsection