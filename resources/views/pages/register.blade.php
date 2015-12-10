@extends('master')

@section('page-title')
	Регистрация
@endsection

@section('content')
	<div class="container">
        <div class="row">
            <h2 class="text-center similar-products">Регистрация</h2>
            <hr>
            @if(Session::has('acc-info'))
            	<div class="alert alert-success">{{ Session::get('acc-info') }}</div>
        	@endif
        	@if(Session::has('acc-error'))
            	<div class="alert alert-danger">{{ Session::get('acc-error') }}</div>
        	@endif
        </div>
        <div class="row">
            <div class="col-md-6">
                <h3 class="text-center">Нова регистрация</h3>
                <form method="post" action="{{ route('pages.register') }}">
                    <div class="form-group{{ $errors->has('ime') ? ' has-error' : '' }}">
                        <label for="ime">Име <span class="star">*</span></label>
                        <input type="text" name="ime" class="form-control" id="ime"
                        value="{{ Request::old('ime') ?: '' }}">
                        @if ($errors->has('ime'))
                        	<span class="help-block">{{ $errors->first('ime') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('familiya') ? ' has-error' : '' }}">
                        <label for="familiya">Фамилия <span class="star">*</span></label>
                        <input type="text" name="familiya" class="form-control" id="familiya"
                        value="{{ Request::old('familiya') ?: '' }}">
                        @if ($errors->has('familiya'))
                        	<span class="help-block">{{ $errors->first('familiya') }}</span>
                        @endif
                    </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email">@Email <span class="star">*</span></label>
                        <input type="email" name="email" class="form-control" id="email"
                        value="{{ Request::old('email') ?: '' }}">
                        @if ($errors->has('email'))
                        	<span class="help-block">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password">Парола <span class="star">*</span></label>
                        <input type="password" name="password" class="form-control" id="password"
                        value="{{ Request::old('password') ?: '' }}">
                        @if ($errors->has('password'))
                        	<span class="help-block">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label for="password_confirmation">Повтори парола <span class="star">*</span></label>
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                        value="{{ Request::old('password_confirmation') ?: '' }}">
                        @if ($errors->has('password_confirmation'))
                        	<span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('nomer') ? ' has-error' : '' }}">
                        <label for="nomer">Номер <span class="star">*</span></label>
                        <input type="text" name="nomer" class="form-control" id="nomer"
                        value="{{ Request::old('nomer') ?: '' }}">
                        @if ($errors->has('nomer'))
                        	<span class="help-block">{{ $errors->first('nomer') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('grad') ? ' has-error' : '' }}">
                        <label for="grad">Град <span class="star">*</span></label>
                        <input type="text" name="grad" class="form-control" id="grad"
                        value="{{ Request::old('grad') ?: '' }}">
                        @if ($errors->has('grad'))
                        	<span class="help-block">{{ $errors->first('grad') }}</span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('adres') ? ' has-error' : '' }}">
                        <label for="adres">Адрес <span class="star">*</span></label>
                        <input type="text" name="adres" class="form-control" id="adres"
                        value="{{ Request::old('adres') ?: '' }}">
                        @if ($errors->has('adres'))
                        	<span class="help-block">{{ $errors->first('adres') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="pcode">Пощенски код</label>
                        <input type="text" name="pcode" class="form-control" id="pcode">
                    </div>
                    <button class="btn btn-success btn-lg">Регистрация</button>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </form>
            </div>
            <div class="col-md-6">
                <form method="post" action="{{ url('/login') }}" class="form-signin text-center">
                    <h2 class="form-signin-heading text-center similar-products">Вход</h2>
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" required autofocus>
                    <label for="password" class="sr-only">Парола</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Парола" required>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="remember"> Запомни ме
                      </label>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block">Влез</button>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </form>
            </div>
        </div>
    </div>
@endsection