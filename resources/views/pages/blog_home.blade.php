<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Официален блог | AVTOPARTS.BG - Втора употреба авточасти на достъпни цени</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css/bootstrap.css" rel="stylesheet">
    <!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/blog-styles.css" rel="stylesheet">
	</head>
	<body>
<header class="navbar navbar-default navbar-fixed-top" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="/blog" class="navbar-brand">Avtoparts.BG - Блог</a>
    </div>
    <nav class="collapse navbar-collapse" role="navigation">
      <ul class="nav navbar-nav">
        <li>
          <a href="/">Обратно към сайта</a>
        </li>
      </ul>
      <ul class="nav navbar-right navbar-nav">
      </ul>
    </nav>
  </div>
</header>

<div id="masthead">  
  <div class="container">
    <div class="row">
      <div class="col-md-7">
        <h1>Блог
          <p class="lead">Официален блог на avtoparts.bg</p>
        </h1>
      </div>
    </div> 
  </div><!-- /cont -->
  
 
</div>


<div class="container">
  <div class="row">
    
    <div class="col-md-12"> 
      
      <div class="panel">
        <div class="panel-body">
        
          
          <!--/stories-->
		  <div class="row">
          {!! $blog_posts->render() !!}

            @foreach ($blog_posts as $blog_post)
            
            <br>
            <div class="col-md-2 col-sm-3 text-center">
              <a class="story-img" href="{{ url('/blog/view') }}/{{ $blog_post->id }}"><img src="{{ $blog_post->post_image }}" class="img-responsive img-square"></a>
            </div>
            <div class="col-md-10 col-sm-9">
              <a href="{{ url('/blog/view') }}/{{ $blog_post->id }}"><h3>{{ $blog_post->post_title }}</h3></a>
              <div class="row">
                <div class="col-xs-9">
                  <p>{!! $blog_post->post_description !!}</p>
                  <p class="lead"><a href="{{ url('/blog/view') }}/{{ $blog_post->id }}" class="btn btn-warning">Прочети <i class="fa fa-eye"></i></a></p>
                <div class="col-xs-3"></div>
              </div>
              <br><br>
            </div>
          </div>
          <hr>

            @endforeach
                     
            {!! $blog_posts->render() !!}
          
        </div>
      </div>
                                                                                       
	                                                
                                                      
   	</div><!--/col-12-->
  </div>
</div>
                                                
                                                                                
<hr>

<div class="container" id="footer">
  <div class="row">
    <div class="col col-sm-12">
      
      <h1>Follow Us</h1>
      <div class="btn-group">
       <a class="btn btn-twitter btn-lg" href="#"><i class="icon-twitter icon-large"></i> Twitter</a>
	   <a class="btn btn-facebook btn-lg" href="https://www.facebook.com/avtopartsbg-1633992893518820"><i class="icon-facebook icon-large"></i> Facebook</a>
	   <a class="btn btn-google-plus btn-lg" href="#"><i class="icon-google-plus icon-large"></i> Google+</a>
      </div>
      
    </div>
  </div>
</div>

<hr>

<footer>
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <ul class="list-inline">
          <li><i class="icon-facebook icon-2x"></i></li>
          <li><i class="icon-twitter icon-2x"></i></li>
          <li><i class="icon-google-plus icon-2x"></i></li>
          <li><i class="icon-pinterest icon-2x"></i></li>
        </ul>
        
      </div>
    </div>
  </div>
</footer>
	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>