<!DOCTYPE html>
<html>
<head>

	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Gospodin Binev">
	<meta name="keywords" content="авточасти, коли, втора употреба">
	<meta name="description" content="AVTOPARTS.BG - Втора употреба авточасти на достъпни цени, телефон за контакти - 0887470842">

	<title>@yield('page-title') | AVTOPARTS.BG - Втора употреба авточасти на достъпни цени</title>

    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon">

	<!-- Bootstrap Core -->
	<link rel="stylesheet" href="/css/bootstrap.css">

    <!-- Bootstrap Select -->
    <link rel="stylesheet" href="/css/bootstrap-select.min.css">

	<!-- My styles -->
	<link rel="stylesheet" href="/css/style.css">

	<!-- Bootstrap Theme -->
	<link rel="stylesheet" href="/css/bootstrap-theme.css">

	<!-- Hover CSS library -->
	<link rel="stylesheet" href="/css/hover.css">

	<!-- FontAwesome - Icon library -->
	<link rel="stylesheet" href="/css/font-awesome.css">

	<!-- Custom Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--Start of Zopim Live Chat Script-->
    <script type="text/javascript">
    window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
    d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
    _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
    $.src="//v2.zopim.com/?3S1FjdfqWd9DcIOPudF77SnJ5AfzeFJy";z.t=+new Date;$.
    type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
    </script>
    <!--End of Zopim Live Chat Script-->
	
</head>
<body>

	<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-static-top" role="navigation" id="mainNav">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand pull-left" href="{{ url('/') }}">
                    <img class="img-responsive" alt="www.avtoparts.bg" src="/images/logo2.png"> 
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
	                  <form method="get" action="{{ url('/search') }}" class="navbar-form navbar-left" role="search">
				        
                        <div class="form-group">
				          <input name="search-query" type="text" class="form-control" placeholder="Търсене на части">
				        </div>
				        <button type="submit" class="btn btn-primary">Търси</button>
				      </form>
                    <li>
                        <a class="hvr-overline-from-center" href="{{ url('/blog') }}">Новини</a>
                    </li>
                    <li>
                        <a class="hvr-overline-from-center" href="{{ url('/contacts') }}">Контакти</a>
                    </li>
                    @if (Auth::check())
                        <li class="dropdown">
                            <a class="dropdown-toggle hvr-overline-from-center" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->getName() }} <i class="fa fa-check"></i></a>
                            <ul class="dropdown-menu">
                                @if (Auth::user()->adminCheck() == 'manchev@avtoparts.bg')
                                    <li><a href="{{ url('/admin') }}"><i class="fa fa-magic"></i> Админ Панел</a></li>
                                @endif
                                <li><a href="{{ url('profile') }}/{{ Auth::user()->id }}"><i class="fa fa-user"></i> Профил</a></li>
                                <li><a href="{{ url('profile') }}/{{ Auth::user()->id }}/orders"><i class="fa fa-check"></i> Поръчки</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i> Изход</a></li>
                            </ul>
                        </li>
                    @else
                    <li class="dropdown">
			          <a href="#" class="dropdown-toggle hvr-overline-from-center" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> Профил <span class="caret"></span></a>
			          <ul class="dropdown-menu">
			            <li><a href="{{ url('/register') }}"><i class="fa fa-user-plus"></i> Регистрация</a></li>
			            <li><a href="{{ url('/login') }}"><i class="fa fa-sign-in"></i> Влез</a></li>
			          </ul>
			        </li>
                    @endif
                    <li><a class="hvr-overline-from-center" href="{{ url('order/cart') }}"><i class="fa fa-shopping-cart fa-lg"></i> <span class="badge">{{ Cart::total() }} лв.</span></a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>