@extends('master')

@section('page-title')
	Контролен панел
@endsection

@section('content')
	<div class="container-fluid">
		<h2 class="text-center">Контролен панел</h2>
		<hr>
        <div class="row">
            <div class="col-md-3">
                <div id="profile-panel" class="list-group">
                  <a class="btn btn-info btn-lg" href="{{ url('/profile') }}/{{ Auth::user()->id }}" type="button" class="list-group-item list-group-item-info">Профил</a>
                  <a class="btn btn-primary btn-lg" href="{{ url('/profile') }}/{{ Auth::user()->id }}/orders" type="button" class="list-group-item list-group-item-info">Поръчки</a>
                </div>
            </div>
            <div class="col-md-9">
                <h3 class="checkoutDesc">Профил</h3>
	                @if(Session::has('acc-info'))
	            	<div class="alert alert-success">{{ Session::get('acc-info') }}</div>
		        	@endif
		        	@if(Session::has('acc-error'))
		            	<div class="alert alert-danger">{{ Session::get('acc-error') }}</div>
		        	@endif
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <h4><labeL>Лични данни</labeL></h4>
                        <hr>
                        <form method="post" action="{{ url('/profile') }}/{{ Auth::user()->id }}/update">

                            <div class="form-group">
                                <label for="ime">Име <span class="star">*</span></label>
                                <input type="text" name="ime" class="form-control" id="ime" value="{{ Auth::user()->ime }}">
                            </div>
                            <div class="form-group">
                                <label for="familiya">Фамилия <span class="star">*</span></label>
                                <input type="text" name="familiya" class="form-control" id="familiya" value="{{ Auth::user()->familiya }}">
                            </div>
                            <div class="form-group">
                                <label for="nomer">Номер <span class="star">*</span></label>
                                <input type="text" name="nomer" class="form-control" id="nomer" value="{{ Auth::user()->nomer }}">
                            </div>
                            <div class="form-group">
                                <label for="grad">Град <span class="star">*</span></label>
                                <input type="text" name="grad" class="form-control" id="grad" value="{{ Auth::user()->grad }}">
                            </div>
                            <div class="form-group">
                                <label for="adres">Адрес <span class="star">*</span></label>
                                <input type="text" name="adres" class="form-control" id="adres" value="{{ Auth::user()->adres }}">
                            </div>
                            <div class="form-group">
                                <label for="pcode">Пощенски код</label>
                                <input type="text" name="pcode" class="form-control" id="pcode" value="{{ Auth::user()->postal_code }}">
                            </div>

                            <input type="hidden" name="_token" value="{{ Session::token() }}">
		                    <input class="btn btn-success btn-lg" type="submit" value="Обнови">
		                    </form>

                        
                    </div>
                    <div class="col-md-6">
                        <h4><label>Смяна на парола</label></h4>
                        <hr>
                        <form method="post" action="{{ url('/profile') }}/{{ Auth::user()->id }}/changePassword">
                            <div class="form-group">
                                <label for="password">Нова парола <span class="star">*</span></label>
                                <input type="password" name="password" class="form-control" id="password">
                            	@if ($errors->has('password'))
                        			<span style="color: red;" class="help-block">{{ $errors->first('password') }}</span>
            					@endif
                            </div>
                            <div class="form-group">
                                <label for="passwordRepeat">Повтори паролата <span class="star">*</span></label>
                                <input type="password" name="password_confirmation" class="form-control" id="passwordRepeat">
                            	@if ($errors->has('password_confirmation'))
                        			<span style="color: red;" class="help-block">{{ $errors->first('password_confirmation') }}</span>
                        		@endif
                            </div>
                            <input type="hidden" name="_token" value="{{ Session::token() }}">
		                    <input class="btn btn-success btn-lg" type="submit" value="Обнови">
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection