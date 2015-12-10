@extends('master')

@section('page-title')
	Пазарна количка
@endsection

@section('content')
	<div class="container">
        <div class="row">
            <div class="col-md-12">
                    @if (Cart::count() < 1)
                        <h2 class="text-center similar-products"><i class="fa fa-shopping-cart fa-lg"></i> Няма добавени продукти в количката</h2>
                        <hr>
                        </div>
                        </div>
                        </div>
                    @elseif (!Auth::check())
                        <h2 class="text-center similar-products"> За да пазарувате, първо направете вашата регистрация - <a style="font-size: 30px;" class="news-links" href="{{ url('/register') }}">Регистрация</a></h2>
                        <hr>
                        </div>
                        </div>
                        </div>
                    @else
                <h2 class="text-center similar-products"><i class="fa fa-shopping-cart fa-lg"></i> Количка</h2>
                <hr>
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>Продукт</th>
                            <th>Име</th>
                            <th>Премахване</th>
                            <th>Цена</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($content as $row) :?>
                        <tr>
                            <td>
                                <img width="120" height="120" src="@foreach ($images as $image) @if (($image->in_product == $row->id) && ($image->image_type == 'Заглавна снимка')) {{ $image->src }} @endif @endforeach">
                            </td>
                             <td>
                                <h4><a href="{{ url('/products') }}/<?php echo $row->id ?>"><?php echo $row->name; ?></a></h4>
                            </td>
                            <td>
                                <form method="post" action="{{ url('/order/cart/remove') }}/<?php echo $row->rowid ?>">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button class="btn btn-danger lg"><i class="fa fa-times fa-lg"></i></button>
                                </form>
                            </td>
                            <td>
                                <h4><strong><?php echo $row->price ?> лв.</strong></h4>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="post" action="{{ url('/order/cart/destroy') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="btn btn-primary">Изчисти количката</button>
                </form>
                <hr>

                <form method="post" action="{{ url('order/checkout') }}">
                <h4>В кой офис на Еконт да получите пратката? </h4>
                  <div class="form-group" style="width: 600px;">
                    <label for="exampleInputName2">Проверете и попълнете адреса на обслужващия офис, на който да получите пратката.</label>
                    <input name="shipment-office" type="text" class="form-control" id="exampleInputName2" placeholder="Адрес на обслужващия офис">
                  </div>

                <h4>Справка: </h4>
                <iframe allowtransparency="true" scrolling="no" frameborder="0" height="300" width="605" src="http://www.test.econt.com/office_frame.php" ></iframe>

                <h4>Продукти: <strong>{{ Cart::total() }} лв.</strong></h4>
                <h4>Крайна цена с ДДС: <strong>{{ Cart::total() }} лв.</strong></h4>
                <hr>

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="products" value="<?php foreach ($content as $row) { echo '<li>ID: '.$row->id.' | Продукт: '.$row->name.' | Цена: '.$row->price.' лв.</li>'; } ?>">
                <input type="hidden" name="user" value="{{ Auth::user()->id }} {{ Auth::user()->familiya }}">
                <input type="hidden" name="userName" value="{{ Auth::user()->ime }} {{ Auth::user()->familiya }}">
                <input type="hidden" name="nomer" value="{{ Auth::user()->nomer }}">
                <input type="hidden" name="price" value="{{ Cart::total() }}">
                <input type="hidden" name="status" value="1">

                <button href="#" class="btn btn-warning btn-lg">Поръчай</button>
                </form>
            </div>
        </div>
        @endif
    </div>
@endsection