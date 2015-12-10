@extends('admin.master')

@section('page-title')
	Поръчки
@endsection

@section('content')
<meta http-equiv="refresh" content="15">
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Поръчки</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
    	<div class="col-lg-12">
    		<table class="table table-bordered table-hover">
            	<thead>
            		<tr>
            			<th>Номер</th>
            			<th>Продукти</th>
            			<th>От потребител</th>
            			<th>Дължима сума</th>
            			<th>Текущ статус</th>
            		</tr>
            	</thead>
            	<tbody>
            		@foreach($orders as $order)
            		<tr>
            			<td>{{ $order->id }}</td>
            			<td><ol>{!! $order->products !!}</ol></td>
            			<td>
            				<strong>Име: </strong><em style="color: purple;">{{ $order->user_name }}</em><br><br>
            				<strong>Пожелан офис на Еконт за доставка: <br><span style="color: orange;">{{ $order->shipment_office }}</span></strong><br><br>
            				<strong>Телефонен номер:</strong> <strong style="color: grey;">{{ $order->nomer }}</strong>
            			</td>
            			<td>
            				<strong>{{ $order->price }} лв.</strong>
            			</td>
            			<td>
                            <form method="post" action="{{ url('/admin/orders/update') }}/{{ $order->id }}">
                				<input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
    			                    <input name="shipment-office" type="text" class="form-control" id="exampleInputName2" value="{{ $order->status }}">
    			                </div>
    			                <ul>
    			                	<li style="color: red;">0 - "Поръчката е отхвърлена."</li>
    			                	<li style="color: blue;">1 - "Чака одобрение."</li>
    			                	<li style="color: lime;">2 - "Поръчката е приета. Чакайте SMS уведомление от Econt Express."</li>
    			                </ul>
    			                <button class="btn btn-success">Одобри</button>
                            </form>
            			</td>
            		</tr>
            		@endforeach
            	</tbody>
            </table>
            {!! $orders->render() !!}

            @if (count($orders) < 1)
    			<h4 style="color: orange;">Няма направени поръчки.</h4>
    		@endif
    	</div>
    </div>
</div>
@endsection