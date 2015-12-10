@extends('master')

@section('page-title')
	Контролен панел - поръчки
@endsection

@section('content')
	<div class="container-fluid">
		<h2 class="text-center">Контролен панел - поръчки</h2>
		<hr>
        <div class="row">
            <div class="col-md-3">
                <div id="profile-panel" class="list-group">
                  <a class="btn btn-info btn-lg" href="{{ url('/profile') }}/{{ Auth::user()->id }}" type="button" class="list-group-item list-group-item-info">Профил</a>
                  <a class="btn btn-primary btn-lg" href="{{ url('/profile') }}/{{ Auth::user()->id }}/orders" type="button" class="list-group-item list-group-item-info">Поръчки</a>
                </div>
            </div>
            <div class="col-md-9">
                <table class="table table-bordered table-hover">
                	<thead>
                		<tr>
                			<th>Номер</th>
                			<th>Продукти</th>
                			<th>Дължима сума</th>
                			<th>Статус</th>
                		</tr>
                	</thead>
                	<tbody>
                		@foreach($orders as $order)
                		<tr>
                			<td>{{ $order->id }}</td>
                			<td><ol>{!! $order->products !!}</ol></td>
                			<td>
                				<strong>{{ $order->price }} лв.</strong>
                			</td>
                			<td>
                				@if ($order->status == 0) 
                					<span style="color: red;">Поръчката е отхвърлена.</span> 
                				@elseif ($order->status == 1) 
                					<span style="color: blue;">Чака одобрение.</span> 
                				@else
                					<span style="color: lime;">Поръчката е приета. Чакайте SMS уведомление от Econt Express.</span> 
                				@endif
                			</td>
                		</tr>
                		@endforeach
                	</tbody>
                </table>
                @if (count($orders) < 1)
        			<h4 style="color: orange;">Няма направени поръчки.</h4>
        		@endif
            </div>
        </div>
    </div>
@endsection